<style>
tr.aprobado {
    background-color: greenyellow;
}
</style>

<?php 
	$id_oferta = null;

	// Obtengo resumen
	$aprobados = 0;
	$no_aprobados = 0;
	$leidos = 0;
	$no_leidos = 0;
	foreach ($postulaciones as $postulacion) {
		if($postulacion->aprobado == "1") {
			$aprobados++;
		} else {
			$no_aprobados++;
		}

		if($postulacion->leido == "1") {
			$leidos++;
		} else {
			$no_leidos++;
		}

		$id_oferta = $postulacion->id_oferta;
	}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h1>Postulaciones</h1>
			<h2><?php echo $titulo ?></h2>

			<?php if(!is_null($id_oferta)) { ?>
			<a href="/exportar-postulantes.php?id=<?php echo $id_oferta; ?>" target="_blank" class="btn btn-success pull-right">
				<i class="glyphicon glyphicon-export"></i> Exportar
			</a>
			<?php } ?>

			<h5 id="resumen">
				Resumen: 
				<?php echo $leidos; ?> leído<?php if($leidos != "1") echo "s"; ?>, 
				<?php echo $no_leidos; ?> no leído<?php if($no_leidos != "1") echo "s"; ?>, 
				<?php echo $aprobados; ?> aprobado<?php if($aprobados != "1") echo "s"; ?> y 
				<?php echo $no_aprobados; ?> no aprobado<?php if($no_aprobados != "1") echo "s"; ?>, 
			</h5>

			<table class="table table-condensed table-hover display" width="100%" id="postulaciones" datatable="">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Email</th>
						<th>Teléfono</th>
						<th>Tecnologías</th>
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
						<td><?php echo $postulacion->tecnologias ?></td>
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

	function actualizarResumen() {

		jQuery.ajax({
			url: postulaciones_ajax.ajaxurl,
			type: 'POST',
			dataType: 'html',
			data: {
				'action'  : 'actualizar_resumen',
				'id': '<?php echo $id_oferta; ?>'
			},
			success: function(response) {
				console.log(response);
				var tmp = response.split("XRESUMENX");
				jQuery("#resumen").html(tmp[1]);
			}
		})

	}
	
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
					actualizarResumen();
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
					actualizarResumen();
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
				actualizarResumen();
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
				actualizarResumen();
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
				actualizarResumen();
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
					actualizarResumen();
				}
			})

		}
	});

	jQuery('td a').tooltip();
	

</script>
