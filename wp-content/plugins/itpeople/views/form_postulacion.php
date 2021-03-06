<link href="/wp-includes/css/magicsuggest.css" rel="stylesheet">
<script src="/wp-includes/js/magicsuggest.js"></script>

<?php if (isset($error)): ?>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#postulacion-modal').modal('show');

		});
	</script>

<?php endif ?>

<?php if (isset($mensaje)): ?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$("#mensaje-postulacion-modal").modal('show');
	});
	</script>
<?php endif ?>

<?php if (isset($mensaje)): ?>
	<div id="mensaje-postulacion-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Datos Guardados</h4>
				</div>
				<div class="modal-body">
						<ul class="list-unstyled">
						<?php foreach ($mensaje as $msg): ?>
							<li><?php echo $msg ?></li>
						<?php endforeach ?>
						</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php endif ?>



<button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#postulacion-modal">
	Enviar mi CV
</button>

<div id="postulacion-modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" action="?postulacion=nueva" enctype="multipart/form-data" class="form-horizontal">
				<input type="hidden" name="postulacion[id_oferta]" value="<?php echo $id_oferta ?>">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Postulación</h4>
				</div>
				<div class="modal-body">

					<?php if (isset($error)): ?>
						<div class="panel panel-danger">
							<div class="panel-heading">
								<h3 class="panel-title">Error</h3>
							</div>
							<div class="panel-body">
								<ul class="list-unstyled">
									<?php foreach ($error as $err): ?>
										<li><?php echo $err ?></li>
									<?php endforeach ?>
								</ul>
							</div>
						</div>
					<?php endif ?>

					<div class="form-group">
						<label for="nombre" class="col-sm-3 control-label">Nombre (*)</label>
						<div class="col-sm-9">
							<input type="text" class="form-control input-sm" name="postulacion[nombre]" id="nombre" placeholder="Nombre" value="<?php echo $nombre ?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">E-mail (*)</label>
						<div class="col-sm-9">
							<input type="email" class="form-control input-sm" name="postulacion[email]" id="email" placeholder="E-Mail" value="<?php echo $email ?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="telefono" class="col-sm-3 control-label">Teléfono (*)</label>
						<div class="col-sm-9">
							<input type="text" class="form-control input-sm" name="postulacion[telefono]" id="telefono" placeholder="Teléfono" value="<?php echo $telefono ?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="tecnologias" class="col-sm-3 control-label">Tecnologías (*)</label>
						<div class="col-sm-9">
							<input type="text" class="form-control input-sm" name="postulacion[tecnologias]" id="tecnologias" placeholder="Tecnologías" value="" />
						</div>
					</div>

					<div class="form-group">
						<label for="anios_experiencia" class="col-sm-3 control-label">Años Experiencia (*)</label>
						<div class="col-sm-9">
							<!--<input type="text" class="form-control input-sm" name="postulacion[anios_experiencia]" id="anios_experiencia" placeholder="Años Experiencia" value="<?php echo $anios_experiencia ?>" />-->
							<select class="form-control input-sm" name="postulacion[anios_experiencia]" id="anios_experiencia">
								<option value="">Seleccione</option>
							<?php for($i=0; $i<=60; $i++) { ?>
								<option value="<?php echo $i; ?>" <?php if(isset($anios_experiencia) && $anios_experiencia==$i) { echo "selected"; } ?>><?php echo $i; ?></option>
							<?php	} ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="disponibilidad" class="col-sm-3 control-label">Disponibilidad (*)</label>
						<div class="col-sm-9">
							<input type="text" class="form-control input-sm" name="postulacion[disponibilidad]" id="disponibilidad" placeholder="Disponibilidad" value="<?php echo $disponibilidad ?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="renta_liquida" class="col-sm-3 control-label">Renta Liquida (*)</label>
						<div class="col-sm-9">
							<input type="text" class="form-control input-sm" name="postulacion[renta_liquida]" id="renta_liquida" placeholder="Renta Liquida" value="<?php echo $renta_liquida ?>" />
						</div>
					</div>

					<div class="form-group">
						<label for="curriculum" class="col-sm-3 control-label">Curriculum (*) <small>[Word, Pdf]</small></label>
						<div class="col-sm-9">
							<input type="file" name="curriculum" id="curriculum">
						</div>
					</div>

					<div class="form-group">
						<label for="observaciones" class="col-sm-3 control-label">Observaciones</label>
						<div class="col-sm-9">
							<textarea class="form-control input-sm" name="postulacion[observaciones]" id="observaciones" placeholder="Observaciones"><?php echo $observaciones ?></textarea>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Enviar Postulación</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(document).ready(function() {

		$(function() {
		    var ms = $('#tecnologias').magicSuggest({
		        data: <?php echo $listado_tecnologias; ?>
		    });

		    <?php 
			if(isset($tecnologias)) {
				$tparts = explode(", ", $tecnologias);			
				echo "ms.setValue(['" . implode("','", $tparts) . "']);";
			}
			?>
		});		

	});
</script>