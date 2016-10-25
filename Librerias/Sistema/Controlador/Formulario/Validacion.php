<?php
	
	/**
	 * NeuralPHP Framework
	 * Marco de trabajo para aplicaciones web.
	 * 
	 * @author Zyos (Carlos Parra) <Neural.Framework@gmail.com>
	 * @copyright 2006-2015 NeuralPHP Framework
	 * @license GNU General Public License as published by the Free Software Foundation; either version 2 of the License.  
	 * @see http://neuralframework.com/
	 * @version 4.0
	 * 
	 * This program is free software; you can redistribute it and/or
	 * modify it under the terms of the GNU General Public License
	 * as published by the Free Software Foundation; either version 2
	 * of the License, or 1 any later version.
	 * 
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 */
	
	namespace Sistema\Controlador\Formulario;
	
	use \Neural\Excepcion;
	use \Sistema\Controlador\Peticiones;
	use \Sistema\Controlador\Formulario\CrearJs;
	use \Sistema\Controlador\Formulario\Formato AS FormatoDatos;
	use \Sistema\Controlador\Formulario\Reflexion;
	use \Sistema\Controlador\Formulario\Validacion\Validar AS ValidarFormulario;
	use \Sistema\Utilidades\ConfigAcceso;
	
	class Validacion {
		
		private $confgClase;
		private $confgMetodo;
		private $errorMensaje = array();
		private $peticiones = false;
		private $formPeticion = array();
		private $formFormato = array();
		
		/**
		 * Validacion::__construct()
		 * 
		 * Asigna las variables correspondientes
		 * para el proceso de la validacion y
		 * generar el formato respectivo, se
		 * requiere el objeto de peticiones para
		 * determinar y manipular los datos del
		 * formulario
		 * 
		 * @param object $peticiones
		 * @return void
		 */
		function __construct($peticiones = false) {
			if(is_object($peticiones) == true):
				$this->peticiones = $peticiones;
			else:
				throw new Excepcion('Es necesario el objeto de Peticiones para el proceso de validación de formularios', 0);
			endif;
		}
		
		/**
		 * Validacion::crearJs()
		 * 
		 * Genera el proceso de creacion del
		 * script de javascript para la validacion
		 * correspondiente del formulario del lado
		 * del usuario
		 * 
		 * @param string $app
		 * @param bool $validate
		 * @param bool $jQuery
		 * @param string $namespace
		 * @return string
		 */
		public function crearJs($app = false, $validate = false, $jQuery = false, $namespace = false) {
			if(is_string($namespace) == true):
				return $this->crearJsExistenciaClase($app, $validate, $jQuery, $namespace);
			else:
				throw new Excepcion('Debe ingresar el namespace del formulario para construir el script JavaScript', 0);
			endif;
		}
		
		/**
		 * Validacion::crearJsExistenciaClase()
		 * 
		 * Genera la validacion de la existencia
		 * del namespace correspondiente para
		 * iniciar el proceso de la construccion de
		 * la validacion del formulario
		 * 
		 * @param string $app
		 * @param bool $validate
		 * @param bool $jQuery
		 * @param string $namespace
		 * @return string
		 */
		private function crearJsExistenciaClase($app = false, $validate = false, $jQuery = false, $namespace = false) {
			if(class_exists($namespace) == true):
				return $this->crearJsApp($app, $validate, $jQuery, $namespace);
			else:
				throw new Excepcion(sprintf('El namespace: %s no existe para la construcción de la validación del formulario', $namespace), 0);
			endif;
		}
		
		/**
		 * Validacion::crearJsApp()
		 * 
		 * Genera la validacion de la aplicacion
		 * sea ingresada como texto la cual
		 * indicara la aplicacion donde deben
		 * configurar las rutas de los archivos
		 * fuente
		 * 
		 * @param string $app
		 * @param bool $validate
		 * @param bool $jQuery
		 * @param string $namespace
		 * @return string
		 */
		private function crearJsApp($app = false, $validate = false, $jQuery = false, $namespace = false) {
			if(is_string($app) == true):
				return $this->crearJsAppValidar($app, $validate, $jQuery, $namespace);
			else:
				throw new Excepcion('La aplicación no es valida, debe ingresar el nombre de la aplicación', 0);
			endif;
		}
		
		/**
		 * Validacion::crearJsAppValidar()
		 * 
		 * Genera la validacion de la existencia
		 * de la aplicacion configurada para la
		 * asignacion de las rutas de los archivos
		 * fuente
		 * 
		 * @param string $app
		 * @param bool $validate
		 * @param bool $jQuery
		 * @param string $namespace
		 * @return string
		 */
		private function crearJsAppValidar($app = false, $validate = false, $jQuery = false, $namespace = false) {
			if(ConfigAcceso::appExistencia($app) == true):
				return $this->crearJsLibrerias($app, $validate, $jQuery, $namespace);
			else:
				throw new Excepcion(sprintf('La aplicación: %s no existe para generar la construcción del script de validación', $app), 0);
			endif;
		}
		
		/**
		 * Validacion::crearJsLibrerias()
		 * 
		 * Genera la validacion de las variables
		 * de las librerias de javascript para ser
		 * agregadas a la validacion
		 * 
		 * @param string $app
		 * @param bool $validate
		 * @param bool $jQuery
		 * @param string $namespace
		 * @return string
		 */
		private function crearJsLibrerias($app = false, $validate = false, $jQuery = false, $namespace = false) {
			if(is_bool($validate) == true AND is_bool($jQuery) == true):
				return $this->crearJsEjecucion($app, $validate, $jQuery, $namespace);
			else:
				throw new Excepcion('Debe ingresar valores booleanos para agregar las librerias de JavaScript para la construcción de la validación', 0);
			endif;
		}
		
		/**
		 * Validacion::crearJsEjecucion()
		 * 
		 * Crea el script correspondiente para la
		 * validacion del formulario del lado del
		 * cliente
		 * 
		 * @param string $app
		 * @param bool $validate
		 * @param bool $jQuery
		 * @param string $namespace
		 * @return string
		 */
		private function crearJsEjecucion($app = false, $validate = false, $jQuery = false, $namespace = false) {
			$js = new CrearJs($app, $validate, $jQuery, $namespace);
			return $js->crear();
		}
		
		/**
		 * Validacion::validar()
		 * 
		 * Genera el proceso de validacion del
		 * formulario correspondiente ingresando el
		 * namespace del formulario para inicial el
		 * proceso de validacion este retornara un
		 * valor TRUE para indicar que la
		 * validacion fue un exito o un valor FALSE
		 * para indicar que se ha presentado un
		 * error en el proceso
		 * 
		 * @param string $namespace
		 * @return bool
		 */
		public function validar($namespace = false) {
			if(is_string($namespace) == true):
				return $this->validarExistencia($namespace);
			else:
				throw new Excepcion('Debe ingresar el namespace del formulario a validar', 0);
			endif;
		}
		
		/**
		 * Validacion::validarExistencia()
		 * 
		 * Se genera la validacion de la
		 * existencia del namespace, en dado caso
		 * se retornara una excepcion con error
		 * correspondiente
		 * 
		 * @param string $namespace
		 * @return bool
		 */
		private function validarExistencia($namespace = false) {
			if(class_exists($namespace) == true):
				return $this->validarEjecucion($namespace);
			else:
				throw new Excepcion(sprintf('El namespace: %s no existe para la validación del formulario', $namespace), 0);
			endif;
		}
		
		/**
		 * Validacion::validarEjecucion()
		 * 
		 * Ejecuta los procesos correspondientes
		 * para la validacion del formulario al
		 * igual que los procesos secundarios para
		 * los procesos de creacion de las
		 * validaciones
		 * 
		 * @param string $namespace
		 * @return bool
		 */
		private function validarEjecucion($namespace = false) {
			$reflexion = new Reflexion($namespace);
			$confgClase = $reflexion->claseComentarios();
			$confgMetodo = $reflexion->camposComentarios();
			
			$validar = new ValidarFormulario($confgClase, $confgMetodo, $this->peticiones);
			$formato = new FormatoDatos($namespace, $confgClase, $confgMetodo, $this->peticiones);
			
			$this->formPeticion = $formato->raw();
			
			if($validar->ejecutar() == true):
				$this->errorMensaje = $validar->obtenerError();
				$this->formFormato = ($confgClase->formulario->formato == true) ? $formato->formato() : $formato->formulario();
				return true;
			else:
				$this->errorMensaje = $validar->obtenerError();
				return false;
			endif;
		}
		
		/**
		 * Validacion::datosFormPeticion()
		 * 
		 * Retorna los datos enviados por el
		 * formulario y obtenidos por la peticion
		 * sin ningun tipo de tratamiento en
		 * formato y/o validacion
		 * 
		 * @return array
		 */
		public function datosPeticion() {
			return $this->formPeticion;
		}
		
		/**
		 * Validacion::datosFormFormato()
		 * 
		 * Retorna los datos enviados por el
		 * formulario y obtenidos por la peticion
		 * con el tratamiento en el formato y la
		 * validacion
		 * 
		 * @return array
		 */
		public function datosFormato() {
			return $this->formFormato;
		}
		
		/**
		 * Validacion::mensajeError()
		 * 
		 * Retorna los mensajes de error que se
		 * generaron en la validacion del
		 * formulario
		 * 
		 * @return array
		 */
		public function mensajeError() {
			return $this->errorMensaje;
		}
	}