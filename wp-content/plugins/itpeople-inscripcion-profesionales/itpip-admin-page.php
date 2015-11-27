<?php

/*
function itpip_load_detail($id) {

	$s = itpip_get_solicitud_servicio($id);

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
*/

function itpip_load_content() {

	$profesionales = itpip_get_profesionales_inscritos();

?>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">

	<div class="wrap">
	<h2>Profesionales Inscritos</h2>

	<table id="profesionales" class="display table" cellspacing="0" width="100%">
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
				<th>Acciones</th>
			</tr>
		</thead>

		<tfoot>
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
				<th>Acciones</th>
			</tr>
		</tfoot>

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
					<td><?php echo $p->cv; ?></td>
					<td>
						TODO
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
		    $('#profesionales').DataTable({
		    	/*
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
		    	"searching": false		 */   
		    });
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
 * Obtiene solicitud de servicio
 *
 * @return mixed[] Solicitud de servicio
 */
/*
function itpip_get_solicitud_servicio($id) {

	global $wpdb;

	$sql = "SELECT * FROM itpeople_solicitud_servicios WHERE id = $id";
	$res = $wpdb->get_results($sql);

	return $res[0];

}
*/
?>