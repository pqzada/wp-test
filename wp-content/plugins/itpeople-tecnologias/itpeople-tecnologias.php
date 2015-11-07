<?php
/*
Plugin Name: ITPeople - Tecnologías
Description: Administracion de Tecnologías
Version: 1.0
Author: pqzada@gmail.com
*/

require_once 'itpeople-tecnologias-admin-page.php';

add_action('admin_menu', 'tecnologias_setup_menu');

function tecnologias_setup_menu() {
	add_menu_page( 'Administración de Tecnologías', 'Tecnologías', 'manage_options', 'tecnologias', 'init' );
}

function init() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'No tienes suficientes permisos para acceder a esta pagina.' ) );
	}

	itpt_load_content();

}

?>