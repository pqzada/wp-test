<?php

function itpip_load_detail($id) {

	itpip_estado_action();
	itpip_ok_action();

	$p = itpip_get_profesional_inscrito($id);

?>

	<div class="wrap">

		<h2><?php echo $p->nombre; ?></h2><br>

		<div class="col-xs-6">
			<table class="table table-striped display" cellspacing="0" width="50%">
				<tr>
					<td valign="top"><b>Cargo o especialidad</b></td>
					<td><?php echo $p->cargo; ?></td>
				</tr>
				<tr>
					<td valign="top"><b>E-mail</b></td>
					<td><?php echo $p->email; ?></td>
				</tr>
				<tr>
					<td valign="top"><b>Teléfono</b></td>
					<td><?php echo $p->telefono; ?></td>
				</tr>
				<tr>
					<td valign="top"><b>Tecnologías</b></td>
					<td><?php echo $p->tecnologias; ?></td>
				</tr>
				<tr>
					<td valign="top"><b>Años experiencia</b></td>
					<td><?php echo $p->anios_experiencia; ?></td>
				</tr>		
				<tr>
					<td valign="top"><b>Disponibilidad</b></td>
					<td><?php echo $p->disponibilidad; ?></td>
				</tr>
				<tr>
					<td valign="top"><b>Renta líquida</b></td>
					<td><?php echo $p->renta_liquida; ?></td>
				</tr>
				<tr>
					<td valign="top"><b>Currículum Vitae</b></td>
					<td>
						<?php if($p->cv != '') { ?>
						<a href="/private_files/<?php echo $p->cv; ?>" target="_blank">Descargar</a>
						<?php } else { ?>
						No ingresado
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td valign="top"><b>Estado de atención</b></td>
					<td>
						<form method="POST" name="formEstado">
							<input type="hidden" name="id" value="<?php echo $p->id; ?>">
							<select name="estado" onchange="formEstado.submit()">
								<option value="ATENDIDO" <?php if($p->estado=="ATENDIDO") echo "selected"; ?>>Atendido</option>
								<option value="RECIBIDO" <?php if($p->estado=="RECIBIDO") echo "selected"; ?>>Recibido</option>
								<option value="ARCHIVADO" <?php if($p->estado=="ARCHIVADO") echo "selected"; ?>>Archivado</option>
							</select>
						</form>
					</td>
				</tr>
				
				<tr>
					<td valign="top"><b>Estado de aprobación</b></td>
					<td>
						<form method="POST" name="formOk">
							<input type="hidden" name="id" value="<?php echo $p->id; ?>">
							<select name="ok" onchange="formOk.submit()">
								<option value="0" <?php if($p->ok==0) echo "selected"; ?>>Desaprobado</option>
								<option value="1" <?php if($p->ok==1) echo "selected"; ?>>Aprobado</option>
							</select>
						</form>
					</td>
				</tr>		
			</table>
			
			<a href="/wp-admin/admin.php?page=inscripcion-profesionales" class="btn btn-primary">Volver</a>

		</div>
	</div>
	

<?php

}

function itpip_load_content() {

	$profesionales = itpip_get_profesionales_inscritos();

?>

	<script type="text/javascript" src="/wp-includes/datatables/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/wp-includes/datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="/wp-includes/datatables/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="/wp-includes/datatables/buttons.print.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/wp-includes/datatables/jquery.dataTables.min.css">

	<div class="wrap">
	<h2>Profesionales Inscritos</h2>

	<form><div class="checkbox"><label><input type="checkbox" id="mostrarArchivados"> <b>Mostrar archivados</b></label></div></form>
	<table id="profesionales2" class="display table table-condensed" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Cargo</th>
				<th>Nombre</th>
				<th>E-mail</th>
				<th>Teléfono</th>
				<th>Tecnologías</th>
				<th>Años experiencia</th>				
				<th>Disponibilidad</th>
				<th>Renta líquida</th>
				<th>CV</th>
				<th>Estado de atención</th>
				<th>Estado de aprobación</th>
				<th>Acciones</th>
			</tr>
		</thead>

		<tbody>

			<?php
			foreach($profesionales as $p) { 
			?>
				<tr>
					<td><?php echo $p->cargo; ?></td>
					<td><?php echo $p->nombre; ?></td>
					<td><?php echo $p->email; ?></td>
					<td><?php echo $p->telefono; ?></td>
					<td><?php echo $p->tecnologias; ?></td>
					<td><?php echo $p->anios_experiencia; ?></td>
					<td><?php echo $p->disponibilidad; ?></td>
					<td><?php echo $p->renta_liquida; ?></td>
					<td>
						<?php if($p->cv != '') { ?>
						<a href="/private_files/<?php echo $p->cv; ?>" target="_blank">Descargar</a>
						<?php } else { ?>
						No ingresado
						<?php } ?>
					</td>
					<td><?php echo $p->estado; ?></td>
					<td>
						<?php
							if($p->ok == 0) {
								echo "Desaprobado";
							} else {
								echo "Aprobado";
							}
						?>
					</td>
					<td>
						<form method="GET" action="" name="formVerProfesional">							
							<input type="hidden" name="page" value="inscripcion-profesionales">
							<input type="hidden" name="id_profesional" value="<?php echo $p->id; ?>">
							<button class="btn btn-primary" onclick="formVerProfesional.submit()">
								<i class="glyphicon glyphicon-search"></i> Ver
							</button>
						</form>
					</td>
				</tr>
			<?php
			}
			?>
		</tbody>

	</table>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {

			$.fn.dataTable.ext.search.push(
			    function( settings, data, dataIndex ) {

			    	var estado = data[9];

			    	if($('#mostrarArchivados').is(':checked')) {
			    		return true;
			    	} else {
			    		if(estado == 'ARCHIVADO') {
			    			return false;
			    		} else {
			    			return true;
			    		}
			    	}
			    }
			);

		    var table = $('#profesionales2').DataTable({
		    			    	
		    	ordering: true,
		    	paging: true,
		    	info: true,
		    	searching: true,		    
		    	stateSave: true,
		    	dom: 'Blfrtip',
		    	buttons: [
			        {
			        	extend: 'print',
			        	text: 'Imprimir',
			        	className: 'btn btn-default pull-right btn-sm',
			        	title: 'Profesionales'
			        }
			    ]
		    });

		    $('#mostrarArchivados').on('click', function() {
		    	table.draw();
		    })
		} );
	</script>

<?php
}



/**
 * Obtiene listado de profesionales inscritos
 *
 * @return mixed[] Listado de Profesionales
 */
function itpip_get_profesionales_inscritos() {

	global $wpdb;

	$sql = "SELECT * FROM itpeople_profesional ORDER BY id DESC";
	$res = $wpdb->get_results($sql);

	return $res;

}

/**
 * Obtiene profesional inscrito
 *
 * @return mixed[] Profesional
 */

function itpip_get_profesional_inscrito($id) {

	global $wpdb;

	$sql = "SELECT * FROM itpeople_profesional WHERE id = $id";
	$res = $wpdb->get_results($sql);

	return $res[0];

}

/**
 * Ejecuta accion de cambio de estado
 */
function itpip_estado_action() {

	if(isset($_POST['estado'])) {

		global $wpdb;

		$wpdb->update('itpeople_profesional', array('estado' => $_POST['estado']), array('id' => $_POST['id']));

	}

}


/**
 * Ejecuta accion de cambio de ok
 */
function itpip_ok_action() {

	if(isset($_POST['ok'])) {

		global $wpdb;

		$wpdb->update('itpeople_profesional', array('ok' => $_POST['ok']), array('id' => $_POST['id']));

	}

}

?>