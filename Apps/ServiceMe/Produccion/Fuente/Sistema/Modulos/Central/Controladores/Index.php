<?php

	namespace Controlador\Modulo\Central;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	use \Utilidades\Sesion;
	
	/**
	 * Controlador {Index}
	 * 
	 * El controlador es requerido extenderlo hacia la
	 * clase u objeto ubicado en el namespace \Mvc\Controlador.
	 * 
	 * El controlador debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del controlador debe ser igual a la clase
	 * controlador
	 */
	class Index extends Controlador {
		
		private $sesion;
		
		/**
		 * Index::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del controlador
		 *
		 * @return mixed
		 */
		public function __construct() {
			parent::__construct();
			$this->sesion = new Sesion($this, $this->url, $this->plantilla);
		}

		/**
		 * Index::Index()
		 * 
		 * Metodo necesario para la carga del controlador
		 * el cual es necesario para la carga automatica
		 * del metodo inicial por defecto
		 *
		 * @Permisos("lectura")
		 * @return mixed
		 */
		public function Index() {
		//	echo '<code><pre>';
		//	print_r($this->sesion->infoPermisos());
		//echo $this->plantilla->mostrarPlantilla('Index', 'Prueba.html');	
		echo $this->plantilla->mostrarPlantilla('Index', 'Index.html');
		
			
		}
	}