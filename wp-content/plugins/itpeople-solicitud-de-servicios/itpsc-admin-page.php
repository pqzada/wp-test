<?php

function itpsc_load_detail($id) {

	$s = itpsc_get_solicitud_servicio($id);

?>
	<div class="wrap">
	<h2>Detalle solicitud</h2>

	<div class="col-xs-10">
		<table class="table table-striped display" cellspacing="0" width="100%">
			<tr>
				<td valign="top"><b>Tipo</b></td>
				<td><?php echo $s->tipo; ?></td>
			</tr>
			<?php if($s->tipo == 'Contratación Directa') { ?>
				<tr>
					<td valign="top"><b>Perfil</b></td>
					<td><?php echo $s->perfil; ?></td>
				</tr>
				<tr>
					<td valign="top"><b>Se ofrece</b></td>
					<td><?php echo $s->ofrece; ?></td>
				</tr>
			<?php } ?>
			<?php if($s->tipo == 'Trabajadores Transitorios') { ?>
				<tr>
					<td valign="top"><b>Perfil</b></td>
					<td><?php echo $s->perfil; ?></td>
				</tr>
				<tr>
					<td valign="top"><b>Causal de contratación</b></td>
					<td><?php echo $s->causal; ?></td>
				</tr>
			<?php } ?>
			<?php if($s->tipo == 'Servicios / Proyectos / Gestión Subcontractors') { ?>
				<tr>
					<td valign="top"><b>Tipología de servicio</b></td>
					<td><?php echo $s->tipologia; ?></td>
				</tr>
				<tr>
					<td valign="top"><b>Definiciones</b></td>
					<td><?php echo $s->definiciones; ?></td>
				</tr>
			<?php } ?>
			<tr>
				<td valign="top"><b>Tecnologías</b></td>
				<td><?php echo $s->tecnologias; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Funciones</b></td>
				<td><?php echo $s->funciones; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Ciudad y lugar de trabajo</b></td>
				<td><?php echo $s->lugar_trabajo; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Disponibilidad</b></td>
				<td><?php echo $s->disponibilidad; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Fecha de ingreso</b></td>
				<td><?php echo $s->fecha_ingreso; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Formación mínima</b></td>
				<td><?php echo $s->formacion; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Años experiencia</b></td>
				<td><?php echo $s->anios_experiencia; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Nivel profesional</b></td>
				<td><?php echo $s->nivel_profesional; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Tipo contrato y duración del trabajo</b></td>
				<td><?php echo $s->contrato_duracion; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Jornada</b></td>
				<td><?php echo $s->jornada; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Ingresos líquidos a ofrecer</b></td>
				<td><?php echo $s->ingreso; ?></td>
			</tr>
			<tr>
				<td valign="top"><b>Contacto</b></td>
				<td><?php echo $s->contacto; ?></td>
			</tr>		
		</table>

		<a href="/wp-admin/admin.php?page=solicitudes-servicio" class="btn btn-primary">Volver</a>
	</div>
</div>

<?php

}

function itpsc_load_content() {

	$solicitudes = itpsc_get_solicitudes_servicio();

?>

	<script type="text/javascript" src="/wp-includes/datatables/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/wp-includes/datatables/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/wp-includes/datatables/jquery.dataTables.min.css">

	<div class="wrap">
	<h2>Solicitudes de servicio</h2>

	<table id="solicitudes" class="display table table-condensed" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Tipo</th>
				<th>Perfil</th>
				<th>Se ofrece</th>
				<th>Causal de contratación</th>
				<th>Tipología de servicio</th>
				<th>Definiciones</th>
				<th>Tecnologías</th>
				<th>Funciones</th>
				<th>Lugar de trabajo</th>
				<th>Disponibilidad</th>
				<th>Fecha de ingreso</th>
				<th>Formación mínima</th>
				<th>Años experiencia</th>
				<th>Nivel profesional</th>
				<th>Tipo contrato</th>
				<th>Jornada</th>
				<th>Ingresos</th>
				<th>Contacto</th>
				<th>Acciones</th>
			</tr>
		</thead>

		<tbody>

			<?php
			foreach($solicitudes as $s) { 
			?>
				<tr>
					<td><?php echo $s->tipo; ?></td>
					<td><?php echo $s->perfil; ?></td>
					<td><?php echo $s->ofrece; ?></td>
					<td><?php echo $s->causal; ?></td>
					<td><?php echo $s->tipologia; ?></td>
					<td><?php echo $s->definiciones; ?></td>
					<td><?php echo $s->tecnologias; ?></td>
					<td><?php echo $s->funciones; ?></td>
					<td><?php echo $s->lugar_trabajo; ?></td>
					<td><?php echo $s->disponibilidad; ?></td>
					<td><?php echo $s->fecha_ingreso; ?></td>
					<td><?php echo $s->formacion; ?></td>
					<td><?php echo $s->anios_experiencia; ?></td>
					<td><?php echo $s->nivel_profesional; ?></td>
					<td><?php echo $s->contrato_duracion; ?></td>
					<td><?php echo $s->jornada; ?></td>
					<td><?php echo $s->ingreso; ?></td>
					<td><?php echo $s->contacto; ?></td>
					<td>
						<form method="GET" action="" name="formVerSolicitud">
							<input type="hidden" name="page" value="solicitudes-servicio">
							<input type="hidden" name="id_solicitud" value="<?php echo $s->id; ?>">
							<button class="btn btn-primary" onclick="formVerSolicitud.submit()">
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
		    $('#solicitudes').DataTable({
		    	"columnDefs": [
		    		{
		    			"targets": [ 1, 2, 3, 4, 5, 8, 10, 13, 15, 16 ],
		                "visible": false,
		                "searchable": true
		    		}
		    	],
		    	"ordering": false,
		    	"paging": false,
		    	"info": false,
		    	"searching": false		    
		    });
		} );
	</script>

<?php
}



/**
 * Obtiene listado de solicitudes de servicio
 *
 * @return mixed[] Listado de Solicitudes
 */
function itpsc_get_solicitudes_servicio() {

	global $wpdb;

	$sql = "SELECT * FROM itpeople_solicitud_servicios ORDER BY id DESC";
	$res = $wpdb->get_results($sql);

	return $res;

}

/**
 * Obtiene solicitud de servicio
 *
 * @return mixed[] Solicitud de servicio
 */
function itpsc_get_solicitud_servicio($id) {

	global $wpdb;

	$sql = "SELECT * FROM itpeople_solicitud_servicios WHERE id = $id";
	$res = $wpdb->get_results($sql);

	return $res[0];

}

?>