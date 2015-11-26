
<?php get_header(); ?>

<?php
	if(have_posts()){
		while (have_posts()){
			the_post();
 ?>

	<div class="container page">
		<div class="hidden-xs hidden-sm hidden-md col-lg-4"></div>
		<div class="col-sm-8">
			<?php
				$current_category = get_post(10);
				echo '<h2>'.$current_category->post_title.'</h2>';
			?>
		</div>
	</div>
	<div id="contenido" class="container margin-up-down">
		<div id="home" class="col-xs-12 col-sm-8 col-lg-8">
		<?php
			$ol = get_post_type(array('post_type'=>'ofertalaboral'));
			?>
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h2><?php the_title(); ?></h2>
				<div class="fecha_inicio">
					Publicado el <?php echo get_the_time('d/m/Y'); ?>
				</div>
				<div class="fecha_termino">
					Fecha Cierre:
					<?php
					if(get_field('fecha_de_cierre')){
						$date = DateTime::createFromFormat('Ymd', get_field('fecha_de_cierre'));
						echo $date->format('d/m/Y');
					}else{
						echo "Indefinida";
					}
					?>
				</div>
				<div class="entry">
					<hr>
						<?php the_content(); ?>
					<hr>

					<div class="table-responsive">
					<table class="table table-striped table-condensed" style="font-size: 12px;">
						<tbody>

						<?php if( get_field('descripción') ) { ?>
							<tr>
								<td valign="top">Descripción</td>
								<td><?php echo get_field('descripción'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('requerimientos') ) { ?>
							<tr>
								<td valign="top">Requerimientos</td>
								<td><?php echo get_field('requerimientos'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('sueldo') ) { ?>
							<tr>
								<td valign="top">Sueldo</td>
								<td><?php echo get_field('sueldo'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('tecnologias') ) { ?>
							<tr>
								<td valign="top">Tecnologías</td>
								<td><?php echo implode(", ", get_field('tecnologias')); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('funciones') ) { ?>
							<tr>
								<td valign="top">Funciones</td>
								<td><?php echo get_field('funciones'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('ciudad') ) { ?>
							<tr>
								<td valign="top">Ciudad</td>
								<td><?php echo get_field('ciudad'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('disponibilidad') ) { ?>
							<tr>
								<td valign="top">Disponibilidad</td>
								<td><?php echo get_field('disponibilidad'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('formacion_minima') ) { ?>
							<tr>
								<td valign="top">Formación mínima</td>
								<td><?php echo get_field('formacion_minima'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('anios_experiencia') ) { ?>
							<tr>
								<td valign="top">Años experiencia</td>
								<td><?php echo get_field('anios_experiencia'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('nivel_profesional') ) { ?>
							<tr>
								<td valign="top">Nivel profesional</td>
								<td><?php echo get_field('nivel_profesional'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('tipo_contrato') ) { ?>
							<tr>
								<td valign="top">Tipo contrato</td>
								<td><?php echo get_field('tipo_contrato'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('jornada') ) { ?>
							<tr>
								<td valign="top">Jornada</td>
								<td><?php echo get_field('jornada'); ?></td>
							</tr>
						<?php } ?>

						<?php if( get_field('fecha_cierre') ) { ?>
							<tr>
								<td valign="top">Fecha cierre</td>
								<td><?php echo get_field('fecha_cierre'); ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>	
					</div>				

					<div class="text-center">
						<?php echo do_shortcode('[form_postulacion id_oferta='.get_the_ID().']') ?>
					</div>
				</div>
				<?php edit_post_link('Editar Esto','','.'); ?>
		<?php get_contenido('nav'); ?>
			</article>
		</div>
<?php
	}
}
?>
<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>