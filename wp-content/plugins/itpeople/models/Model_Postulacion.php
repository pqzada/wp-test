<?php

	/**
	*
	*/
	class Model_Postulacion extends Model
	{

		public 	$id_postulacion,
				$id_oferta,
				$nombre,
				$email,
				$telefono,
				$tecnologias,
				$anios_experiencia,
				$disponibilidad,
				$renta_liquida,
				$ext_curriculum,
				$observaciones,
				$aprobado,
				$eliminado
		;

		public function __construct()
		{
			$this->table = 'tb_postulaciones_itpeople';
			$this->pk = 'id_postulacion';
			if ($data = self::get_session_data()) {
				self::set_data($data);
			}
		}

		public function set_data($data)
		{
			if (is_array($data)) {
				$this->id_postulacion    = (isset($data['id_postulacion']))    ? $data['id_postulacion']    : null;
				$this->id_oferta    	 = (isset($data['id_oferta']))    	   ? $data['id_oferta']    	    : null;
				$this->nombre            = (isset($data['nombre']))            ? $data['nombre']            : null;
				$this->email             = (isset($data['email']))             ? $data['email']             : null;
				$this->telefono          = (isset($data['telefono']))          ? $data['telefono']          : null;
				$this->tecnologias       = (isset($data['tecnologias']))       ? $data['tecnologias']       : null;
				$this->anios_experiencia = (isset($data['anios_experiencia'])) ? $data['anios_experiencia'] : null;
				$this->disponibilidad    = (isset($data['disponibilidad']))    ? $data['disponibilidad']    : null;
				$this->renta_liquida     = (isset($data['renta_liquida']))     ? $data['renta_liquida']     : null;
				$this->ext_curriculum    = (isset($data['ext_curriculum']))    ? $data['ext_curriculum']    : null;
				$this->observaciones     = (isset($data['observaciones']))     ? $data['observaciones']     : null;
			}elseif (is_object($data)) {
				$this->id_postulacion    = (isset($data->id_postulacion))      ? $data->id_postulacion   	 : null;
				$this->id_oferta    	 = (isset($data->id_oferta))      	   ? $data->id_oferta   	 	 : null;
				$this->nombre            = (isset($data->nombre))              ? $data->nombre           	 : null;
				$this->email             = (isset($data->email))               ? $data->email            	 : null;
				$this->telefono          = (isset($data->telefono))            ? $data->telefono         	 : null;
				$this->tecnologias       = (isset($data->tecnologias))         ? $data->tecnologias          : null;
				$this->anios_experiencia = (isset($data->anios_experiencia))   ? $data->anios_experiencia	 : null;
				$this->disponibilidad    = (isset($data->disponibilidad))      ? $data->disponibilidad   	 : null;
				$this->renta_liquida     = (isset($data->renta_liquida))       ? $data->renta_liquida    	 : null;
				$this->ext_curriculum    = (isset($data->ext_curriculum))  	   ? $data->ext_curriculum       : null;
				$this->observaciones     = (isset($data->observaciones))       ? $data->observaciones    	 : null;
			}

			// Transformacion tecnologias
			if(is_array($this->tecnologias)) {
				$this->tecnologias = implode(", ", $this->tecnologias);
			}
		}

		public function save()
		{
			$this->id_postulacion = parent::_save(self::data_to_array());
			return $this->id_postulacion;
		}

		public function get($id)
		{
			# code...
		}

		public function get_custom($sql)
		{
			return parent::_get_custom($sql);
		}

		public function validate()
		{
			$data = self::data_to_array();
			$rules = array(
				'id_oferta'    => array(
					'label' => 'Id Oferta',
					'type'=>'numeric',
					'required'=>true,
					'min'=>1,
					'max'=>9999999999,
					'trim'=>true
				),
				'nombre'            => array(
					'label' => 'Nombre',
					'type'=>'string',
					'required'=>true,
					'min'=>5,
					'max'=>255,
					'trim'=>true
				),
				'email'             => array(
					'label' => 'E-Mail',
					'type'=>'email',
					'required'=>true,
					'min'=>5,
					'max'=>255,
					'trim'=>true
				),
				'telefono'          => array(
					'label' => 'Teléfono',
					'type'=>'string',
					'required'=>true,
					'min'=>5,
					'max'=>255,
					'trim'=>true
				),
				'tecnologias'          => array(
					'label' => 'Tecnologías',
					'type'=>'string',
					'required'=>false,
					'min'=>0,
					'max'=>255,
					'trim'=>true
				),
				'anios_experiencia' => array(
					'label' => 'Años de Experiencia',
					'type'=>'string',
					'required'=>true,
					'min'=>1,
					'max'=>255,
					'trim'=>true
				),
				'disponibilidad'    => array(
					'label' => 'Disponibilidad',
					'type'=>'string',
					'required'=>true,
					'min'=>1,
					'max'=>255,
					'trim'=>true
				),
				'renta_liquida'     => array(
					'label' => 'Renta Líquida',
					'type'=>'numeric',
					'required'=>true,
					'min'=>0,
					'max'=>9999999999,
					'trim'=>true
				),
				'ext_curriculum'        => array(
					'label' => 'Curriculum',
					'type'=>'string',
					'required'=>false,
					'min'=>1,
					'max'=>4,
					'trim'=>true
				),
				'observaciones'     => array(
					'label' => 'Observaciones',
					'type'=>'string',
					'required'=>false,
					'min'=>1,
					'max'=>5000,
					'trim'=>true
				),
			);
			return parent::_validate($data, $rules);
		}

		private function data_to_array()
		{
			$data = array(
				'id_postulacion'    => $this->id_postulacion,
				'id_oferta'    		=> $this->id_oferta,
				'nombre'            => $this->nombre,
				'email'             => $this->email,
				'telefono'          => $this->telefono,
				'tecnologias'       => $this->tecnologias,
				'anios_experiencia' => $this->anios_experiencia,
				'disponibilidad'    => $this->disponibilidad,
				'renta_liquida'     => $this->renta_liquida,
				'ext_curriculum'    => $this->ext_curriculum,
				'observaciones'     => $this->observaciones,
			);
			return $data;
		}

		public function get_session_data()
		{
		 	return parent::_get_session_data();
		}
		
		public function set_session_data()
		{
		 	$data = self::data_to_array();
			// m_array($data,0,1);
		 	parent::_set_session_data($data);
		}

	}

?>