<?php
/*
Plugin Name: ITPeople - Tecnologías
Description: Administracion de Tecnologías
Version: 1.0
Author: pqzada@gmail.com
*/

require_once 'itpt-install.php';
require_once 'itpt-admin-page.php';

// Install
register_activation_hook( __FILE__, 'jal_install' );
register_activation_hook( __FILE__, 'jal_install_data' );

// Add's
add_action('admin_menu', 'tecnologias_setup_menu');

// Functions

/**
 * Crea menu administracion
 */
function tecnologias_setup_menu() {

	add_menu_page( 'Administración de Tecnologías', 'Tecnologías', 'manage_options', 'tecnologias', 'init' );

}

/**
 * Funcion inicial
 */
function init() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'No tienes suficientes permisos para acceder a esta pagina.' ) );
	}

	itpt_load_content();

}

?>