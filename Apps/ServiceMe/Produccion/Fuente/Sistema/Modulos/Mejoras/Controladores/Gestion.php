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
	 * Controlador {Gestion}
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
	class Gestion extends Controlador {
		
		private $sesion;
		
		/**
		 * Gestion::__construct()
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
		 * Gestion::Index()
		 * 
		 * Genera la visualizacion de la mejora a gestionar
		 * 
		 * @Permisos("actualizar")
		 * @param integer $id 
		 * @return raw
		 */
		public function Index($id = false) {
			
			if(is_numeric($id) == false):
				throw new Excepcion('No es posible visualizar la mejora solicitada', 0, APP);
			endif;
			
			$this->plantilla->parametro('consulta', $this->modelo->consultaMejora($id));
			echo $this->plantilla->mostrarPlantilla('Gestion', 'Index.html');
		}
		
		/**
		 * Gestion::ajaxAprobado()
		 * 
		 * gestiona el proceso de aprobacion del objetivo
		 * de la mejora solicitada
		 * 
		 * @Permisos("actualizar")
		 * @return void
		 */
		public function ajaxAprobado() {
			$this->cabecera->header('json');
			
			if($this->validarFormulario->validar('Formularios\Mejoras\Gestion\AjaxAprobado') == true):
				$estado = $this->modelo->guardarAjaxAprobado((array) $this->validarFormulario->datosFormato());
				echo json_encode(array('status' => true, 'estado' => $estado));
			else:
				echo json_encode(array('status' => false, 'estado' => 'Se ha presentado un error en la aprobacion'));
			endif;
		}
		
		/**
		 * Gestion::ajaxNoAprobado()
		 * 
		 * gestiona el proceso de no aprobacion del objetivo
		 * de la mejora solicitada
		 * 
		 * @Permisos("actualizar")
		 * @return void
		 */
		public function ajaxNoAprobado() {
			//$this->cabecera->header('json');
			
			if($this->validarFormulario->validar('Formularios\Mejoras\Gestion\AjaxNoAprobado') == true):
				$estado = $this->modelo->guardarAjaxNoAprobado((array) $this->validarFormulario->datosFormato(), $this->sesion->infoUsuario('usuario'));
				echo json_encode(array('status' => true, 'estado' => $estado));
			else:
				echo json_encode(array('status' => false, 'estado' => 'Se ha presentado un error en la aprobacion'));
			endif;
		}
		
		/**
		 * Gestion::jsController()
		 * 
		 * Muestra la libreria de js de manejo de las
		 * aprobacion y rechazos de cada uno de los objetivos
		 * 
		 * @Permisos("actualizar")
		 * @return raw
		 */
		public function jsController($archivo = false) {
			
			$this->cabecera->header('js');
			echo $this->plantilla->mostrarPlantilla('Gestion', 'jsController.js');
		}
	}