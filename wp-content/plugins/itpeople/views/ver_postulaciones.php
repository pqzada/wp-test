<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h1>Postulaciones</h1>
			<h2><?php echo $titulo ?></h2>

			<table class="table">
				<tr>
					<th>Nombre</th>
					<th>Email</th>
					<th>Teléfono</th>
					<th>Años Experiencia</th>
					<th>Dsiponibilidad</th>
					<th>Renta Liquida</th>
					<th>Observaciones</th>
					<th>Curriculum</th>
				</tr>
				<?php foreach ($postulaciones as $postulacion): ?>
				<tr>
					<td><?php echo $postulacion->nombre ?></td>
					<td><?php echo $postulacion->email ?></td>
					<td><?php echo $postulacion->telefono ?></td>
					<td><?php echo $postulacion->anios_experiencia ?></td>
					<td><?php echo $postulacion->disponibilidad ?></td>
					<td><?php echo $postulacion->renta_liquida ?></td>
					<td><?php echo $postulacion->observaciones ?></td>
					<td><a href="/private_files/<?php echo $postulacion->id_postulacion ?>.<?php echo $postulacion->ext_curriculum ?>" target="_BLANK">Ver</a></td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>
