<div class="col-xs-12 col-sm-4 col-lg-4" id="sidebar">
	<?php
	if (!is_front_page()) {
			if (get_field('menu')) 
			{
				$eicc_id_mostrar = array(277,280,283,286,289);
				if (in_array(get_the_id(), $eicc_id_mostrar))
					echo '<div><a href="http://www.eiccoalition.org/" target="_blank"><img style="position:absolute; margin-top: -44px;" src="/wp-content/uploads/2015/06/EICC_logo.gif" width="112" height="39" alt="" /></a></div>';
				
				echo '<div class="menu-sidebar">';
				echo 	get_field('menu', get_the_id());
				echo '</div>';
			}
			elseif(is_single(get_the_id()))
			{
				$image = get_field('imagen');
				if( !empty($image) )
				{
					echo "<div>";
						echo "<img class='img-responsive' src=".$image['url']." alt=".$image['alt']." />";
					echo "</div>";
				}
			}
	}
	elseif(get_post_type() == 'ofertalaboral'){
				$page = get_page(10);
				$img = get_field('imagen_lateral', $page->ID);
				if( !empty($img) ){
					echo "<div>";
						echo "<img class='img-responsive' src=".$img['url']." alt=".$img['alt']." />";
					echo "</div>";
				}
	}
	?>
	<div class="titulo text-center">
		<h2>
			<strong>
				Únete a la RED de
			</strong>
			<br>
			<span>empleo</span>
			itPeople:
		</h2>
	</div>
	 <div class="ofertas">

	 	<?php

			$args = array(
				'post_type'=>'ofertalaboral',
				'posts_per_page'=>6,
				'meta_query' => array(
					array(
						'key' => 'fecha_de_cierre',
						'value' => date('Ymd'),
						'compare' => '>=',
						),
					),
				);
			$datos = query_posts($args);
	 		if(have_posts()){
	 			while (have_posts()) {
	 				the_post();
	 	?>
			<li class="vacantes">
				<a href="<?php echo get_permalink($datos->ID); ?>">
				<?php
					the_title();
					?>
				</a>
			</li>
	 	<?php
	 			}
	 		}
	 	 ?>
	 </div>
</div>
</section>
