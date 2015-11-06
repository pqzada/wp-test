<?php
	/*
	Plugin Name: ItPeople
	Description: ItPeople
	Plugin URI: http://www.anacondaweb.com
	Author: Zalongo
	Author URI: http://www.anacondaweb.com
	Version: 1.0
	*/

	session_start();

	include 'models/Model.php';
	include 'controllers/Controller.php';
	include 'models/Validation.php';
	include 'models/Upload.php';
	include 'models/Correos.php';

	include 'controllers/Postulacion.php';

	include 'models/Model_Postulacion.php';
	class ItPeople
	{

		public $postulacion;

		function __construct()
		{
			$this->postulacion = new Postulacion();
			add_action('init', array($this, 'authorNotification') );
		}

		function authorNotification() {
			if(isset($_POST['post_type']) && $_POST['post_type'] == 'ofertalaboral' && $_POST['action'] == 'editpost' && $_POST['original_post_status'] == 'pending' && $_POST['publish'] == 'Publicar' && $_POST['visibility'] == 'public'){
				$post = get_post($_POST['post_ID']);
				$author = get_userdata($post->post_author);

				$message = '
				<p>Hola '.$author->display_name.',</p>
				<p>Su Oferta, '.$post->post_title.' ha sido publicada y puede encontrarla en el siguiente link <a href="'.get_permalink( $_POST['post_ID'] ).'">'.get_permalink( $_POST['post_ID'] ).'</a>. </p>';
				$correo = new Correos(null, $author->user_email, 'Su oferta ha sido publicada');
				$correo->send($message);
			}

		}

	}

	$ItPeople = new ItPeople();
?>