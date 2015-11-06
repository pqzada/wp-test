<div class="container-fluid padding-cero">
	<section id="slide-home">
		<?php get_contenido('slide'); ?>
	</section>
	<section id="relevantes" class="col-sm-12 text-center margin-up">
		<div class="container">
			<div class="col-sm-4"><a href="../nuestros-servicios">seleccion</a></div>
			<div class="col-sm-4"><a href="../nuestros-servicios">staffing</a></div>
			<div class="col-sm-4"><a href="../nuestros-servicios">trabajadores temporales</a></div>
		</div>
	</section>
</div>
<section id="contenido" class="container margin-up-down">
	<?php
		wp_reset_query();
		$servicios = get_page(5);
		$ofertas = get_page(10);
		$servicios_extra = of_get_option('servicios');
		$ofertas_extra = of_get_option('ofertas');
		$servicios_img = of_get_option('fondo-servicio');
		$ofertas_img = of_get_option('fondo-oferta');
	 ?>
<div id="home" class="col-xs-12 col-sm-8 col-lg-8">
<section id="servicios">
	<div class="fondo-texto hidden-xs">
		<img src="/wp-content/themes/theme-master/images/servicios_fondo_11.png" alt="">
	</div>
	<div class="servicios_bloque" style="background: url('<?php echo $servicios_img['image']; ?>') no-repeat;">
		<div class="pull-right enunciado">
			<a href="<?php echo get_permalink($servicios->ID); ?>">
				<h2><?php echo str_replace('', '', $servicios->post_title); ?></h2>
				<?php echo $servicios_extra; ?>
			</a>
		</div>
	</div>
</section>
<section id="ofertas" class="margin-up-down">
	<div class="fondo-texto hidden-xs">
		<img src="/wp-content/themes/theme-master/images/ofertas_fondo_11.png" alt="">
	</div>
	<div class="ofertas_bloque" style="background: url('<?php echo $ofertas_img['image']; ?>') no-repeat right;">
		<div class="pull-left enunciado padding-left-right">
			<a href="<?php echo get_permalink($ofertas->ID); ?>">
				<h2><?php echo str_replace('', '', $ofertas->post_title); ?></h2>
				<?php echo $ofertas_extra; ?>
			</a>
		</div>
	</div>
</section>
</div>

<!-- </section> -->