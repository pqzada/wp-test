
	<footer class="container">
		<div class="row">
			<div class="col-sm-2 text-center" style="padding:0;"><h2>Nuestros estándares</h2></div>
			<div class="col-sm-2 text-center"><a href="http://www.eiccoalition.org/" target="_blank"><img src="/wp-content/uploads/2015/06/EICC_logo.gif" width="112" height="39" alt="" /></a></div>
			<div class="col-sm-8 text-center"></div>												
		</div>

		<div class="row">
			<div class="col-sm-2 text-center"><a href="../trabajo">trabajo</a></div>
			<div class="col-sm-2 text-center"><a href="../salud-y-seguridad">salud y seguridad</a></div>
			<div class="col-sm-3 text-center"><a href="../condiciones-medioambientales">condiciones medioambientales</a></div>
			<div class="col-sm-2 text-center"><a href="../etica">ética</a></div>
			<div class="col-sm-3 text-center"><a href="../sistema-de-gestion/">sistema de gestión</a></div>
		</div>
		<div class="foot pull-right margin-up">
			<?php
				$rsocial_uno = of_get_option("ruta-uno");
				$rsocial_dos = of_get_option("ruta-dos");
				$rsocial_tres = of_get_option("ruta-tres");
				$logors_uno = of_get_option("redsocial-uno");
				$logors_dos = of_get_option("redsocial-dos");
				$logors_tres = of_get_option("redsocial-tres");
			 ?>
			 <div class="bloque_redessociales">
			 	<a href="<?php echo $rsocial_uno; ?>" target="_blank"><img src="<?php echo $logors_uno['image']; ?>" alt="logo" /></a>
			 	<a href="<?php echo $rsocial_dos; ?>" target="_blank"><img src="<?php echo $logors_dos['image']; ?>" alt="logo" /></a>
			 	<a href="<?php echo $rsocial_tres; ?>" target="_blank"><img src="<?php echo $logors_tres['image']; ?>" alt="logo" /></a>
			 </div>
			 <div class="bloque_acceso acceso">
			 	| <a href="../wp-admin"><img src="/wp-content/themes/theme-master/images/pie_icono_acceso.png"> Acceso</a>
			 </div>
		</div>
	</footer>
		<div class="container creador text-center margin-down">
		<!-- 	<a href="http://www.anacondaweb.com/" target="_blank">
				Creado por Anacondaweb
			</a>
		</div> -->
		<?php wp_footer(); ?>
			</div>
	</div> <!-- cierre Todo -->
	</body>
</html>
