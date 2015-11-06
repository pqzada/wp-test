<?php
	/**
	* Padre de los controladores
	*/
	class Controller
	{

		public 	$models,
				$error,
				$mensaje
		;

		function __construct()
		{
			$this->error = $this->mensaje = array();
			if(isset($_SESSION['error']) && $_SESSION['error']){
				$this->error = $_SESSION['error'];
			}
			if(isset($_SESSION['mensaje']) && $_SESSION['mensaje']){
				$this->mensaje = $_SESSION['mensaje'];
			}
		}


		public function render($view, $variables=array(), $return = false)
		{
			if ($return) {
				ob_start();
			}
			extract($variables);
			include_once (plugin_dir_path( __FILE__ ).'../views/'.$view.'.php');
			if ($return) {
				$resp = ob_get_contents();
				ob_end_clean();
				return $resp;
			}
		}

		public function model($model, $args = null)
		{
			if (!isset($this->models[$model])) {
				$this->models[$model] = Model::_load($model);
				if (is_array($args)) {
					foreach ($args as $arg => $val) {
						$this->models[$model]->$arg = $val;
					}
				}
			}
			return $this->models[$model];
		}

		public function set_error($error)
		{
			if (is_array($error)) {
				$this->error = array_merge($this->error, $error);
			}else{
				$this->error[] = $error;
			}
			$_SESSION['error'] =  $this->error;
		}


		public function set_mensaje($mensaje)
		{
			if (is_array($mensaje)) {
				$this->mensaje = array_merge($this->mensaje, $mensaje);
			}else{
				$this->mensaje[] = $mensaje;
			}
			$_SESSION['mensaje'] =  $this->mensaje;
		}
		
		public function get_mensaje()
		{
			$mensaje = $this->mensaje;
			$this->mensaje = array();
			unset($_SESSION['mensaje']);
			return $mensaje;
		}

		public function get_error()
		{
			$error = $this->error;
			$this->error = array();
			unset($_SESSION['error']);
			return $error;
		}
	}
?>