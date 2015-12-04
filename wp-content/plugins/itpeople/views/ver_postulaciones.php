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

			<table class="table table-condensed table-hover display" width="100%">
				<thead>
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
				</thead>

				<tbody>
					<?php foreach ($postulaciones as $postulacion): ?>
					<tr class="tr-<?php echo $postulacion->id_postulacion; ?> <?php if($postulacion->aprobado=="1") echo 'success'; ?> <?php if($postulacion->leido=="0") echo 'noleido'; ?>">
						<td><?php echo $postulacion->nombre ?></td>
						<td><?php echo $postulacion->email ?></td>
						<td><?php echo $postulacion->telefono ?></td>
						<td><?php echo $postulacion->anios_experiencia ?></td>
						<td><?php echo $postulacion->disponibilidad ?></td>
						<td><?php echo $postulacion->renta_liquida ?></td>
						<td><?php echo $postulacion->observaciones ?></td>
						<td>
							<a href="/private_files/<?php echo $postulacion->id_postulacion ?>.<?php echo $postulacion->ext_curriculum ?>" target="_BLANK" data-id="<?php echo $postulacion->id_postulacion; ?>" class="ver_postulacion btn btn-primary">
								<i class="glyphicon glyphicon-search"></i> Ver
							</a>
						</td>
						<td style="width:150px">
							<a href="javascript:void(null);" data-id="<?php echo $postulacion->id_postulacion; ?>" class="aprobar_postulacion btn btn-default" data-toggle="tooltip" data-placement="up" title="Aprobar" 
							<?php if($postulacion->aprobado=="1") echo 'style="display:none;" '; ?>>
								<i class="glyphicon glyphicon-thumbs-up"></i>
							</a>
							<a href="javascript:void(null);" data-id="<?php echo $postulacion->id_postulacion; ?>" class="desaprobar_postulacion btn btn-default"  data-toggle="tooltip" data-placement="up" title="Desaprobar" 
							<?php if($postulacion->aprobado=="0") echo 'style="display:none;" '; ?>>
								<i class="glyphicon glyphicon-thumbs-down"></i>
							</a>
							<a href="javascript:void(null);" data-id="<?php echo $postulacion->id_postulacion; ?>" class="marcar_leido btn btn-default"  data-toggle="tooltip" data-placement="up" title="Marcar como leído" 
							<?php if($postulacion->leido=="1") echo 'style="display:none;" '; ?>>
								<i class="glyphicon glyphicon-eye-open"></i>
							</a>
							<a href="javascript:void(null);" data-id="<?php echo $postulacion->id_postulacion; ?>" class="marcar_noleido btn btn-default"  data-toggle="tooltip" data-placement="up" title="Marcar como no leído" 
							<?php if($postulacion->leido=="0") echo 'style="display:none;" '; ?>>
								<i class="glyphicon glyphicon-eye-close"></i>
							</a>
							<a href="javascript:void(null);" data-id="<?php echo $postulacion->id_postulacion; ?>" class="eliminar_postulacion btn btn-default"  data-toggle="tooltip" data-placement="up" title="Eliminar" >
								<i class="glyphicon glyphicon-trash"></i>
							</a>
						</td>
					</tr>
					<?php endforeach ?>
				</tbody>
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
					jQuery(".tr-"+id).addClass("success");
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
					jQuery(".tr-"+id).removeClass("success");
				}
			})

		}
	});

	jQuery('.ver_postulacion').on('click', function(event) {

		// event.preventDefault();

		var id = jQuery(this).attr('data-id');

		jQuery.ajax({
			url: postulaciones_ajax.ajaxurl,
			type: 'POST',
			dataType: 'html',
			data: {
				'action'  : 'marcar_leido',
				'id' : id
			},
			success: function(response) {
				jQuery(".marcar_leido[data-id="+id+"]").hide();
				jQuery(".marcar_noleido[data-id="+id+"]").show();
				jQuery(".tr-"+id).removeClass("noleido");
			}
		})
	});

	jQuery('.marcar_leido').on('click', function(event) {

		event.preventDefault();

		var id = jQuery(this).attr('data-id');

		jQuery.ajax({
			url: postulaciones_ajax.ajaxurl,
			type: 'POST',
			dataType: 'html',
			data: {
				'action'  : 'marcar_leido',
				'id' : id
			},
			success: function(response) {
				jQuery(".marcar_leido[data-id="+id+"]").hide();
				jQuery(".marcar_noleido[data-id="+id+"]").show();
				jQuery(".tr-"+id).removeClass("noleido");
			}
		})
	});

	jQuery('.marcar_noleido').on('click', function(event) {

		event.preventDefault();

		var id = jQuery(this).attr('data-id');

		jQuery.ajax({
			url: postulaciones_ajax.ajaxurl,
			type: 'POST',
			dataType: 'html',
			data: {
				'action'  : 'marcar_noleido',
				'id' : id
			},
			success: function(response) {
				jQuery(".marcar_leido[data-id="+id+"]").show();
				jQuery(".marcar_noleido[data-id="+id+"]").hide();
				jQuery(".tr-"+id).addClass("noleido");
			}
		})
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

	jQuery('td a').tooltip();

</script>
