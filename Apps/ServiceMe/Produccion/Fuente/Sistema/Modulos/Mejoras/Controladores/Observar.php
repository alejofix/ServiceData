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
	 * Controlador {Observar}
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
	class Observar extends Controlador {
		
		private $sesion;

		/**
		 * Observar::__construct()
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
		 * Observar::Index()
		 * 
		 * Se crea una visualizacion de los datos correspondientes
		 * a la mejora indicada en caso de que no se ingrese o no exista
		 * se presentara un error en pantalla
		 * 
		 * se muestra la informacion y los objetivos segun el estado de
		 * los mismos objetivos dejando de color rojo a los no aprobados
		 * y en color amarillo los pendientes
		 * 
		 * @Permisos("lectura") 
		 * @return mixed
		 */
		public function Index($id = false) {
			
			if(is_numeric($id) == false):
				throw new Excepcion('No es posible mostrar la información Solicitada', 0, APP);
			endif;
			
			$this->plantilla->parametro('consulta', $this->modelo->consultaMejora($id));
			$this->plantilla->parametro('ruta', $this->modelo->listadoRutas($id));
			echo $this->plantilla->mostrarPlantilla('Observar', 'Index.html');
		}
	}