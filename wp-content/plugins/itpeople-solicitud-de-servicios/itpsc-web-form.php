<?php

function itpsc_form_func() {

	itpsc_form_handle_post();
   
	ob_start();
	?> 
		<form method="POST">
			<input type="text" name="example">
			<input type="submit" name="submit">		
		</form>

	<?php
	return ob_get_clean();
}

function itpsc_form_handle_post() {

	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
}

?>
