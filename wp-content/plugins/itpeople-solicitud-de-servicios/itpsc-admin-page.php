<?php

function itpsc_load_detail($id) {

	$s = itpsc_get_solicitud_servicio($id);

?>

	<h1>Detalle solicitud #<?php echo $id; ?></h1>

	<button class="btn pull-right" onclick="javascript:history.go(-1)">Volver</button><br><br>

	<table class="table table-hover" cellspacing="0" width="100%">
		<tr>
			<td valign="top"><b>Perfil</b></td>
			<td><?php echo $s->perfil; ?></td>
		</tr>
		<tr>
			<td valign="top"><b>Se ofrece</b></td>
			<td><?php echo $s->ofrece; ?></td>
		</tr>
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
			<td valign="top"><b>Disponibilidad, fecha de ingreso</b></td>
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

	<button class="btn pull-right" onclick="javascript:history.go(-1)">Volver</button>
	

<?php

}

function itpsc_load_content() {

	$solicitudes = itpsc_get_solicitudes_servicio();

?>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">

	<h1>Solicitudes de servicio</h1>

	<table id="solicitudes" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Perfil</th>
				<th>Se ofrece</th>
				<th>Tecnologías</th>
				<th>Funciones</th>
				<th>Ciudad y lugar de trabajo</th>
				<th>Disponibilidad, fecha de ingreso</th>
				<th>Formación mínima</th>
				<th>Años experiencia</th>
				<th>Nivel profesional</th>
				<th>Tipo contrato y duración del trabajo</th>
				<th>Jornada</th>
				<th>Ingresos líquidos a ofrecer</th>
				<th>Contacto</th>
				<th>Acciones</th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th>Perfil</th>
				<th>Se ofrece</th>
				<th>Tecnologías</th>
				<th>Funciones</th>
				<th>Ciudad y lugar de trabajo</th>
				<th>Disponibilidad, fecha de ingreso</th>
				<th>Formación mínima</th>
				<th>Años experiencia</th>
				<th>Nivel profesional</th>
				<th>Tipo contrato y duración del trabajo</th>
				<th>Jornada</th>
				<th>Ingresos líquidos a ofrecer</th>
				<th>Contacto</th>
				<th>Acciones</th>
			</tr>
		</tfoot>

		<tbody>

			<?php
			foreach($solicitudes as $s) { 
			?>
				<tr>
					<td><?php echo $s->perfil; ?></td>
					<td><?php echo $s->ofrece; ?></td>
					<td><?php echo $s->tecnologias; ?></td>
					<td><?php echo $s->funciones; ?></td>
					<td><?php echo $s->lugar_trabajo; ?></td>
					<td><?php echo $s->fecha_ingreso; ?></td>
					<td><?php echo $s->formacion; ?></td>
					<td><?php echo $s->anios_experiencia; ?></td>
					<td><?php echo $s->nivel_profesional; ?></td>
					<td><?php echo $s->contrato_duracion; ?></td>
					<td><?php echo $s->jornada; ?></td>
					<td><?php echo $s->ingreso; ?></td>
					<td><?php echo $s->contacto; ?></td>
					<td>
						<form method="POST" action="" name="formVerSolicitud">
						<input type="hidden" name="id_solicitud" value="<?php echo $s->id; ?>">
						<button class="btn" onclick="formVerSolicitud.submit()">
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

	<script type="text/javascript">
		$(document).ready(function() {
		    $('#solicitudes').DataTable({
		    	"columnDefs": [
		    		{
		    			"targets": [ 1,3,6,7,8,9,10 ],
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