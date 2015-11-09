<?php

/**
 * Creación de meta_box tecnologías
 */
function itpt_meta_boxes() {

	add_meta_box( "itpt-meta-box", "Tecnologías", "itpt_meta_box_callback", "ofertalaboral", "normal", "high" );

}

/**
 * Callback de meta_box itpt-meta-box
 *
 * @param mixed[] $post Post
 */
function itpt_meta_box_callback( $post ) {

	// Seguridad
	wp_nonce_field( 'itpt_meta_box', 'itpt_meta_box_noncename' );

	// Obtengo meta actuales
	$post_meta = get_post_custom($post->ID);

	// Obtengo tecnologías del post
	$post_meta_tecnologias = "";
	if( isset( $post_meta['tecnologias'] ) ) {

		$post_meta_tecnologias = unserialize( $post_meta['tecnologias'][0] );

	}

	// Obtengo listado completo de tecnologías
	$tecnologias = itpt_get_tecnologias();

	// Inicio HTML
	echo '<ul class="ofertalaboral-listado-tecnologias">';

	// Genero checkbox de tecnologias	
	foreach( $tecnologias as $t ) {

		// Defino checked por cada una
		$checked = "";
		if( is_array( $post_meta_tecnologias ) && in_array( $t->nombre, $post_meta_tecnologias ) ) {

			$checked = 'checked="checked"';

		}
		?>		
		<li>
			<input type="checkbox" name="itpt_nombre[]" id="itpt_nombre" value="<?php echo $t->nombre; ?>" <?php echo $checked; ?>>
          	<label for="itpt_nombre"><?php echo $t->nombre; ?></label>
		</li>

		<?php 

	}

	echo "</ul>";
	// Fin HTML

	// Inicio CSS
	?>
		<style>
			ul.ofertalaboral-listado-tecnologias li {
			    width: 24%;
			    display: inline-block;
			    line-height: 15px;
			}

			ul.ofertalaboral-listado-tecnologias li input {
			    margin: 0px;
			}
		</style>
	<?php	
	// Fin CSS

}

/**
 * Guardo meta_box de tecnologia
 *
 * @param int $post_id ID Post
 * @param mixed[] $post Post
 */
function itpt_save_meta_box_tecnologias( $post_id, $post ) {

    // Seguridad: Valido tipo de post y permisos de edición
    if ( 'ofertalaboral' != $post->post_type || !current_user_can( 'edit_post', $post_id ) ) {   

        return;

    }

    // Seguridad: Compruebo nonce
    if ( !isset( $_POST['itpt_meta_box_noncename'] ) || ! wp_verify_nonce( $_POST['itpt_meta_box_noncename'], 'itpt_meta_box' ) ) {       
        return;
    }

    // Elimino actual meta_box de tecnologias
    delete_post_meta( $post_id, "tecnologias" );

    // Registro nueva meta_box de tecnologias
    add_post_meta( $post_id, "tecnologias", $_POST['itpt_nombre'], true );
	
}

?>