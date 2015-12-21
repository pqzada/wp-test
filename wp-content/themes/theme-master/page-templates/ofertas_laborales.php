<?php
/*
Template Name: Ofertas Laborales
*/
?>

<?php get_header(); ?>
		<div class="container page">
			<div class="hidden-xs hidden-sm hidden-md col-lg-4"></div>
			<div class="col-xs-12">
				<center><h2>Ofertas de Empleos</h2></center>
			</div>
		</div>

		<section id="contenido" class="container margin-up-down">
			<div id="home" class="col-xs-12">
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

					if(is_mobile()) {
						$args['posts_per_page'] = 1000;
					}

					wp_reset_query();
					$oferta_laboral = query_posts($args);

					$bg = array(0 => 'gray', 1 => 'orange', 2 => 'white');

					$cont = 1;
					if (have_posts()) {
						while (have_posts()) {
							the_post();

							$idx = 0;
							foreach ($oferta_laboral as $oferta) {								
								$post_meta = get_post_custom($oferta->ID);
?>

<div class="row oferta_laboral <?php echo $bg[$idx%3]; ?>">

	<div class="col-xs-7 title">
		<a href="<?php echo get_permalink($oferta->ID); ?>">
			<?php echo $oferta->post_title; ?>
		</a>
	</div>

	<div class="col-xs-5 tecnologias">
		<?php 
			if(isset($post_meta['tecnologias'])) {
				echo "Tecnologías: " . implode(", ", unserialize($post_meta['tecnologias'][0]));
			}
		?>
	</div>

	<div class="col-xs-7 info">
		<?php 
			if(isset($post_meta['disponibilidad'])) {
				echo "Disponibilidad: " . $post_meta['disponibilidad'][0];
			}

			if(isset($post_meta['sueldo']) && $post_meta['sueldo'][0] != "") {
				echo " | " . $post_meta['sueldo'][0];
			}

			if(isset($post_meta['tipo_contrato']) && $post_meta['tipo_contrato'][0] != "") {
				echo " | Contrato: " . $post_meta['tipo_contrato'][0];
			}
		?>
	</div>

	<div class="col-xs-5 formacion">
		<?php
		if(isset($post_meta['formacion_minima']) && $post_meta['formacion_minima'][0] != "") {
			echo "Carrera(s): <i>" . $post_meta['formacion_minima'][0] . "</i>";
		}
		?>
	</div>

</div>

<?php							
								$idx++;	

							}

		 				break;

		 				} 
	 				}
	 			
		  		?>
				<?php get_contenido('nav'); ?>
			</div>
		</section>

<?php get_footer(); ?>