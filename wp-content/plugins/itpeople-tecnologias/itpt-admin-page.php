<style>
#list-tecnologias li {
	width: 20%;
	float: left;
}
</style>

<?php

function itpt_load_content() {

	// Variables
	$show_error = false;
	$nombre = '';
	$tecnologias = array();

	// Proceso POST - Nuevo
	$result = itpt_handle_post();	

	if($result !== true) {

		$nombre = $_POST['nombre-tecnologia'];
		$show_error = true;
		$error_msg = $result;

	}

	// Proceso POST - Eliminacion
	itpt_handle_delete();

	// Obtengo listado
	$tecnologias = itpt_get_tecnologias();

?>
	<h1>Tecnologías</h1>

	<h3>Nueva tecnología</h3>

	<form class="form-inline" method="post">
		<div class="form-group <?php if($show_error === true) { echo "has-error"; } ?>">
			<label class="sr-only" for="nombre">Nombre</label>
			<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre-tecnologia" value="<?php echo $nombre; ?>" autofocus>			
		</div>
		<button type="submit" class="btn btn-primary" name="registrar-tecnologia">Registrar</button>

		<?php if($show_error === true) { ?>
			<span id="helpBlock" class="help-block" style="color:#a94442;font-weight:bold">
				<?php echo $error_msg; ?>
			</span>
		<?php } ?>

	</form>

	<h3>Tecnologías registradas</h3>

	<?php if(count($tecnologias) == 0) { ?>

		<p>No hay tecnologías registradas</p>

	<?php } else { ?>

		<ul id="list-tecnologias">
			<?php foreach($tecnologias as $t) { ?>
				<li>
					<form method="post" onsubmit="return confirmDelete('<?php echo $t->nombre; ?>')">
						<button type="submit" class="btn btn-danger btn-xs" name="eliminar-tecnologia">
							<b>x</b>
						</button>
						<input type="hidden" name="id-tecnologia" value="<?php echo $t->id; ?>">
						<span class="label label-default"><?php echo $t->nombre; ?></span>
					</form>
				</li>
			<?php } ?>
		</ul>

	<?php } ?>

	<script type="text/javascript">
	function confirmDelete(nombre) {
		if(confirm("¿Estas seguro que deseas eliminar la tecnología " + nombre +"?")) {
			return true;
		}
		return false;
	}
	</script>

<?php

}

/**
 * Manejo de formulario de tecnologia
 *
 * @return mixed Resultado procesamiento
 */
function itpt_handle_post() {

	global $wpdb;

	if( isset($_POST['registrar-tecnologia']) ) {

		$result = itpt_valid_post($_POST['nombre-tecnologia']);
		if($result !== true) {
			return $result;
		} else {
			$wpdb->insert('itpeople_tecnologia', array('nombre' => $_POST['nombre-tecnologia']));
			return true;
		}
		
	}

	return true;
}

/**
 * Valida que el nombre de la tecnologia sea correcto
 *
 * @param String nombre Nombre ingresado
 *
 * @return mixed True si es válido o String si es inválido
 */
function itpt_valid_post($nombre) {

	global $wpdb;

	// Nombre != vacio
	if($nombre == '') {
		return "Debes ingresar un nombre de tecnología";
	}

	// Nombre debe ser unico
	$sql = "SELECT count(*) FROM itpeople_tecnologia WHERE nombre = '$nombre'";
	$res = $wpdb->get_var($sql);

	if($res > 0) {
		return "La tecnología ingresada ya existe";
	}

	return true;

}

/**
 * Elimino tecnologia
 *
 */
function itpt_handle_delete() {

	global $wpdb;

	if( isset($_POST['eliminar-tecnologia']) && $_POST['id-tecnologia'] != "" ) {

		$wpdb->delete( 'itpeople_tecnologia', array( 'id' => $_POST['id-tecnologia'] ) );
		
	}

	return true;
}

/**
 * Obtiene listado de tecnologias
 *
 * @return mixed[] Listado de tecnologias
 */
function itpt_get_tecnologias() {

	global $wpdb;

	$sql = "SELECT * FROM itpeople_tecnologia ORDER BY nombre ASC";
	$res = $wpdb->get_results($sql);

	return $res;

}

?>