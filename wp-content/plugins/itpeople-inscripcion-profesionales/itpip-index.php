<?php
/*
Plugin Name: ITPeople - Inscripcion de Profesionales
Description: Inscripcion y gestion de nuevos profesionales
Version: 1.0
Author: pqzada@gmail.com
*/

require_once 'itpip-install.php';
require_once 'itpip-web-form.php';
require_once 'itpip-admin-page.php';

// Install
register_activation_hook( __FILE__, 'itpip_install' );

// Add's
add_action( 'admin_menu', 'inscripciones_setup_menu' );
add_shortcode('inscripcion-profesionales-form','itpip_form_func');

// Functions

/**
 * Crea menu administracion
 */
function inscripciones_setup_menu() {

	add_menu_page( 'Profesionales', 'Profesionales Inscritos', 'edit_others_posts', 'inscripcion-profesionales', 'inscripciones_init', 'dashicons-id-alt', '8.1' );

}

/**
 * Funcion inicial
 */
function inscripciones_init() {	

	//if( isset($_POST['id_inscripcion']) ) {

	//	itpip_load_detail($_POST['id_inscripcion']);

	//} else {

		itpip_load_content();

	//}

}



?>

