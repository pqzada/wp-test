<?php

global $jal_db_version;
$jal_db_version = '1.0';

/**
 * Crea tabla itpeople_solicitud_servicios
 */
function itpsc_install() {

	global $wpdb;
	global $jal_db_version;

	$table_name = 'itpeople_solicitud_servicios';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  id int NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	  perfil text NOT NULL,
	  ofrece text NOT NULL,
	  tecnologias text NOT NULL,
	  funciones text NOT NULL,
	  lugar_trabajo varchar(100) NOT NULL,
	  fecha_ingreso varchar(100) NOT NULL,
	  formacion varchar(100) NOT NULL,
	  anios_experiencia varchar(100) NOT NULL,
	  nivel_profesional varchar(100) NOT NULL,
	  contrato_duracion varchar(100) NOT NULL,
	  jornada varchar(100) NOT NULL,
	  ingreso varchar(100) NOT NULL,
	  contacto varchar(100) NOT NULL,
	  UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

	add_option( 'jal_db_version', $jal_db_version );
}