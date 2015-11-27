<?php
update_option( 'siteurl', 'http://www.itpeople.dev' );
update_option( 'home', 'http://www.itpeople.dev' );

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

$options_teme = array();

// define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/options/' );
// require_once dirname( __FILE__ ) . '/options/options-framework.php';

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>

<?php
}



/**
 * Menu de opciones del tema
 */
function prefix_options_menu_filter( $menu ) {
	$menu['mode'] = 'menu';
	$menu['page_title'] = __( 'Opciones del Tema', 'textdomain');
	$menu['menu_title'] = __( 'Opciones del Tema', 'textdomain');
	$menu['menu_slug'] = 'opciones-del-tema';
	return $menu;
}

add_filter( 'optionsframework_menu', 'prefix_options_menu_filter' );

 //Funcion para activar thumbnails
    add_theme_support( 'post-thumbnails' );

    add_image_size( 'ancho', 640, 9999 ); //640 pixels wide (and unlimited height)
    add_image_size( 'portada', 224, 137 ); //imagen de portada
    add_image_size( 'noticia-grande', 213, 163 ); //imagen de primera noticia
    add_image_size( 'noticia-chica', 136, 97 ); //imagen de otras noticias
    add_image_size( 'ultimo-evento', 212, 162 ); //imagen de ultimo evento
    add_image_size( 'linea-investigacion', 212, 143 ); //imagen de linea de investigacion
    add_image_size( 'slider-destacadas', 1000, 236 ); //imagen del slider destacadas
    add_image_size( 'interior-largo', 1000, 236 ); //imagen interior largo
    add_image_size( 'interior', 392, 262 ); //imagen interior cuadrado
    add_image_size( 'thumb_producto', 156, 156 );


    // enqueue base scripts and styles
	
    /*********************
    SCRIPTS & ENQUEUEING
    *********************/
    add_action( 'init', 'scripts_and_styles', 999 );
    // loading js y css
    function scripts_and_styles() {
        global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
    	// Load jQuery
    	if ( !is_admin() ) {
    	   wp_deregister_script('jquery');
    	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), false);
    	   wp_enqueue_script('jquery');

           //jquery-ui
            wp_register_script( 'jquery-ui-js', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js', array('jquery'), '', false );
            wp_register_style( 'jquery-ui-stylesheet', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css', array(), '', 'all' );
            wp_enqueue_script( 'jquery-ui-js' );
            wp_enqueue_style( 'jquery-ui-stylesheet' );

           //bootstrap
            wp_register_script( 'bootstrap-js', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array('jquery'), '3', false );
            wp_register_style( 'bootstrap-stylesheet', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', array(), '', 'all' );
            wp_register_style( 'bootstrap-theme-stylesheet', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css', array(), '', 'all' );
            wp_enqueue_script( 'bootstrap-js' );
            wp_enqueue_script( 'bootstrap-docs' );
            wp_enqueue_style( 'bootstrap-stylesheet' );
            wp_enqueue_style( 'bootstrap-theme-stylesheet' );

            wp_register_style("sitio", get_stylesheet_directory_uri() . '/css/sitio.css', array(), '2.1.5', 'all' );
            wp_enqueue_style( 'sitio' );

            wp_register_style("responsive", get_stylesheet_directory_uri() . '/css/responsive.css', array(), '2.1.5', 'all' );
            wp_enqueue_style( 'responsive' );

            wp_register_style("woocommerce", get_stylesheet_directory_uri() . '/css/woocommerce.css', array(), '2.1.5', 'all' );
            wp_enqueue_style( 'woocommerce' );

    	}else{

            wp_deregister_script('jquery');
            wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"), false);
            wp_enqueue_script( 'jquery' );

            //jquery-ui
            wp_register_script( 'jquery-ui-js', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js', array('jquery'), '', false );
            wp_register_style( 'jquery-ui-stylesheet', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css', array(), '', 'all' );
            wp_enqueue_script( 'jquery-ui-js' );
            wp_enqueue_style( 'jquery-ui-stylesheet' );

            //bootstrap
            wp_register_script( 'bootstrap-js', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array('jquery'), '3', false );
            wp_register_style( 'bootstrap-stylesheet', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', array(), '', 'all' );
            wp_register_style( 'bootstrap-theme-stylesheet', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css', array(), '', 'all' );
            wp_enqueue_script( 'bootstrap-js' );
            wp_enqueue_style( 'bootstrap-stylesheet' );
            wp_enqueue_style( 'bootstrap-theme-stylesheet' );

            // admin
            wp_register_style("admin", get_stylesheet_directory_uri() . '/css/admin.css', array(), '2.1.5', 'all' );
            wp_enqueue_style( 'admin' );
        }

    }
	
	// Clean up the <head>
	function removeHeadLinks() {
    	remove_action('wp_head', 'rsd_link');
    	remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');
    
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

    /**
     LLAMA AL CONTENIDO DE UNA PAGINA
     */
    function get_contenido($file, $dir=false){
        if(!$dir){
            include (TEMPLATEPATH . '/inc/' . $file . '.php');
        }else{
            include ($dir . '/' . $file . '.php');
        }
    }

/**
 Cortar Contenido
 */
 function cortar_contenido($contenido, $q=200)
    {
        $contenido = strip_tags($contenido);
        $ok = false;
        while (!$ok) {
            $contenido = substr($contenido, 0, $q);
            $ultimo = substr($contenido, -1);
            if($ultimo == " ")
                $ok = true;
            else
                $q--;
        }
        return $contenido;
    }

    /**
    DEVUELVE EL NOMBRE DEL MES
    */
   function get_nombre_mes($mes, $medida = 1)
   {
        $meses = array(
            array(1=>'En',2=>'Fe',3=>'Ma',4=>'Ab',5=>'Ma',6=>'Ju',7=>'Ju',8=>'Ag',9=>'Se',10=>'Oc',11=>'No',12=>'Di'),
            array(1=>'Ene',2=>'Feb',3=>'Mar',4=>'Abr',5=>'May',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dic'),
            array(1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'),
        );

        return $meses[$medida][$mes];
   }

   /**
    M_ARRAY
    */
   function m_array($arr, $var_dump = false, $exit = false)
    {
        if(is_array($arr) || is_object($arr)){
            echo '<hr><pre>';
            if($var_dump){
                var_dump($arr);
            }else{
                print_r($arr);
            }
            echo '</pre><hr>';
        }else{
            echo '<hr><pre>';
            echo 'no es arreglo ni objeto :´(<br />'.var_dump($arr);
            echo '</pre><hr>';
        }
        
        if($exit){
            exit();
        }
        
    }

    /**
    CONVIERTE UN ARREGLO EN OBJETO
    */
    function arrayToObjet($array)
    {
        $object = null;
        if (is_array($array)) {
            $object = new stdClass;
            foreach ($array as $key => $value) {
                if(is_array($value)){
                    $object->$key = arrayToObjet($value);
                }else{
                    $object->$key = $value;
                }
            }
        }

        return $object;
    }

    /**
    QUITA LOS SALTOS DE LINEA
    */
    function quitarSaltos($text)
    {
        $text = str_replace("\n", '', $text);
        $text = str_replace("\r", '', $text);
        $text = str_replace("\n\r", '', $text);
        return $text;
    }

    /**
    DEVUELVE UN ESTRACTO DEL TEXTO
    */
    function limitarCaracteres($text, $limite, $sinHtml = true, $puntitos = false, $nl2br=false, $buscar_espacio=true, $return = false)
    {

        if ($nl2br) {
            $text = nl2br($text);
        }

        if ($sinHtml) {
            $text = strip_tags($text,'<br>');
        }

        if(strlen($text) <= $limite){
            $new_text = $text;
        }else{
            if ($buscar_espacio) {
                $espacio = false;

                $puntuacion = array(',' , '.' , ':' , ';');

                while (!$espacio) {
                    if(in_array($text[$limite], $puntuacion)){
                        $text = substr_replace($text, ' ', ($limite), 1 );
                    }elseif($text[$limite]!=' '){
                        $limite--;
                    }elseif (in_array($text[$limite-1], $puntuacion)) {
                        $text = substr_replace($text, ' ', ($limite-1), 1 );
                        $limite--;
                    }else{
                        $espacio = true;
                    }
                }
            }
            
            $new_text = substr($text, 0, $limite);

            if ($puntitos) {
                $new_text.='...';
            }
        }

        if(!$return){
            echo $new_text;
        }else{
            return $new_text;
        }
    }

    /**
     DEVUELVE LA CANTIDAD DE VECES QUE HA SIDO VISTO UN POST
     */
    function get_post_views($postID){
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return 0;
        }
        return $count;
    }

    /**
     SUMA UNA VISTA MAS A UN POST
     */
    function set_post_views($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }

    /**
    POST PERSONALIZADOS
    **/
    add_action( 'init', 'crearTipoPost');
    function crearTipoPost()
    {
        $args = array(
            'label' => __('Slide'), //Nombre del tipo de post
            'singular_label' => __('Slide'), //Sigular del nombre
            'description' => __('Slide'), //Descripción
            'public' => true, 
            'show_ui' => true, //Mostrar en el panel
            // 'menu_icon' => $this->helpers_get_dir(__FILE__).'../images/isotipo_garland_pneus.png',
            'hierarchical' => false,
            'rewrite' => true, //Reescribir los permalinks
            'query_var' => 'slide',
            'supports' => array('title', 'editor', 'thumbnail'), //Características permitidas
            'menu_position' => 5,
        );
        register_post_type( 'slide' , $args );


        // $args = array(
        //     'label' => __('Redempleo'), //Nombre del tipo de post
        //     'singular_label' => __('Redempleo'), //Sigular del nombre
        //     'description' => __('Redempleo'), //Descripción
        //     'public' => true, 
        //     'show_ui' => true, //Mostrar en el panel
        //     // 'menu_icon' => $this->helpers_get_dir(__FILE__).'../images/isotipo_garland_pneus.png',
        //     'hierarchical' => false,
        //     'rewrite' => true, //Reescribir los permalinks
        //     'query_var' => 'redempleo',
        //     'supports' => array('title', 'editor', 'thumbnail'), //Características permitidas
        //     'menu_position' => 5,
        // );
        // register_post_type( 'redempleo' , $args );

        $args = array(
            'label' => __('Ofertas Laborales'), //Nombre del tipo de post
            'singular_label' => __('Oferta Laboral'), //Sigular del nombre
            'description' => __('Ofertas Laborales'), //Descripción
            'public' => true,
            'show_ui' => true, //Mostrar en el panel
            // 'menu_icon' => $this->helpers_get_dir(__FILE__).'../images/isotipo_garland_pneus.png',
            'menu_icon' => 'dashicons-megaphone',
            'hierarchical' => false,
            'rewrite' => true, //Reescribir los permalinks
            'query_var' => 'ofertalaboral',
            'capability_type' => 'post',
            'capabilities' => array(
                'publish_posts'       => 'edit_posts',//contributor can edit
                'edit_others_posts'   => 'update_core',//administrator can see other
                'delete_posts'        => 'update_core',//administrator can see other
                'delete_others_posts' => 'update_core',//administrator can see other
                'read_private_posts'  => 'update_core',//administrator can see other
                'edit_post'           => 'edit_posts',//contributor can edit
                'delete_post'         => 'update_core',//administrator can see other
                'read_post'           => 'edit_posts',//contributor can edit
            ),
            'supports' => array('title', 'editor'), //Características permitidas
            'menu_position' => 5,
        );
        register_post_type( 'ofertalaboral' , $args );
    }

    function remove_menus(){

      $author = wp_get_current_user();
      if(isset($author->roles[0])){ 
         $current_role = $author->roles[0];
      }else{
         $current_role = 'no_role';
      }

      if($current_role == 'contributor'){
         remove_menu_page( 'index.php' );//Dashboard
         remove_menu_page( 'edit.php' );//Posts
         remove_menu_page( 'upload.php' );//Media
         remove_menu_page( 'tools.php' ); //Tools
         remove_menu_page( 'edit-comments.php' );//Comments
         remove_menu_page( 'edit.php?post_type=slide' );
         remove_menu_page( 'edit.php?post_type=redempleo');
         remove_menu_page( 'admin.php?page=wpcf7' );
      }

    }
    add_action( 'admin_menu', 'remove_menus' );

    add_action('wp_ajax_get_contenido_ajax','get_contenido_ajax');
    add_action('wp_ajax_nopriv_get_contenido_ajax','get_contenido_ajax');
    function get_contenido_ajax()
    {
        if($_POST){
            $idPagina = $_POST['id_contenido'];
            $query = query_posts(array('post_type'=> 'page', 'p'=>$idPagina));

            if(have_posts()){
                while (have_posts()) {
                    the_post();
                    the_post_thumbnail();
                    the_title();
                    the_content();

                }
            }
        }
        die();
    }

  //Esta es la función que nos agregará la ajaxurl en el front-end. Que podremos utilizar en páginas y entradas.
    add_action('wp_head','ajaxurl');
    //Ahora tenemos lo que hace la funcion
    function ajaxurl() {
?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
<?php    }
