<?php
/*
Template Name: Ofertas Laborales
*/
?>

<?php get_header(); ?>
		<div class="container page">
			<div class="hidden-xs hidden-sm hidden-md col-lg-4"></div>
			<div class="col-sm-8">
				<?php
					$current_category = get_post(10);
					echo '<h2>'.$current_category->post_title.'</h2>';
				?>
			</div>
		</div>

		<section id="contenido" class="container margin-up-down">
			<div id="home" class="col-xs-12 col-sm-8 col-lg-8">
			 	<?php the_post_thumbnail( '', array( 'class' => 'img-responsive' ) ); ?>
	<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => 'ofertalaboral',
			'paged' => $paged,
			'posts_per_page' => 9,
			'meta_query'	=> array(
				array(
					'key' => 'fecha_de_cierre',
					'value' => date('Ymd'),
					'compare' => '>=',
				),
			),
		);
		wp_reset_query();
		$oferta_laboral = query_posts($args);
		$cont = 1;
			if (have_posts()) {
				while (have_posts()) {
					the_post();
					// $id_pagina = get_the_id();
			?>
			<?php if($cont == 1){ ?>
					<div id="tabla">
						<table>
							<tr class="encabezado">
								<td>Codigo</td>
								<td>Trabajo</td>
								<td>Fecha Cierre</td>
							</tr>
	 						<?php foreach ($oferta_laboral as $oferta){ ?>
							<tr>
								<td><?php echo str_replace('', '', $oferta->ID); ?></td>
								<td>
								<a href="<?php echo get_permalink($oferta->ID); ?>">
								<?php echo limitarCaracteres($oferta->post_title, 80); ?>
								</td>
								</a>
								<td>
									<?php
									if(get_field('fecha_de_cierre')){
										$date = DateTime::createFromFormat('Ymd', get_field('fecha_de_cierre'));
										echo $date->format('d/m/Y');
									}else{
										echo "Indefinida";
									}
									?>
								</td>
							</tr>

	 					<?php } ?>
						</table>
		 		</div>
		 		<?php } ?>
					<?php $cont++;?>
		 <?php
	 			}
	 		}
		  ?>
		<?php get_contenido('nav'); ?>
	</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>