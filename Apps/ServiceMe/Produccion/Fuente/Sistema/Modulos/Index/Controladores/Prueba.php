<?php


	namespace Controlador\Modulo\Index;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	
		class Prueba extends Controlador {

			public function __construct() {
				parent::__construct();
	
			}
			
			public function Index() {
				
				
				
				
			}
	}
	
	
	
			/**
				$archivo = $_FILES['adj'];
				$nombre = (empty($archivo['name']) == false) ? md5($archivo['name']).pathinfo($archivo['name'], PATHINFO_EXTENSION) : null;
				
				if($archivo['error'] == 0):
					move_uploaded_file($archivo['tmp_name'], $this->adjunto.DIRECTORY_SEPARATOR.$nombre);
				endif;
		*/