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
	 *  PHP formulario:desarrollo
	 *  ServiceMe POST Mejoras:Nueva usu:usuario:requerido fec:fecha:fecha,requerido her:herramienta:requerido pro:producto:requerido arb:arbol:requerido tit:titulo:requerido des:descripcion:requerido,mincaracteres,maxcaracteres adj:adjunto:mincaracteres esc:escalado:requerido est:estado:requerido
	 * 
	 * /
	
	/**
	 * Controlador {Nueva}
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
	class Nueva extends Controlador {
		
		private $sesion;
		private $adjunto;
		
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
			$this->adjunto = implode(DIRECTORY_SEPARATOR, array(dirname(dirname(dirname(dirname(__DIR__)))), 'Complementos', 'Adjuntos'));
			
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
					
			$this->plantilla->parametro('formula', $data = new \Utilidades\Formularios\Constructor('\Formularios\Mejoras\Nueva'));
			$this->plantilla->parametro('validacion', $this->validarFormulario->crearJs(APP, true, false, '\Formularios\Mejoras\Nueva')); 
			$this->plantilla->parametro('servicios', $this->modelo->listarServicios());
			echo $this->plantilla->mostrarPlantilla('Nueva', 'Index.html');
		}
		
		/**
		 *  Nueva::Documentar()
		 * 	genera el proceso de guardar la mejora en tabla principal
		 *  
		 * @Permisos("escritura")
		 * @return mixed
		 */
		public function Documentar(){
			
			//$this->cabecera->header('json');
			
			if($this->validarFormulario->validar('Formularios\Mejoras\Nueva') == true):
		
				$resultado = $this->modelo->guardarMejora((array) $this->validarFormulario->datosFormato(), $this->sesion->infoUsuario('usuario'), $_FILES);
				if($resultado == 0):
					throw new Excepcion('No fue posible guardar los datos, validar con el administrador del sistema', 0, APP, 'mejoras:nueva');
				endif;
				// echo json_encode(array('status' => $resultado));
				$this->plantilla->parametro('consulta', $this->modelo->Documentar());
				echo $this->plantilla->mostrarPlantilla('Nueva', 'Documentar.html');
			else:
				echo json_encode(array('status' => false, 'mensajes' => $this->validarFormulario->mensajeError()));
			endif;
		}
	}