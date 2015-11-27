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


		<form method="POST" role="form" class="form form-horizontal" enctype="multipart/form-data">

			<p>Completa el siguiente formulario con la información necesaria para registrar tu información</p>

			<div class="form-group <?php if(isset($error['cargo'])) {  echo "has-error"; } ?>">
				<label class="control-label col-xs-3" for="cargo">Cargo o especialidad: (*)</label>
				<div class="col-xs-7">
					<input type="text" name="cargo" id="cargo" class="form-control" value="<?php if(isset($_POST['cargo'])) echo $_POST['cargo']; ?>">					
					<?php if(isset($error['cargo'])) {  ?>
					<span class="help-block"><?php echo $error['cargo']; ?></span>
					<?php } ?>
				</div>
			</div>		

			<div class="form-group <?php if(isset($error['nombre'])) {  echo "has-error"; } ?>">
				<label class="control-label col-xs-3" for="nombre">Nombre:</label>
				<div class="col-xs-7">
					<input type="text" name="nombre" id="nombre" class="form-control" value="<?php if(isset($_POST['nombre'])) echo $_POST['nombre']; ?>">
					<?php if(isset($error['nombre'])) { ?>
					<span class="help-block"><?php echo $error['nombre']; ?></span>
					<?php } ?>
				</div>
			</div>		

			<div class="form-group <?php if(isset($error['email'])) {  echo "has-error"; } ?>">
				<label class="control-label col-xs-3" for="email">E-mail: (*)</label>
				<div class="col-xs-7">
					<input type="text" name="email" id="email" class="form-control" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
					<?php if(isset($error['email'])) { ?>
					<span class="help-block"><?php echo $error['email']; ?></span>
					<?php } ?>
				</div>
			</div>

			<div class="form-group <?php if(isset($error['telefono'])) {  echo "has-error"; } ?>">
				<label class="control-label col-xs-3" for="telefono">Teléfono:</label>
				<div class="col-xs-7">
					<input type="text" name="telefono" id="telefono" class="form-control" value="<?php if(isset($_POST['telefono'])) echo $_POST['telefono']; ?>">
					<?php if(isset($error['telefono'])) { ?>
					<span class="help-block"><?php echo $error['telefono']; ?></span>
					<?php } ?>
				</div>
			</div>	

			<div class="form-group <?php if(isset($error['tecnologias'])) {  echo "has-error"; } ?>">
				<label class="control-label col-xs-3" for="tecnologias">Indicar tecnologías:</label>
				<div class="col-xs-7">
					<textarea class="form-control" name="tecnologias" id="tecnologias" rows="2"><?php if(isset($_POST['tecnologias'])) {  echo $_POST['tecnologias']; } ?></textarea>					
					<?php if(isset($error['tecnologias'])) { ?>
					<span class="help-block"><?php echo $error['tecnologias']; ?></span>
					<?php } ?>
				</div>
			</div>

			<div class="form-group <?php if(isset($error['anios_experiencia'])) {  echo "has-error"; } ?>">
				<label class="control-label col-xs-3" for="anios_experiencia">Años de experiencia:</label>
				<div class="col-xs-7">
					<input type="text" name="anios_experiencia" id="anios_experiencia" class="form-control" value="<?php if(isset($_POST['anios_experiencia'])) echo $_POST['anios_experiencia']; ?>">
					<?php if(isset($error['anios_experiencia'])) { ?>
					<span class="help-block"><?php echo $error['anios_experiencia']; ?></span>
					<?php } ?>
				</div>
			</div>	

			<div class="form-group <?php if(isset($error['disponibilidad'])) {  echo "has-error"; } ?>">
				<label class="control-label col-xs-3" for="disponibilidad">Disponibilidad:</label>
				<div class="col-xs-7">
					<input type="text" name="disponibilidad" id="disponibilidad" class="form-control" value="<?php if(isset($_POST['disponibilidad'])) echo $_POST['disponibilidad']; ?>">
					<?php if(isset($error['disponibilidad'])) { ?>
					<span class="help-block"><?php echo $error['disponibilidad']; ?></span>
					<?php } ?>
				</div>
			</div>	

			<div class="form-group <?php if(isset($error['renta_liquida'])) {  echo "has-error"; } ?>">
				<label class="control-label col-xs-3" for="renta_liquida">Renta líquida:</label>
				<div class="col-xs-7">
					<input type="text" name="renta_liquida" id="renta_liquida" class="form-control" value="<?php if(isset($_POST['renta_liquida'])) echo $_POST['renta_liquida']; ?>">
					<?php if(isset($error['renta_liquida'])) { ?>
					<span class="help-block"><?php echo $error['renta_liquida']; ?></span>
					<?php } ?>
				</div>
			</div>	

			<div class="form-group <?php if(isset($error['cv'])) {  echo "has-error"; } ?>">
				<label class="control-label col-xs-3" for="cv">Agrega un CV <br>[Word o PDF]</label>
				<div class="col-xs-7">
					<input type="file" name="cv" id="cv" class="form-control">
					<?php if(isset($error['cv'])) { ?>
					<span class="help-block"><?php echo $error['cv']; ?></span>
					<?php } ?>
				</div>
			</div>

			<div class="col-xs-10">
				<button type="submit" name="enviar_inscripcion" class="btn btn-primary pull-right">Enviar</button>			
				<p><em>(*) Campos obligatorios</em></p>	
			</div>

		</form>

	<?php
	return ob_get_clean();
}

function itpip_form_save_post() {

	global $wpdb;

	$done_file = false;
	$filename = '';

	if(isset($_FILES['cv']) && $_FILES['cv']['name']!="") {

		$upload = Upload::factory('private_files');
		$upload->file($_FILES['cv']);

		$name_parts = explode(".", $_FILES['cv']['name']);
		$extension = $name_parts[count($name_parts) - 1];

		$filename = uniqid("PROFCV_") . "." . $extension;

		$upload->set_filename($filename);
		$result = $upload->save();

		if($result['status'] == 1) {
			$done_file = true;
		}
		
	} else {

		$done_file = true;

	}

	if($done_file) {

	} else {

		return false;

	}
	
	return $wpdb->insert('itpeople_profesional', array(
		'cargo' => $_POST['cargo'],
		'nombre' => $_POST['nombre'],
		'email' => $_POST['email'],
		'telefono' => $_POST['telefono'],
		'tecnologias' => $_POST['tecnologias'],
		'anios_experiencia' => $_POST['anios_experiencia'],
		'disponibilidad' => $_POST['disponibilidad'],
		'renta_liquida' => $_POST['renta_liquida'],
		'cv' => $filename
	));


}

function itpip_form_validate_post() {

	$error = array();

	if(isset($_POST['enviar_inscripcion'])) {


		if($_POST['cargo'] == "") {
			$error['cargo'] = "Debes ingresar un cargo o una especialidad";
		} else if(strlen($_POST['cargo']) >= 100) {
    		$error['cargo'] = "Ingresa máximo 100 caracteres";
    	}

	    if($_POST['email'] == "") {
	    	$error['email'] = "Debes ingresar que un e-mail";
	    } else if(strlen($_POST['email']) >= 100) {
    		$error['email'] = "Ingresa máximo 100 caracteres";
    	}

    	if($_POST['nombre'] != "" && strlen($_POST['nombre']) >= 100) {
    		$error['nombre'] = "Ingresa máximo 100 caracteres";
    	}

    	if($_POST['telefono'] != "" && strlen($_POST['telefono']) >= 100) {
    		$error['telefono'] = "Ingresa máximo 100 caracteres";
    	}

    	if($_POST['anios_experiencia'] != "" && strlen($_POST['anios_experiencia']) >= 100) {
    		$error['anios_experiencia'] = "Ingresa máximo 100 caracteres";
    	}

    	if($_POST['disponibilidad'] != "" && strlen($_POST['disponibilidad']) >= 100) {
    		$error['disponibilidad'] = "Ingresa máximo 100 caracteres";
    	}

    	if($_POST['renta_liquida'] != "" && strlen($_POST['renta_liquida']) >= 100) {
    		$error['renta_liquida'] = "Ingresa máximo 100 caracteres";
    	}

	    if(isset($_FILES['cv']) && $_FILES['cv']['name'] != "") {
	    	
	    	$mimes = array(
              'application/pdf',
              'application/x-pdf',
              'application/acrobat',
              'application/msword',
              'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
             ); 

	    	if(!in_array($_FILES['cv']['type'], $mimes)) {

	    		$error['cv'] = "Debes ingresar un archivo doc o pdf";

	    	} else if($_FILES['cv']['size'] > 1048576) {

	    		$error['cv'] = "Tamaño máximo 1MB";

	    	} else if( count(explode(".", $_FILES['cv']['name'])) == 1 ) {

				$error['cv'] = "Nombre de archivo inválido";	    		

	    	}

	    }

	    return $error;


	} else {
		return null;
	}

}

?>
