<?php

	/**
	 * Namespace Controlador Modulo
	 * 
	 * Se genera el namespace para el Modulo
	 * el cual se diferencia la carga de la misma
	 * @example namespace Controlador\Modulo\{nombre del modulo}
	 */
	namespace Controlador\Modulo\Comunicacion;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	use \Utilidades\Sesion;
	
	/**
	 * Controlador {Alto_Impacto}
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
	class Alto_Impacto extends Controlador {

		/**
		 * Alto_Impacto::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del controlador
		 * 
		 * @Permisos("escritura")	
		 * @return mixed
		 */
		public function __construct() {
			parent::__construct();
			$this->sesion = new Sesion($this, $this->url, $this->plantilla);
		}

		/**
		 * Alto_Impacto::Index()
		 * 
		 * Metodo necesario para la carga del controlador
		 * el cual es necesario para la carga automatica
		 * del metodo inicial por defecto
		 *
		 * 
		 * @Permisos("escritura") 
		 * @return mixed
		 */
		public function Index() {
		
			echo $this->plantilla->mostrarPlantilla('Alto_Impacto', 'Index.html');
				
		}
		
		/**
		 * Alto_Impacto::Listado()
		 * 
		 * Metodo necesario para la carga del controlador
		 * el cual es necesario para la carga automatica
		 * del metodo inicial por defecto
		 *
		 * 
		 * @Permisos("escritura") 
		 * @return mixed
		 */
		public function Listado() {
		
			echo $this->plantilla->mostrarPlantilla('Alto_Impacto', 'Listado.html');
				
		}
	}