<?php

global $jal_db_version;
$jal_db_version = '1.0';

/**
 * Crea tabla itpeople_solicitud_servicios
 */
function itpip_install() {

	global $wpdb;
	global $jal_db_version;

	$table_name = 'itpeople_profesional';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  id int NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	  cargo varchar(100) NOT NULL,
	  nombre varchar(100) NOT NULL,
	  email varchar(100) NOT NULL,
	  telefono varchar(100) NOT NULL,
	  tecnologias text NOT NULL,
	  anios_experiencia varchar(100) NOT NULL,
	  disponibilidad varchar(100) NOT NULL,
	  renta_liquida varchar(100) NOT NULL,
	  cv varchar(100) NOT NULL,
	  estado varchar(20) DEFAULT 'RECIBIDO' NOT NULL,
	  ok int DEFAULT 0 NOT NULL,
	  UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}