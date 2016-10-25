<?php

	/**
	 * Namespace Controlador Modulo
	 * 
	 * Se genera el namespace para el Modulo
	 * el cual se diferencia la carga de la misma
	 * @example namespace Controlador\Modulo\{nombre del modulo}
	 */
	namespace Controlador\Modulo\Formularios;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	
	/**
	 * Controlador {Motivo}
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
	class Motivo extends Controlador {

		/**
		 * Motivo::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del controlador
		 *
		 * @return mixed
		 */
		public function __construct() {
			parent::__construct();
		}

		/**
		 * Motivo::Index()
		 * 
		 * Metodo necesario para la carga del controlador
		 * el cual es necesario para la carga automatica
		 * del metodo inicial por defecto
		 *
		 *  
		 * @return mixed
		 */
		public function Index($tip = false) {
			
			if($this->request->post->existencia('tip') == true):
				$this->validarTipo($tip);
			else:
				echo 'error, Formulario no Seleccionado';
				// print_r($this->validarFormulario->mensajeError());
			endif;
		}
		
		/**
		 * Motivo::validarTipo()
		 * valida si Formulario es Valido is_numeric
		 * 
		 * @return void
		 */
		private function validarTipo($tip = false){
			if(is_numeric($tipo) == true):
				$this->existenciaTipo($tip);
			else:
				echo 'No hay Formulario Valido ...';
			endif;
			
		}
		
		 

	}