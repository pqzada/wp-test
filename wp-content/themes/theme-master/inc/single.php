<section>
<?php 
	if (have_posts()){
		while (have_posts()){
			the_post(); 
?>
			<?php if (get_post_type() == 'agenda'){ ?>
				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<h2><?php the_title(); ?></h2>
					<div class="entry">
						<?php the_content(); ?>
					</div>
					</div>
					<?php edit_post_link('Editar Esto','','.'); ?>

				</article>
			<?php }else{ ?>

				<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<h2><?php the_title(); ?></h2>

					<div class="entry">
						<?php
							$categorias = array();
							foreach (get_the_category() as $row) {
								$categorias[]=$row->term_id;
							}

							if (in_array(5, $categorias)){ 
								the_post_thumbnail('interior-largo', array('class'=>'imagen-interior-grande')); 
							}else{
								the_post_thumbnail('interior', array('class'=>'imagen-interior'));
							}
						?>

						<?php the_content(); ?>

					</div>
					<?php edit_post_link('Edit this entry','','.'); ?>
				</article>

			<?php } ?>
</div>
<?php
		}
	}
?>
<!-- </section> -->