<p>Nueva Postulación para la oferta "<?php echo $titulo_oferta ?>" con los siguientes datos</p>
<table>
	<tbody>
		<tr>
			<th>Nombre</th>
			<td><?php echo $postulacion->nombre ?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo $postulacion->email ?></td>
		</tr>
		<tr>
			<th>Teléfono</th>
			<td><?php echo $postulacion->telefono ?></td>
		</tr>
		<tr>
			<th>Años Experiencia</th>
			<td><?php echo $postulacion->anios_experiencia ?></td>
		</tr>
		<tr>
			<th>Dsiponibilidad</th>
			<td><?php echo $postulacion->disponibilidad ?></td>
		</tr>
		<tr>
			<th>Renta Liquida</th>
			<td><?php echo $postulacion->renta_liquida ?></td>
		</tr>
		<tr>
			<th>Observaciones</th>
			<td><?php echo $postulacion->observaciones ?></td>
		</tr>
		<?php /* ?><tr>
			<th>Curriculum</th>
			<td><a href="/private_files/<?php echo $postulacion->id_postulacion ?>.<?php echo $postulacion->ext_curriculum ?>" target"_BLANK">Ver</a></td>
		</tr><?php */ ?>
	</tbody>
</table>

