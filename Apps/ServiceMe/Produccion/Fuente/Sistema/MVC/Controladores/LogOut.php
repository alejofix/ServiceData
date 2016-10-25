<?php

	/**
	 * Namespace Controlador MVC
	 * 
	 * Se genera el namespace para el MVC
	 * el cual se diferencia la carga de la misma
	 * @example namespace Controlador\MVC
	 */
	namespace Controlador\MVC;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	use \Neural\Sesion\SesionPHP;
	
	/**
	 * Controlador {LogOut}
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
	class LogOut extends Controlador {

		/**
		 * LogOut::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del controlador
		 *
		 * @return mixed
		 */
		public function __construct() {
			parent::__construct();
			$sesion = new SesionPHP(APP, date("Y-m-d"));
			$sesion->finalizar();
		}

		/**
		 * LogOut::Index()
		 * 
		 * Metodo necesario para la carga del controlador
		 * el cual es necesario para la carga automatica
		 * del metodo inicial por defecto
		 *
		 *  
		 * @return mixed
		 */
		public function Index() {
			$this->cabecera->redireccion($this->ruta->modulo('Index'));
			exit();
		}
	}