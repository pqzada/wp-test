<?php 
	$args = array('post_type' => 'slide');
	wp_reset_query();
	query_posts($args);
	$primero = true;
	$cont = 0;
 ?>

			<div id="slide" class="carousel slide block-home" data-ride="carousel">
				<div class="carousel-inner">
					<?php 
					if (have_posts()){
						while(have_posts()){
							the_post();
					?>
					<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' ); ?>
					<div class="item <?php echo $primero ? 'active' : '' ?>">
						<div style="background: url('<?php echo $src[0]; ?>') no-repeat center; height: 200px ; width: 100%;"></div>
						<!-- <?php the_post_thumbnail('full', array('class'=>'img-responsive img-slide')) ?> -->
					</div>
					<?php
							$primero = false; 
						}
					} 
					$primero = true;
					?>
				</div>
				<div class="container">
				<div class="contenido-slide">
					<div class="titulo">
						<?php the_title(); ?>
					</div>
					<div class="texto">
						<?php the_content(); ?>
					</div>
				</div>
					
				</div>
					<ol class="carousel-indicators hidden-xs">
						<?php 
						if (have_posts()) {
							while (have_posts()) {
								the_post();
						?>
						<li <?php echo $primero ? 'class="active"' : '' ?> data-slide-to="<?php echo $cont ?>" data-target="#slide"></li>
						<?php
							$cont++;
							$primero = false;
							}
						}
						?>
					</ol>
			</div>