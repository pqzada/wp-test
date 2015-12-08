<?php

function itpsc_form_func() {

	$result = null;
	$error = itpsc_form_validate_post();

	$listado_tecnologias = itpip_get_listado_tecnologias();

	if(!is_null($error) && count($error) == 0) {
		$result = itpsc_form_save_post();
		if($result !== false) {
			unset($_POST);
		}
	}
   
	ob_start();
	?> 

		<link href="/wp-includes/css/magicsuggest.css" rel="stylesheet">
		<script src="/wp-includes/js/magicsuggest.js"></script>

		<link id="bsdp-css" href="<?php echo includes_url(); ?>css/bootstrap-datepicker3.css" rel="stylesheet">
		<script src="<?php echo includes_url(); ?>js/bootstrap-datepicker.js"></script>
		<script src="<?php echo includes_url(); ?>locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>

		<?php if(!is_null($result) && $result !== false) { ?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Listo!</strong> Hemos enviado tu solicitud de servicios.
			</div>
		<?php } ?>

		<?php if(!is_null($result) && $result === false) { ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				Ha ocurrido un problema al intentar procesar tu solicitud. Por favor, intenta más tarde. 
			</div>
		<?php } ?>


		<form method="POST" role="form" class="">

			<p>Completa el siguiente formulario con la información necesaria para solicitar servicios</p>

			<div class="form-group <?php if(isset($error['tipo'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="tipo">Tipo de solicitud: (*)</label>
				<select name="tipo" class="form-control" id="tipo">
					<option value="">Seleccione</option>
					<option value="Servicios / Proyectos / Gestión Subcontractors" <?php if(isset($_POST['tipo']) && $_POST['tipo'] == "Servicios / Proyectos / Gestión Subcontractors") {  echo "selected"; } ?>>
						Servicios / Proyectos / Gestión Subcontractors
					</option>
					<option value="Trabajadores Transitorios" <?php if(isset($_POST['tipo']) && $_POST['tipo'] == "Trabajadores Transitorios") {  echo "selected"; } ?>>
						Trabajadores Transitorios
					</option>
					<option value="Contratación Directa" <?php if(isset($_POST['tipo']) && $_POST['tipo'] == "Contratación Directa") {  echo "selected"; } ?>>
						Contratación Directa
					</option>
				</select>
				<?php if(isset($error['tipo'])) {  ?>
				<span class="help-block"><?php echo $error['tipo']; ?></span>
				<?php } ?>
			</div>	

			<div class="form-group <?php if(isset($error['perfil'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="perfil">Perfil del candidato requerido: (*)</label>
				<textarea class="form-control" name="perfil" id="perfil" rows="2"><?php if(isset($_POST['perfil'])) {  echo $_POST['perfil']; } ?></textarea>
				<?php if(isset($error['perfil'])) {  ?>
				<span class="help-block"><?php echo $error['perfil']; ?></span>
				<?php } ?>
			</div>		

			<div class="form-group <?php if(isset($error['ofrece'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="ofrece">Se ofrece: (*)</label>
				<textarea class="form-control" name="ofrece" id="ofrece" rows="2"><?php if(isset($_POST['ofrece'])) {  echo $_POST['ofrece']; } ?></textarea>
				<?php if(isset($error['ofrece'])) { ?>
				<span class="help-block"><?php echo $error['ofrece']; ?></span>
				<?php } ?>
			</div>		

			<div class="form-group <?php if(isset($error['tecnologias'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="tecnologias">Tecnologías o software a administrar, otros: (*)</label>
				<input type="text" name="tecnologias" id="tecnologias" class="form-control" value="" placeholder="Selecciona o agrega tus tecnologías">
				<?php if(isset($error['tecnologias'])) { ?>
				<span class="help-block"><?php echo $error['tecnologias']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['funciones'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="funciones">Funciones:</label>
				<input type="text" name="funciones" id="funciones" class="form-control" value="<?php if(isset($_POST['funciones'])) echo $_POST['funciones']; ?>">
				<?php if(isset($error['funciones'])) { ?>
				<span class="help-block"><?php echo $error['funciones']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['lugar_trabajo'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="lugar_trabajo">Ciudad y lugar de trabajo: (*)</label>
				<input type="text" name="lugar_trabajo" id="lugar_trabajo" class="form-control" value="<?php if(isset($_POST['lugar_trabajo'])) echo $_POST['lugar_trabajo']; ?>">
				<?php if(isset($error['lugar_trabajo'])) { ?>
				<span class="help-block"><?php echo $error['lugar_trabajo']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['disponibilidad'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="disponibilidad">Disponibilidad:</label>
				<input type="text" name="disponibilidad" id="disponibilidad" class="form-control" value="<?php if(isset($_POST['disponibilidad'])) echo $_POST['disponibilidad']; ?>">
				<?php if(isset($error['disponibilidad'])) { ?>
				<span class="help-block"><?php echo $error['disponibilidad']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['fecha_ingreso'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="fecha_ingreso">Fecha de ingreso:</label>
				<input type="text" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="<?php if(isset($_POST['fecha_ingreso'])) echo $_POST['fecha_ingreso']; ?>">
				<?php if(isset($error['fecha_ingreso'])) { ?>
				<span class="help-block"><?php echo $error['fecha_ingreso']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['formacion'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="formacion">Formación mínima:</label>
				<input type="text" name="formacion" id="formacion" class="form-control" value="<?php if(isset($_POST['formacion'])) echo $_POST['formacion']; ?>">
				<?php if(isset($error['formacion'])) { ?>
				<span class="help-block"><?php echo $error['formacion']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['anios'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="anios">Años experiencia:</label>
				<input type="text" name="anios" id="anios" class="form-control" value="<?php if(isset($_POST['anios'])) echo $_POST['anios']; ?>">
				<?php if(isset($error['anios'])) { ?>
				<span class="help-block"><?php echo $error['anios']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['nivel_profesional'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="nivel_profesional">Nivel profesional:</label>
				<input type="text" name="nivel_profesional" id="nivel_profesional" class="form-control" value="<?php if(isset($_POST['nivel_profesional'])) echo $_POST['nivel_profesional']; ?>">
				<?php if(isset($error['nivel_profesional'])) { ?>
				<span class="help-block"><?php echo $error['nivel_profesional']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['tipo_contrato'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="tipo_contrato">Tipo contrato y duración del trabajo: (*)</label>
				<input type="text" name="tipo_contrato" id="tipo_contrato" class="form-control" value="<?php if(isset($_POST['tipo_contrato'])) echo $_POST['tipo_contrato']; ?>">
				<?php if(isset($error['tipo_contrato'])) { ?>
				<span class="help-block"><?php echo $error['tipo_contrato']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['jornada'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="jornada">Jornada:</label>
				<input type="text" name="jornada" id="jornada" class="form-control" value="<?php if(isset($_POST['jornada'])) echo $_POST['jornada']; ?>">
				<?php if(isset($error['jornada'])) { ?>
				<span class="help-block"><?php echo $error['jornada']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['liquido_ofrece'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="liquido_ofrece">Ingresos líquidos a ofrecer: (*)</label>
				<input type="text" name="liquido_ofrece" id="liquido_ofrece" class="form-control" value="<?php if(isset($_POST['liquido_ofrece'])) echo $_POST['liquido_ofrece']; ?>">
				<?php if(isset($error['liquido_ofrece'])) { ?>
				<span class="help-block"><?php echo $error['liquido_ofrece']; ?></span>
				<?php } ?>
			</div>

			<div class="form-group <?php if(isset($error['contacto'])) {  echo "has-error"; } ?>">
				<label class="control-label" for="contacto">Contacto empresa para este requerimiento: (*)</label>
				<input type="text" name="contacto" id="contacto" class="form-control" value="<?php if(isset($_POST['contacto'])) echo $_POST['contacto']; ?>">
				<?php if(isset($error['contacto'])) { ?>
				<span class="help-block"><?php echo $error['contacto']; ?></span>
				<?php } ?>
			</div>

			<button type="submit" name="enviar_solititud" class="btn btn-primary pull-right">Enviar solicitud</button>

			<p><em>(*) Campos obligatorios</em></p>	

		</form>

		<script type="text/javascript">
		$('#fecha_ingreso').datepicker({
		    format: "yyyy-mm-dd",
		    autoclose: true,
		    language: "es",
		});
		</script>

		<script type="text/javascript">
			$(document).ready(function() {

				$(function() {
				    var ms = $('#tecnologias').magicSuggest({
				        data: <?php echo $listado_tecnologias; ?>
				    });

				    <?php 
					if(isset($_POST['tecnologias'])) {
						echo "ms.setValue(['" . implode("','", $_POST['tecnologias']) . "']);";
					}
					?>
				});		

			});
		</script>

	<?php
	return ob_get_clean();
}

function itpsc_form_save_post() {

	global $wpdb;

	if( isset($_POST['tecnologias']) && is_array($_POST['tecnologias']) ) {
		$_POST['tecnologias'] = implode(", ", $_POST['tecnologias']);
	}

	return $wpdb->insert('itpeople_solicitud_servicios', array(
		'perfil' => $_POST['perfil'],
		'ofrece' => $_POST['ofrece'],
		'tecnologias' => $_POST['tecnologias'],
		'funciones' => $_POST['funciones'],
		'lugar_trabajo' => $_POST['lugar_trabajo'],
		'fecha_ingreso' => $_POST['fecha_ingreso'],
		'disponibilidad' => $_POST['disponibilidad'],
		'formacion' => $_POST['formacion'],
		'anios_experiencia' => $_POST['anios'],
		'nivel_profesional' => $_POST['nivel_profesional'],
		'contrato_duracion' => $_POST['tipo_contrato'],
		'jornada' => $_POST['jornada'],
		'ingreso' => $_POST['liquido_ofrece'],
		'contacto' => $_POST['contacto'],
		'tipo' => $_POST['tipo']
	));


}

function itpsc_form_validate_post() {

	$error = array();

	if(isset($_POST['enviar_solititud'])) {


		if($_POST['tipo'] == "") {
			$error['tipo'] = "Debes seleccionar un tipo de servicio";
		}

		if($_POST['perfil'] == "") {
			$error['perfil'] = "Debes ingresar un perfil";
		}

	    if($_POST['ofrece'] == "") {
	    	$error['ofrece'] = "Debes ingresar que se ofrece";
	    }

	    if($_POST['tecnologias'] == "") {
	    	$error['tecnologias'] = "Debes ingresar alguna tecnología o software a administrar";
	    }

	    if($_POST['funciones'] == "") {
	    	$error['funciones'] = "Debes ingresar alguna función";
	    } 

	    if($_POST['lugar_trabajo'] == "") {
	    	$error['lugar_trabajo'] = "Debes ingresar la ciudad y/o lugar de trabajo ";
	    } else {
	    	if(strlen($_POST['lugar_trabajo']) >= 100) {
	    		$error['lugar_trabajo'] = "Ingresa máximo 100 caracteres";
	    	}
	    }

	    if($_POST['disponibilidad'] == "") {
	    	$error['disponibilidad'] = "Debes ingresar la disponibilidad";
	    } else {
	    	if(strlen($_POST['disponibilidad']) >= 100) {
	    		$error['disponibilidad'] = "Ingresa máximo 100 caracteres";
	    	}
	    }

	    if($_POST['fecha_ingreso'] == "") {
	    	$d = DateTime::createFromFormat('Y-m-d', $_POST['fecha_ingreso']);
    		if( !($d && $d->format('Y-m-d') == $_POST['fecha_ingreso']) ) {
    			$error['fecha_ingreso'] = "Formato de fecha incorrecto";
    		}	    	
	    }

	    if($_POST['formacion'] == "") {
	    	$error['formacion'] = "Debes ingresar la formación mínima ";
	    } else {
	    	if(strlen($_POST['formacion']) >= 100) {
	    		$error['formacion'] = "Ingresa máximo 100 caracteres";
	    	}
	    }

	    if($_POST['anios'] == "") {
	    	$error['anios'] = "Debes ingresar los años de experiencia esperados ";
	    } else {
	    	if(strlen($_POST['anios']) >= 100) {
	    		$error['anios'] = "Ingresa máximo 100 caracteres";
	    	}
	    }

	    if($_POST['nivel_profesional'] == "") {
	    	$error['nivel_profesional'] = "Debes ingresar el nivel de profesional";
	    } else {
	    	if(strlen($_POST['nivel_profesional']) >= 100) {
	    		$error['nivel_profesional'] = "Ingresa máximo 100 caracteres";
	    	}
	    }

	    if($_POST['tipo_contrato'] == "") {
	    	$error['tipo_contrato'] = "Debes ingresar el tipo de contrato y su duración";
	    } else {
	    	if(strlen($_POST['tipo_contrato']) >= 100) {
	    		$error['tipo_contrato'] = "Ingresa máximo 100 caracteres";
	    	}
	    }

	    if($_POST['jornada'] == "") {
	    	$error['jornada'] = "Debes ingresar el tipo de jornada ";
	    } else {
	    	if(strlen($_POST['jornada']) >= 100) {
	    		$error['jornada'] = "Ingresa máximo 100 caracteres";
	    	}
	    }

	    if($_POST['liquido_ofrece'] == "") {
	    	$error['liquido_ofrece'] = "Debes ingresar un monto líquido a ofrecer";
	    } else {
	    	if(strlen($_POST['liquido_ofrece']) >= 100) {
	    		$error['liquido_ofrece'] = "Ingresa máximo 100 caracteres";
	    	}
	    }

	    if($_POST['contacto'] == "") {
	    	$error['contacto'] = "Debes ingresar un contacto para este requerimiento";
	    } else {
	    	if(strlen($_POST['contacto']) >= 100) {
	    		$error['contacto'] = "Ingresa máximo 100 caracteres";
	    	}
	    }

	    return $error;


	} else {
		return null;
	}

}

?>
