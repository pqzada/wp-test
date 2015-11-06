
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
					<div class="table-reponsive">
						<!-- <div class="ficha-tecnica"> -->
							<div class="col-sm-12 margin-up-down">
								<h4>Sueldo</h4>
							</div>
							<div class="col-sm-12 margin-up-down">
								<?php echo get_field('sueldo'); ?>
							</div>
							<div class="col-sm-12 margin-up-down">
								<h4>Descripción</h4>
							</div>
							<div class="col-sm-12 margin-up-down">
								<?php echo get_field('descripción'); ?>
							</div>
							<div class="col-sm-12 margin-up-down">
								<h4>Requerimientos</h4>
							</div>
							<div class="col-sm-12 margin-up-down">
								<?php echo get_field('requerimientos'); ?>
							</div>
						<!-- </div> -->
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