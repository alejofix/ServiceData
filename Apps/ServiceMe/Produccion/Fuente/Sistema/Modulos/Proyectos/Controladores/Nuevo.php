<?php

	/**
	 * Namespace Controlador Modulo
	 * 
	 * Se genera el namespace para el Modulo
	 * el cual se diferencia la carga de la misma
	 * @example namespace Controlador\Modulo\{nombre del modulo}
	 */
	namespace Controlador\Modulo\Proyectos;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	use \Utilidades\Sesion;
	
	/**
	 *  PHP formulario:desarrollo
	 * 
	 * 	ServiceMe POST Proyectos:Nuevo nom:nombre:requerido,maxcaracteres fec:fecha:requerido,fecha fecini:fecha_inicio:fecha fecfin:fecha_fin:fecha des:descripcion:requerido,maxcaracteres tip:tipo:requerido hor:horas:requerido,maxcaracteres usuape:usuario_apertura:requerido usucie:usuario_cierre:numero est:estado:requerido
	**/


	/**
	 * Controlador {Nuevo}
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
	class Nuevo extends Controlador {
		
		private $sesion;
		
		/**
		 * Index::__construct()
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
		 * Index::Index()
		 * 
		 * Metodo necesario para la carga del controlador
		 * el cual es necesario para la carga automatica
		 * del metodo inicial por defecto
		 *
		 * @permisos ("escritura") 
		 * @return mixed
		 */
		public function Index() {
			
			$this->plantilla->parametro('formula', new \Utilidades\Formularios\Constructor('\Formularios\Proyectos\Nuevo'));
			$this->plantilla->parametro('validacion', $this->validarFormulario->crearJs(APP, true, false, '\Formularios\Proyectos\Nuevo')); 
			echo $this->plantilla->mostrarPlantilla('Nuevo', 'Index.html');

		}
		
		/**
		 *  Nuevo::procesar()
		 * 	genera el proceso de guardar el proyecto en tabla principal
		 *  
		 * @Permisos("escritura")
		 * @return mixed
		 */
		public function procesar () {
			$this->cabecera->header('js');
			
			if($this->validarFormulario->validar('\Formularios\Proyectos\Nuevo') == true):
				$resultado = $this->modelo->Guardar((array) $this->validarFormulario->datosFormato(), $this->sesion->infoUsuario('usuario'));
				echo json_encode(array(
					'status' => ($resultado >= 1) ? true : false,
					'codigo' => $resultado
				));
			else:
				echo json_encode(array('status' => false, 'mensaje' => implode("\n", $this->validarFormulario->mensajeError())));
			endif;
		}
		
	}