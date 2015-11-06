<link rel='stylesheet' id='bootstrap-stylesheet-css'  href='http://www.perdimisdocumentos.dv/wp-content/themes/perdimisdocumentos.cl/css/bootstrap.min.css?ver=3.2.0' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-theme-stylesheet-css'  href='http://www.perdimisdocumentos.dv/wp-content/themes/perdimisdocumentos.cl/css/bootstrap-theme.min.css?ver=3.2.0' type='text/css' media='all' />
<script type='text/javascript' src='http://www.perdimisdocumentos.dv/wp-content/themes/perdimisdocumentos.cl/js/bootstrap.min.js?ver=3.2.0'></script>

<script type="text/javascript">
jQuery(document).ready(function($) {

	var numImage = '';

	$(".add_media").click(function(event) {
		numImage = $(this).attr('data-editor');
	});

	window.send_to_editor = function(html) {
		thumb = $('img',html).attr('src');
		imagenAux = $('img',html);
		imagenAux.removeClass('alignnone size-medium size-full');
		idImage = imagenAux.attr('class');
		idImage = idImage.replace('wp-image-', '');
		imagen = $('img',html).parent('a').attr('href');
		$('#imagen_'+numImage).val(idImage);
		console.log(idImage);
		$("#imagen_preview_"+numImage).html($('<img>').attr('src',thumb));
		tb_remove();
	}
});
</script>

<?php
global $opciones_tema;
if ( $_REQUEST['saved'] ) $mensaje = '<div class="alert alert-success" role="alert">Opciones Guardadas <i class="glyphicon glyphicon-ok"></i></div>';
?>

<div class="wrap">
	<div id="config">
		<h2>Opciones del Tema</h2>
		<div class="content">

			

			<div class="row">
				<div class="col-xs-10">
					<?php echo (isset($mensaje)) ? $mensaje : ''; ?>
					<form class="form-horizontal" role="form" name="config" method="post" action="<?php $_SERVER['REQUEST_URI']; ?>">
						
						<input type="hidden" name="action" value="save" />

						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<?php $cont = 1; foreach ($opciones_tema as $nomTab => $tab){ ?>
								<li <?php echo $cont==1?'class="active"':''; ?>><a href="#<?php echo $tab['id'] ?>" role="tab" data-toggle="tab"><?php echo $nomTab ?></a></li>
							<?php $cont++; } ?>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
						<?php $grobalCont = 1; $cont = 1; foreach ($opciones_tema as $tab){ ?>
							<div class="tab-pane <?php echo $cont==1?'active':''; ?>" id="<?php echo $tab['id'] ?>">
								<?php foreach ($tab['inputs'] as $input => $data){ ?>
								<div class="form-group">
									<label for="<?php echo $input ?>" class="col-sm-2 control-label"><?php echo $data['label'] ?></label>
									<div class="col-sm-10">
										<?php if ($data['required']){ $required = 'required'; } ?>
										<?php if ($data['class'] == 'imagen'){ ?>
										<?php $imagen = unserialize(get_option($input)); ?>
										<div class="contiene-imagen">
											<div class="imagen-preview" id="imagen_preview_<?php echo $grobalCont ?>"><?php echo is_array($imagen) ? wp_get_attachment_image( $imagen['imagen'], array(300,300) ) : ''; ?></div>
											<?php do_action( 'media_buttons', $grobalCont ); ?><input type="hidden" id="imagen_<?php echo $grobalCont ?>" name="imagen_<?php echo $input ?>" value="<?php echo $imagen['imagen'] ?>" />
											<input type="text" id="link_<?php echo $input ?>" name="link_<?php echo $input ?>" class="form-control" placeholder="Link" value="<?php echo $imagen['link'] ?>" />
										</div>
										<?php }else{ ?>
											<?php
											switch ($data['tag']) {
												case 'input':
													echo '<input type="'.$data['type'].'" class="form-control" id="'.$input.'" name="'.$input.'" placeholder="'.$data['label'].'" value="'.get_option($input).'" '.$required.' />';
													break;

												case 'textarea':
													echo '<textarea class="form-control" id="'.$input.'" name="'.$input.'" placeholder="'.$data['label'].'" '.$required.'>'.stripslashes(get_option($input)).'</textarea>';
													break;
											
												default:
													# code...
													break;
											}
											?>
										<?php } ?>
									</div>
								</div>	
								<?php $grobalCont++; } ?>

								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-default">Guardar</button>
									</div>
								</div>
							</div>
						<?php $cont++; } ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>