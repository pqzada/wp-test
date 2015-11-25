<style>
tr.aprobado {
    background-color: greenyellow;
}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h1>Postulaciones</h1>
			<h2><?php echo $titulo ?></h2>

			<table class="table table-condensed table-hover" width="100%">
				<tr>
					<th>Nombre</th>
					<th>Email</th>
					<th>Teléfono</th>
					<th>Años Experiencia</th>
					<th>Disponibilidad</th>
					<th>Renta Liquida</th>
					<th>Observaciones</th>
					<th>Curriculum</th>
					<th>Acciones</th>
				</tr>
				<?php foreach ($postulaciones as $postulacion): ?>
				<tr class="tr-<?php echo $postulacion->id_postulacion; ?> <?php if($postulacion->aprobado=="1") echo 'aprobado'; ?>">
					<td><?php echo $postulacion->nombre ?></td>
					<td><?php echo $postulacion->email ?></td>
					<td><?php echo $postulacion->telefono ?></td>
					<td><?php echo $postulacion->anios_experiencia ?></td>
					<td><?php echo $postulacion->disponibilidad ?></td>
					<td><?php echo $postulacion->renta_liquida ?></td>
					<td><?php echo $postulacion->observaciones ?></td>
					<td>
						<a href="/private_files/<?php echo $postulacion->id_postulacion ?>.<?php echo $postulacion->ext_curriculum ?>" target="_BLANK">
							Ver
						</a>
					</td>
					<td>
						<a href="javascript:void(null);" data-id="<?php echo $postulacion->id_postulacion; ?>" class="aprobar_postulacion" 
						<?php if($postulacion->aprobado=="1") echo 'style="display:none;" '; ?>>
							Aprobar
						</a>
						<a href="javascript:void(null);" data-id="<?php echo $postulacion->id_postulacion; ?>" class="desaprobar_postulacion" 
						<?php if($postulacion->aprobado=="0") echo 'style="display:none;" '; ?>>
							Desaprobar
						</a>
						<a href="javascript:void(null);" data-id="<?php echo $postulacion->id_postulacion; ?>" class="eliminar_postulacion">Eliminar</a>
					</td>
				</tr>
				<?php endforeach ?>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	jQuery('.aprobar_postulacion').on('click', function(event) {

		event.preventDefault();

		var id = jQuery(this).attr('data-id');

		if(confirm('¿Estas seguro que deseas aprobar esta postulación?')) {

			jQuery.ajax({
				url: postulaciones_ajax.ajaxurl,
				type: 'POST',
				dataType: 'html',
				data: {
					'action'  : 'aprobar_postulacion',
					'id' : id
				},
				success: function(response) {
					jQuery(".aprobar_postulacion[data-id="+id+"]").hide();
					jQuery(".desaprobar_postulacion[data-id="+id+"]").show();
					jQuery(".tr-"+id).addClass("aprobado");
				}
			})

		}
	});

	jQuery('.desaprobar_postulacion').on('click', function(event) {

		event.preventDefault();

		var id = jQuery(this).attr('data-id');

		if(confirm('¿Estas seguro que deseas desaprobar esta postulación?')) {

			jQuery.ajax({
				url: postulaciones_ajax.ajaxurl,
				type: 'POST',
				dataType: 'html',
				data: {
					'action'  : 'desaprobar_postulacion',
					'id' : id
				},
				success: function(response) {
					jQuery(".aprobar_postulacion[data-id="+id+"]").show();
					jQuery(".desaprobar_postulacion[data-id="+id+"]").hide();
					jQuery(".tr-"+id).removeClass("aprobado");
				}
			})

		}
	});

	jQuery('.eliminar_postulacion').on('click', function(event) {

		event.preventDefault();

		var id = jQuery(this).attr('data-id');

		if(confirm('¿Estas seguro que deseas eliminar esta postulación?')) {

			jQuery.ajax({
				url: postulaciones_ajax.ajaxurl,
				type: 'POST',
				dataType: 'html',
				data: {
					'action'  : 'eliminar_postulacion',
					'id' : id
				},
				success: function(response) {
					jQuery('.tr-' + id).hide();
				}
			})

		}
	});

</script>
