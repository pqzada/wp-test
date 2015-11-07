<?php

global $jal_db_version;
$jal_db_version = '1.0';

/**
 * Crea tabla itpeople_tecnologias
 */
function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = 'itpeople_tecnologia';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE $table_name (
		id int NOT NULL AUTO_INCREMENT  PRIMARY KEY,
		nombre varchar(80) DEFAULT '' NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}

/**
 * Carga data inicial
 */
function jal_install_data() {
	global $wpdb;
	
	$welcome_name = 'Mr. WordPress';
	$welcome_text = 'Felicitaciones, haz completado la instalación!';
	
	$table_name = 'itpeople_tecnologia';
	
	$wpdb->insert($table_name, array('nombre' => 'Java'));
	$wpdb->insert($table_name, array('nombre' => '.NET'));
	$wpdb->insert($table_name, array('nombre' => 'Pentaho'));
	$wpdb->insert($table_name, array('nombre' => 'ORACLE DB'));
}