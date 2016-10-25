<?php

	/**
	 * Namespace Controlador Modulo
	 * 
	 * Se genera el namespace para el Modulo
	 * el cual se diferencia la carga de la misma
	 * @example namespace Controlador\Modulo\{nombre del modulo}
	 */
	namespace Controlador\Modulo\Mejoras;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	use \Utilidades\Sesion;
	
	
	/**
	 * Controlador {Listado}
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
	class Listado extends Controlador {

		/**
		 * Listado::__construct()
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
		 * Listado::Index()
		 * 
		 * Se genera el listado donde los aliados pueden
		 * observar las diferentes mejoras solicitadas
		 * por empresa
		 *
		 * @Permisos("lectura") 
		 * @return mixed
		 */
		public function Index() {
			
			$this->plantilla->parametro('consulta', $this->modelo->Listado($this->sesion->infoUsuario('em_id')));
			echo $this->plantilla->mostrarPlantilla('Listado', 'Index.html');
		}
	}