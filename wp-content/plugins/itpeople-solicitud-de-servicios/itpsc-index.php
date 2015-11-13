<?php
/*
Plugin Name: ITPeople - Solicitud de Servicios
Description: Administracion de solicitud de servicios.
Version: 1.0
Author: pqzada@gmail.com
*/

require_once 'itpsc-install.php';
require_once 'itpsc-web-form.php';

// Install
register_activation_hook( __FILE__, 'itpsc_install' );

// Add's
add_action( 'admin_menu', 'solicitudes_setup_menu' );
add_shortcode('solicitud-servicios-form','itpsc_form_func');

// Functions

/**
 * Crea menu administracion
 */
function solicitudes_setup_menu() {

	add_menu_page( 'Solicitudes de Servicio', 'Solicitudes de Servicio', 'edit_others_posts', 'solicitudes-servicio', 'solicitudes_init' );

}

/**
 * Funcion inicial
 */
function solicitudes_init() {	

	echo "<h1>Solicitudes de Servicio</h1>";

}



?>

