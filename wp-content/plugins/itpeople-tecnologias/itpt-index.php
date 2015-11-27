<?php
/*
Plugin Name: ITPeople - Tecnologías
Description: Administracion de Tecnologías
Version: 1.0
Author: pqzada@gmail.com
*/

require_once 'itpt-install.php';
require_once 'itpt-admin-page.php';
require_once 'itpt-meta-box.php';

// Install
register_activation_hook( __FILE__, 'jal_install' );
register_activation_hook( __FILE__, 'jal_install_data' );

// Add's
add_action( 'admin_menu', 'tecnologias_setup_menu' );
add_action( 'add_meta_boxes_ofertalaboral', 'itpt_meta_boxes' );
add_action( 'save_post', 'itpt_save_meta_box_tecnologias', 10, 2 );

// Functions

/**
 * Crea menu administracion
 */
function tecnologias_setup_menu() {

	add_menu_page( 'Administración de Tecnologías', 'Tecnologías', 'edit_others_posts', 'tecnologias', 'tecnologias_init', 'dashicons-editor-code', '8.3' );

}

/**
 * Funcion inicial
 */
function tecnologias_init() {	

	wp_register_style( 'itptStyle', plugins_url('itpt-style.css', __FILE__) );

	itpt_load_content();

}

?>