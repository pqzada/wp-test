<?php 
if (have_posts()){
	while (have_posts()){
		the_post();	?>
			<div class="container page">
				<div class="hidden-xs hidden-sm hidden-md col-lg-4"></div>
				<div class="col-sm-8">
					<?php
						$id = get_the_id();
						$test =	wp_get_post_parent_id( $id );
						$parent_post_id = $test;
						$parent_post = get_post($parent_post_id);
						$parent_post_title = $parent_post->post_title;
					?>
					<h2><?php echo $parent_post_title; ?></h2>
				</div>
			</div>
			<section id="contenido" class="container">
				<div id="home" class="col-xs-12 col-sm-8 col-lg-8">
					<section class="interior">
						<article class="post" id="post-<?php the_ID(); ?>">
							<div class="entry">
								<div class="contenido-pagina">
									<?php the_post_thumbnail('full', array('class'=>'img-responsive')); ?>
									<h2><?php the_title(); ?></h2>
									<?php the_content(); ?>
								</div>
								<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
							</div>
							<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
						</article>
						<?php
					}
				}
				?>
			</section>
		</div>