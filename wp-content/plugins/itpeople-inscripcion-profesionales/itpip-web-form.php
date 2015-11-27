<?php

function itpip_form_func() {

	$result = null;
	$error = itpip_form_validate_post();


	if(!is_null($error) && count($error) == 0) {
		$result = itpip_form_save_post();
		if($result !== false) {
			unset($_POST);
		}
	}
   
	ob_start();
	?> 

		<?php if(!is_null($result) && $result !== false) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Listo!</strong> Hemos registrado tus datos.
			</div>
		<?php } ?>

		<?php if(!is_null($result) && $result === false) { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Ha ocurrido un problema al intentar procesar tu solicitud. Por favor, intenta más tarde. 
			</div>
		<?php } ?>


		<form method="POST" role="form" class="">

			<p>Completa el siguiente formulario con la información necesaria para registrar tu información</p>

			<div class="form-group <?php if(isset($error['cargo'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="cargo">Cargo o especialidad: (*)</label>
				<textarea class="form-control" name="cargo" id="cargo" rows="2"><?php if(isset($_POST['cargo'])) {  echo $_POST['cargo']; } ?></textarea>
				<?php if(isset($error['cargo'])) {  ?>
				<span class="help-block"><?php echo $error['cargo']; ?></span>
				<?php } ?>
			</div>		

			<div class="form-group <?php if(isset($error['nombre'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="nombre">Nombre:</label>
				<textarea class="form-control" name="nombre" id="nombre" rows="2"><?php if(isset($_POST['nombre'])) {  echo $_POST['nombre']; } ?></textarea>
				<?php if(isset($error['nombre'])) { ?>
				<span class="help-block"><?php echo $error['nombre']; ?></span>
				<?php } ?>
			</div>		

			<div class="form-group <?php if(isset($error['email'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="email">E-mail: (*)</label>
				<input type="text" name="email" id="email" class="form-control" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
				<?php if(isset($error['email'])) { ?>
				<span class="help-block"><?php echo $error['email']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['telefono'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="telefono">Teléfono:</label>
				<textarea class="form-control" name="telefono" id="telefono" rows="2"><?php if(isset($_POST['telefono'])) {  echo $_POST['telefono']; } ?></textarea>
				<?php if(isset($error['telefono'])) { ?>
				<span class="help-block"><?php echo $error['telefono']; ?></span>
				<?php } ?>
			</div>	

			<div class="form-group <?php if(isset($error['tecnologias'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="tecnologias">Indicar tecnologías:</label>
				<input type="text" name="tecnologias" id="tecnologias" class="form-control" value="<?php if(isset($_POST['tecnologias'])) echo $_POST['tecnologias']; ?>">
				<?php if(isset($error['tecnologias'])) { ?>
				<span class="help-block"><?php echo $error['tecnologias']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['anios_experiencia'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="anios_experiencia">Años de experiencia:</label>
				<textarea class="form-control" name="anios_experiencia" id="anios_experiencia" rows="2"><?php if(isset($_POST['anios_experiencia'])) {  echo $_POST['anios_experiencia']; } ?></textarea>
				<?php if(isset($error['anios_experiencia'])) { ?>
				<span class="help-block"><?php echo $error['anios_experiencia']; ?></span>
				<?php } ?>
			</div>	

			<div class="form-group <?php if(isset($error['disponibilidad'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="disponibilidad">Disponibilidad:</label>
				<textarea class="form-control" name="disponibilidad" id="disponibilidad" rows="2"><?php if(isset($_POST['disponibilidad'])) {  echo $_POST['disponibilidad']; } ?></textarea>
				<?php if(isset($error['disponibilidad'])) { ?>
				<span class="help-block"><?php echo $error['disponibilidad']; ?></span>
				<?php } ?>
			</div>	

			<div class="form-group <?php if(isset($error['renta_liquida'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="renta_liquida">Renta líquida:</label>
				<textarea class="form-control" name="renta_liquida" id="renta_liquida" rows="2"><?php if(isset($_POST['renta_liquida'])) {  echo $_POST['renta_liquida']; } ?></textarea>
				<?php if(isset($error['renta_liquida'])) { ?>
				<span class="help-block"><?php echo $error['renta_liquida']; ?></span>
				<?php } ?>
			</div>	

			<div class="form-group <?php if(isset($error['cv'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="cv">Agrega un CV</label>
				<input type="file" name="cv" id="cv" class="form-control">
				<?php if(isset($error['cv'])) { ?>
				<span class="help-block"><?php echo $error['cv']; ?></span>
				<?php } ?>
			</div>

			<button type="submit" name="enviar_inscripcion" class="btn btn-primary pull-right">Enviar</button>

			<p><em>(*) Campos obligatorios</em></p>	

		</form>

	<?php
	return ob_get_clean();
}

function itpip_form_save_post() {

	global $wpdb;

	/* TODO: Procesar FILES
	return $wpdb->insert('itpeople_solicitud_servicios', array(
		'cargo' => $_POST['cargo'],
		'nombre' => $_POST['nombre'],
		'email' => $_POST['email'],
		'telefono' => $_POST['telefono'],
		'tecnologias' => $_POST['tecnologias'],
		'anios_experiencia' => $_POST['anios_experiencia'],
		'disponibilidad' => $_POST['disponibilidad'],
		'renta_liquida' => $_POST['renta_liquida'],
		'cv' => $_POST['cv']
	));
	*/


}

function itpip_form_validate_post() {

	$error = array();

	if(isset($_POST['enviar_inscripcion'])) {


		if($_POST['cargo'] == "") {
			$error['cargo'] = "Debes ingresar un cargo o una especialidad";
		}

	    if($_POST['email'] == "") {
	    	$error['email'] = "Debes ingresar que un e-mail";
	    }

	    // TODO: Validar largo de textos
	    // TODO: Validar archivo

	    return $error;


	} else {
		return null;
	}

}

?>
