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
		}

		public function myplugin_add_meta_box() {

			$screens = array( 'ofertalaboral' );
			if (is_admin() && in_array('administrator', wp_get_current_user()->roles) && $_GET['action'] == 'edit') {
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
			add_submenu_page( 'edit.php?post_type=ofertalaboral', 'Postulaciones', 'Postulaciones', 'edit_theme_options', 'postulaciones', array($this, 'ver_postulaciones'));
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
					$upload->set_allowed_mime_types(array('application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword'));

					if ($upload->check() && parent::model('Model_Postulacion')->valid) {
						if ($secciones > 1) {
							$extencion = $fileName[ $secciones - 1];
							parent::model('Model_Postulacion')->ext_curriculum = $extencion;

							if($id_postulacion = parent::model('Model_Postulacion')->save()){
								$upload->set_filename($id_postulacion . '.' . parent::model('Model_Postulacion')->ext_curriculum);
								$upload->save();
								parent::set_mensaje('Gracias, tu postulacion ha sido aceptada y guardada con éxito');

								// envío correo administrador de nueva postulación
								$email_admin = get_option('admin_email');
								parent::model('Correos', array('to' => $email_admin, 'subject' => 'Nueva Postulacion'));
								// exit();
								parent::model('Correos')->send('Nueva Postulacion para la oferta "'.get_the_title(parent::model('Model_Postulacion')->id_oferta).'"');

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
	}
	?>
