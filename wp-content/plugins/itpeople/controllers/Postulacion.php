<?php

	/**
	*	Maneja las postulaciones en el sitio
	*/
	class Postulacion extends Controller
	{

		function __construct()
		{
			parent::__construct();

			add_shortcode('form_postulacion', array($this, 'form_postulacion'));
			add_action( 'init', array($this, 'action_form_postulacion') );
			add_action( 'add_meta_boxes', array($this, 'myplugin_add_meta_box') );
			add_action( 'admin_menu', array($this , 'menu_postulaciones' ));

				//apply the pending status
			add_filter('wp_insert_post_data' , array($this, 'nuevo_post') , '99', 2);


			add_action( 'manage_edit-ofertalaboral_columns' , array($this, 'custom_column'));
			add_action( 'manage_ofertalaboral_posts_custom_column', array($this, 'manage_ofertalaboral_columns'), 10, 2 );

			add_action( 'wp_ajax_ver_postulaciones', array( $this, 'ajax_ver_postulaciones' ) );
			add_action( 'init', array($this, 'script_enqueuer') );

			add_action( 'load-edit.php', function(){
				$screen = get_current_screen();
    			// Only edit post screen:
				if( 'edit-ofertalaboral' === $screen->id && $screen->post_type == 'ofertalaboral' )
				{
        			// Before:
					add_action( 'all_admin_notices', function(){
						echo '
						<!-- Modal -->
						<div class="modal fade" id="modal_postulaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h1 class="modal-title" id="myModalLabel">Postulaciones</h1>
									</div>
									<div class="modal-body">
										<div id="contiene-postulaciones" class="table-responsive"></div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
						';
					});

        			// After:
					add_action( 'in_admin_footer', function(){
						// echo '<p>Goodbye from <strong>in_admin_footer</strong>!</p>';
					});
				}
			});

			add_action( 'restrict_manage_posts', array($this, 'restrict_ofertalaboral_by_tecnologia') );
			add_filter( 'posts_where' , array($this,'posts_where_tecnologia') );

			add_action( 'wp_ajax_aprobar_postulacion', array( $this, 'ajax_aprobar_postulacion' ) );
			add_action( 'wp_ajax_desaprobar_postulacion', array( $this, 'ajax_desaprobar_postulacion' ) );
			add_action( 'wp_ajax_eliminar_postulacion', array( $this, 'ajax_eliminar_postulacion' ) );
		}

		public function script_enqueuer() {
			wp_register_script( "postulaciones", WP_PLUGIN_URL.'/itpeople/views/js/postulaciones.js', array('jquery', 'bootstrap-js') );
			wp_localize_script( 'postulaciones', 'postulaciones_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'postulaciones' );
		}

		public function custom_column( $columns ) {
			$columns = array(
				'cb'              => '<input type="checkbox" />',
				'title'           => __( 'Titulo' ),
				'date'            => __( 'Date' ),
				'tecnologias'	  => __( 'Tecnologías' ),
				'q_postulaciones' => __(' Cantidad Postulaciones '),
				'postulaciones'   => __( 'Postulaciones' ),
			);

			return $columns;
		}

		public function manage_ofertalaboral_columns( $column, $post_id ) {
			global $post;
			$id_oferta       = $post_id;

			

			switch( $column ) {
				case 'q_postulaciones' :
					$sql             = 'SELECT * FROM tb_postulaciones_itpeople WHERE eliminado = 0 AND id_oferta = ' . $id_oferta;
					$postulaciones   = parent::model('Model_Postulacion')->get_custom($sql);
					$q_postulaciones = count($postulaciones);
					echo($q_postulaciones);
					break;

				case 'postulaciones' :
					echo '<a href="javascript:void(null);" data-id="'.$id_oferta.'" class="ver_postulaciones button button-info button-large">Ver Postulaciones</a>';
					break;

				case 'tecnologias':
					$post_meta = get_post_custom($post_id);
					$post_meta_tecnologias = "";
					if( isset( $post_meta['tecnologias'] ) ) {
						$post_meta_tecnologias = unserialize( $post_meta['tecnologias'][0] );
						echo implode(", ", $post_meta_tecnologias);
					} else {
						echo "-";
					}
					
					break;

				default :
					break;
			}
		}

		//function to set pending status
		public function nuevo_post( $data , $postarr ) {
			if (in_array('author', wp_get_current_user()->roles) && $data['post_type'] == 'ofertalaboral' && isset($postarr['action']) && $postarr['action'] == 'editpost')
			{
				// m_array(wp_get_current_user()->data->display_name,0);
				// m_array($postarr,0,1);
				// $data['post_status'] = 'pending';

				// envío correo administrador de nueva postulación
				$email_admin = get_option('admin_email');
				// $email_admin = 'gvenegas@anacondaweb.com';
				parent::model('Correos', array('to' => $email_admin, 'subject' => 'Nueva Oferta'));
				// exit();
				parent::model('Correos')->send(wp_get_current_user()->data->display_name . ' ha creado una nueva oferta, para publicar hacer clic <a href="http://www.itpeople.cl/wp-admin/post.php?post='.$postarr['post_ID'].'&action=edit">AQUI</a>');
			}
			return $data;
		}

		public function myplugin_add_meta_box() {

			$screens = array( 'ofertalaboral' );
			if (/*is_admin() && in_array('administrator', wp_get_current_user()->roles) && */$_GET['action'] == 'edit') {
				$id_oferta = $_GET['post'];
				$sql = 'SELECT COUNT(id_postulacion) AS q FROM tb_postulaciones_itpeople WHERE id_oferta = ' . $id_oferta;
				$qPostulaciones = parent::model('Model_Postulacion')->get_custom($sql);
				foreach ( $screens as $screen ) {
					add_meta_box(
						'postulaciones',
						'Postulaciones ('.$qPostulaciones[0]->q.')' ,
						array($this, 'muestra_boton_interior_admin'),
						$screen,
						'side'
						);
				}
			}
		}

		public function muestra_boton_interior_admin()
		{
			$id_oferta = $_GET['post'];
			echo '<a href="/wp-admin/edit.php?post_type=ofertalaboral&page=postulaciones&id_oferta='.$id_oferta.'" class="button button-info button-large">Ver Todas</a>';
		}

		public function menu_postulaciones() {
			add_submenu_page( 'edit.php?post_type=ofertalaboral', 'Postulaciones', 'Postulaciones', 'edit_posts', 'postulaciones', array($this, 'ver_postulaciones'));
		}

		public function ver_postulaciones()
		{
			$id_oferta = $_GET['id_oferta'];
			$sql = 'SELECT * FROM tb_postulaciones_itpeople WHERE id_oferta = ' . $id_oferta;
			$data = array(
				'id_oferta' => $id_oferta,
				'titulo' => get_the_title($id_oferta),
				'postulaciones' => parent::model('Model_Postulacion')->get_custom($sql),
				);
			parent::render('ver_postulaciones', $data);
		}

		public function ajax_ver_postulaciones()
		{
			$id_oferta = $_POST['id_oferta'];
			$sql = 'SELECT * FROM tb_postulaciones_itpeople WHERE eliminado = 0 AND id_oferta = ' . $id_oferta;
			$data = array(
				'id_oferta' => $id_oferta,
				'titulo' => get_the_title($id_oferta),
				'postulaciones' => parent::model('Model_Postulacion')->get_custom($sql),
				);
			parent::render('ver_postulaciones', $data);
			exit;
		}

		public function form_postulacion($attr)
		{
			$data = array(
				'id_oferta'			=> $attr['id_oferta'],
				'nombre'            => parent::model('Model_Postulacion')->nombre,
				'email'             => parent::model('Model_Postulacion')->email,
				'telefono'          => parent::model('Model_Postulacion')->telefono,
				'anios_experiencia' => parent::model('Model_Postulacion')->anios_experiencia,
				'disponibilidad'    => parent::model('Model_Postulacion')->disponibilidad,
				'renta_liquida'     => parent::model('Model_Postulacion')->renta_liquida,
				'observaciones'     => parent::model('Model_Postulacion')->observaciones,
				);
			$error = parent::get_error();
			if (count($error) >= 1) {
				$data['error'] = $error;
			}
			$mensaje = parent::get_mensaje();
			if (count($mensaje) >= 1) {
				$data['mensaje'] = $mensaje;
			}
			return $this->render('form_postulacion', $data, true);
		}

		public function action_form_postulacion()
		{

			if(isset($_GET['postulacion']) && $_GET['postulacion'] == 'nueva' && isset($_POST['postulacion']) && $_POST['postulacion']){

				$data = $_POST['postulacion'];
				$data['ext_curriculum'] = 'none';
				parent::model('Model_Postulacion')->set_data($data);
				$valid_data = parent::model('Model_Postulacion')->validate();
				if (isset($_FILES) && $_FILES['curriculum']) {
					$fileCurriculum = $_FILES['curriculum'];
					$fileName = explode('.', $fileCurriculum['name']);
					$secciones = count($fileName);

					$upload = Upload::factory('private_files');
					$upload->file($fileCurriculum);
					$upload->set_max_file_size(3);
					// $upload->set_allowed_mime_types(array('application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword'));

					if ($upload->check() && parent::model('Model_Postulacion')->valid) {
						if ($secciones > 1) {
							$extencion = $fileName[ $secciones - 1];
							parent::model('Model_Postulacion')->ext_curriculum = $extencion;

							if($id_postulacion = parent::model('Model_Postulacion')->save()){
								$upload->set_filename($id_postulacion . '.' . parent::model('Model_Postulacion')->ext_curriculum);
								$upload->save();
								parent::set_mensaje('Gracias, tu postulación ha sido aceptada y guardada con éxito');

								// envío correo administrador de nueva postulación
								$email_admin = get_option('admin_email');
								// $email_admin = 'gvenegas@anacondaweb.com';
								$mail_to_admin = new Correos(null, $email_admin, 'Nueva Postulación');
								$mail_to_admin->send(
									$mail_to_admin->get_template(
										'nueva_postulacion_admin',
										array(
											'titulo_oferta' => get_the_title(parent::model('Model_Postulacion')->id_oferta),
											'postulacion' => parent::model('Model_Postulacion')
											), true
										),
									'Nueva Postulación'
									);

								// envío correo postulante de nueva postulación
								$email_postulante = parent::model('Model_Postulacion')->email;
								$mail_to_postulante = new Correos(null, $email_postulante, 'Nueva Postulación');
								$mail_to_postulante->send(
									$mail_to_postulante->get_template(
										'nueva_postulacion_postulante',
										array(
											'titulo_oferta' => get_the_title(parent::model('Model_Postulacion')->id_oferta),
											'postulacion' => parent::model('Model_Postulacion')
											), true
										),
									'Nueva Postulación'
									);

								// envío correo creador de nueva postulación
								$post_author_id = get_post_field( 'post_author', parent::model('Model_Postulacion')->id_oferta );
								$mail_creador = get_the_author_meta( 'user_email', $post_author_id );
								$mail_to_creador = new Correos(null, $mail_creador, 'Nueva Postulación');
								$mail_to_creador->send(
									$mail_to_creador->get_template(
										'nueva_postulacion_admin',
										array(
											'titulo_oferta' => get_the_title(parent::model('Model_Postulacion')->id_oferta),
											'postulacion' => parent::model('Model_Postulacion')
											), true
										),
									'Nueva Postulación'
									);

								header('Location: ' . get_permalink(parent::model('Model_Postulacion')->id_oferta));
								exit();
							}else{
								parent::set_error('Ha ocurrido un error al guardar los datos, por favor intentalo mas tarde');
								parent::model('Model_Postulacion')->set_session_data();
								header('Location: ' . get_permalink(parent::model('Model_Postulacion')->id_oferta));
								exit();
							}

						}else{
							parent::set_error('Archivo no válido');

							parent::model('Model_Postulacion')->set_session_data();
							header('Location: ' . get_permalink(parent::model('Model_Postulacion')->id_oferta));
							exit();
						}
					}else{
						parent::model('Model_Postulacion')->set_session_data();
						if (!parent::model('Model_Postulacion')->valid) {
							parent::set_error($valid_data);
						}
						parent::set_error($upload->get_errors());
						header('Location: ' . get_permalink(parent::model('Model_Postulacion')->id_oferta));
						exit();
					}
				}


			}else{
				// // parent::model('Model_Postulacion')->set_session_data();
				// header('Location: /');
				// exit();
			}
		}

		public function restrict_ofertalaboral_by_tecnologia() {

			global $wpdb;

			$sql = "SELECT nombre FROM itpeople_tecnologia ORDER BY nombre ASC";
			$res = $wpdb->get_col($sql);
			?>

			<select name="tecnologia_restrict_ofertalaboral" id="tecnologia">
				<option value="">Todas las tecnologías</option>
				<?php foreach($res as $t) { ?>
				<option value="<?php echo esc_attr($t); ?>" <?php if(isset($_GET['tecnologia_restrict_ofertalaboral']) && !empty($_GET['tecnologia_restrict_ofertalaboral']) ) selected($_GET['tecnologia_restrict_ofertalaboral'], $t); ?>>
					<?php echo esc_attr($t); ?>
				</option>
				<?php } ?>
			</select>
			<?php
		}
			

		public function posts_where_tecnologia( $where) {

			if( is_admin() ) {

		        global $wpdb;       

		        if ( isset( $_GET['tecnologia_restrict_ofertalaboral'] ) && !empty( $_GET['tecnologia_restrict_ofertalaboral'] )) {

		            $tecnologia = esc_attr($_GET['tecnologia_restrict_ofertalaboral']);
		            $where .= " AND ID IN (SELECT post_id FROM " . $wpdb->postmeta ." WHERE meta_key='tecnologias' AND meta_value LIKE '%$tecnologia%' )";
		        } 
		        
		    } 

    		return $where;

		}

		public function ajax_aprobar_postulacion() {
			
			global $wpdb;

			$wpdb->update(
				'tb_postulaciones_itpeople',
				array("aprobado" => 1),
				array("id_postulacion" => $_REQUEST['id'])
			);

		}

		public function ajax_desaprobar_postulacion() {
			
			global $wpdb;

			$wpdb->update(
				'tb_postulaciones_itpeople',
				array("aprobado" => 0),
				array("id_postulacion" => $_REQUEST['id'])
			);

		}

		public function ajax_eliminar_postulacion() {
			
			global $wpdb;

			$wpdb->update(
				'tb_postulaciones_itpeople',
				array("eliminado" => 1),
				array("id_postulacion" => $_REQUEST['id'])
			);


		}
	}
	?>