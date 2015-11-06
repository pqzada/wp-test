<?php 
	
	/**
	* Maneja los modelos
	*/
	class Model
	{

		public 	$table,
				$pk,
				$wpdb,
				$last_query,
				$valid,
				$session_data_name
		;


		static function _load($model)
		{
			include_once (plugin_dir_path( __FILE__ ).$model.'.php');
			return new $model;
		}

		private function _get_db($value='')
		{
			if (!$this->wpdb) {
				global $wpdb;
				$this->wpdb = $wpdb;
			}
			return $this->wpdb;
		}

		public function _save($data, $id = null, $format = null)
		{
			if ($id) {
				// update
				$where = array($pk => $id);
				self::_get_db()->update($this->table, $data, $where, $format);
				self::_set_last_query();
				return $id;
			}else{
				// insert
				self::_get_db()->insert($this->table, $data, $format);
				self::_set_last_query();
				return self::_get_db()->insert_id;
			}
		}

		public function _get($id = null)
		{
			$sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->pk . ' = ' . $id;
			$result = self::_get_db()->get_results($sql);
			self::_set_last_query();
			return $result;
		}

		public function _get_custom($sql)
		{
			$result = self::_get_db()->get_results($sql);
			self::_set_last_query();
			return $result;
		}

		public function _validate($data, $rules_array = array())
		{
			$val = new validation();
			$val->addSource($data);
			$val->AddRules($rules_array);
			$val->run();
			// exit();
			if(sizeof($val->errors) > 0){
				$this->valid = false;
		        return($val->errors);
		    }else{
		    	$this->valid = true;
		    	return $val->sanitized;
		    }
		}

		private function _set_last_query()
		{
			$this->last_query = array(
				'last_query' => self::_get_db()->last_query,
				'last_error' => self::_get_db()->last_error
			);
		}

		public function _last_query()
		{
			return $this->last_query;
		}

		public function _set_session_data($data)
		{
			$_SESSION[$this->data_name] = $data;
		}

		public function _get_session_data()
		{
			if(isset($_SESSION[$this->session_data_name])){
				$data = $_SESSION[$this->session_data_name];
				unset($_SESSION[$this->session_data_name]);
				return $data;
			}
		}

	}

?>