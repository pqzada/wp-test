<?php
require_once "wp-config.php";

global $wpdb; 

$sql = "SELECT * FROM tb_postulaciones_itpeople WHERE eliminado = 0 AND id_oferta = " . $_REQUEST['id'];
$postulaciones = $wpdb->get_results($sql);

$rows = array();
foreach($postulaciones as $p) {
	$row = array(
		"Nombre" => $p->nombre,
		"E-mail" => $p->email,
		"Teléfono" => $p->telefono,
		"Tecnologías" => $p->tecnologias,
		"Años experiencia" => $p->anios_experiencia,
		"Disponibilidad" => $p->disponibilidad,
		"Renta líquida" => $p->renta_liquida,
		"Observaciones" => $p->observaciones,
		"Aprobado" => ($p->aprobado==1)?"SI":"NO"
	);
	
	$rows[] = $row;
}

download_send_headers("postulantes_" . $_REQUEST['id'] . ".csv");
echo utf8_decode(array2csv($rows));

function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}

function array2csv(array &$array) {

	if (count($array) == 0) {
		return null;
	}

	ob_start();

	$df = fopen("php://output", 'w');
	fputcsv($df, array_keys(reset($array)), ";");
	foreach ($array as $row) {
		fputcsv($df, $row, ";");
	}

	fclose($df);
	return ob_get_clean();
}

?>