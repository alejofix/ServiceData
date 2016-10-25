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
	
	namespace Sistema\Controlador\Formulario\Validacion;
	
	use \Neural\Excepcion;
	use \Sistema\Controlador\Formulario\Validacion\Campos AS CamposValidar;
	
	class Validar {
		
		private $confgClase = false;
		private $confgMetodo = false;
		private $peticiones = false;
		private $metodoPeticion = 'Post';
		private $contenedorError = false;
		
		/**
		 * Validar::__construct()
		 * 
		 * Genera las variables correspondientes
		 * que se requieren para el proceso de
		 * validacion
		 * 
		 * @param string $namespace
		 * @param objetc $peticiones
		 * @return void
		 */
		function __construct($confgClase = false, $confgMetodo = false, $peticiones = false) {
			$this->confgClase = $confgClase;
			$this->confgMetodo = $confgMetodo;
			$this->peticiones = $peticiones;
			$this->metodoPeticion = mb_strtolower($this->confgClase->formulario->metodo);
		}
		
		/**
		 * Validar::obtenerError()
		 * 
		 * Retorna los diferentes mensajes de
		 * error que se presentaron en los procesos
		 * de la validacion de los campos del
		 * formulario
		 * 
		 * @return array
		 */
		public function obtenerError() {
			return (is_array($this->contenedorError) == true) ? $this->contenedorError : array();
		}
		
		/**
		 * Validar::ejecutar()
		 * 
		 * Ejecuta la validacion del formulario
		 * correspondiente
		 * 
		 * @return bool
		 */
		public function ejecutar() {
			if($this->confgClase->formulario->ajax == true):
				return $this->validacionAjax();
			else:
				return $this->validacionPeticion();
			endif;
		}
		
		/**
		 * Validar::validacionAjax()
		 * 
		 * Genera el proceso si se ha generado
		 * una peticion ajax de lo contrario
		 * retorna una excepcion indicando que
		 * no puede ser procesado
		 * 
		 * @throw Excepcion
		 * @return bool
		 */
		private function validacionAjax() {
			if($this->peticiones->ajax() == true):
				return $this->validacionPeticion();
			else:
				throw new Excepcion('No es posible procesar la petición solicitada', 0);
			endif;
		}
		
		/**
		 * Validar::validacionPeticion()
		 * 
		 * Genera la validacion si existen datosen
		 * la peticion para ser validado y ejecutar
		 * dicha validacion
		 * 
		 * @throws Excepcion
		 * @return bool
		 */
		private function validacionPeticion() {
			if(call_user_func(array($this->peticiones, 'existencia'.ucfirst($this->metodoPeticion))) == true):
				return $this->validacionSeguridad();
			else:
				throw new Excepcion('No se ha generado una petición valida para el procesamiento de datos', 0);
			endif;
		}
		
		/**
		 * Validar::validacionSeguridad()
		 * 
		 * Determina si el proceso de validacion de
		 * el token hay que realizarlo o hay que
		 * generar el salto a la validacion de los
		 * campos del formulario
		 * 
		 * @return bool
		 */
		private function validacionSeguridad() {
			if($this->confgClase->seguridad->seguridad == true):
				return $this->validarTokenExistencia();
			else:
				return $this->validarExistenciaCampos();
			endif;
		}
		
		/**
		 * Validar::validarTokenExistencia()
		 * 
		 * Valida que exista el token en la
		 * peticion de validacion del formulario
		 * 
		 * @throws Excepcion
		 * @return bool
		 */
		private function validarTokenExistencia() {
			if(call_user_func_array(array($this->peticiones, $this->metodoPeticion.'Existencia'), array('token')) == true):
				return $this->validarToken();
			else:
				throw new Excepcion('No es posible procesar la petición, debe enviar la petición desde el formulario', 0);
			endif;
		}
		
		/**
		 * Validar::validarToken()
		 * 
		 * Valida que el token sea igual al
		 * configurado en el archivo de
		 * configuracion
		 * 
		 * @throws Excepcion
		 * @return bool
		 */
		private function validarToken() {
			if (call_user_func_array(array($this->peticiones, $this->metodoPeticion), array('token')) == $this->confgClase->seguridad->token):
				return $this->validarExistenciaCampos();
			else:
				throw new Excepcion('No es posible procesar la petición, no se esta enviando la información correcta', 0);
			endif;
		}
		
		/**
		 * Validar::validarExistenciaCampos()
		 * 
		 * Determina si hay campos para ser
		 * validados
		 * 
		 * @return bool
		 */
		private function validarExistenciaCampos() {
			if(count($this->confgMetodo) >= 1):
				return $this->validarCampos();
			endif;
			return (boolean) true;
		}
		
		/**
		 * Validar::validarCampos()
		 * 
		 * Recorre la matriz de datos para generar
		 * las validaciones del caso
		 * 
		 * @return bool
		 */
		private function validarCampos() {
			foreach ($this->confgMetodo AS $campo => $param):
				$this->validarExistenciaCampo($campo, $param);
			endforeach;
			return (is_array($this->contenedorError) == true) ? (boolean) false : (boolean) true;
		}
		
		/**
		 * Validar::validarExistenciaCampo()
		 * 
		 * Genera la validacion de la existencia
		 * del campo
		 * 
		 * @param string $campo
		 * @param object $param
		 * @return void
		 */
		private function validarExistenciaCampo($campo = false, $param = false) {
			if($param->configuracion->existencia == true):
				$this->validarExistenciaCampoExt($campo, $param);
			else:
				$this->validarExtCampo($campo, $param);
			endif;
		}
		
		/**
		 * Validar::validarExistenciaCampoExt()
		 * 
		 * Genera la validacion de la existencia
		 * del campo
		 * 
		 * @throws Excepcion
		 * @param string $campo
		 * @param object $param
		 * @return void
		 */
		private function validarExistenciaCampoExt($campo = false, $param = false) {
			if(call_user_func_array(array($this->peticiones, $this->metodoPeticion.'Existencia'), array($campo)) == true):
				$this->ValidarExistenciaProceso($campo, $param);
			else:
				if(array_key_exists($campo, $array = (is_array($_FILES) == true) ? $_FILES : array()) == true):
					return true;
				else:
					throw new Excepcion(sprintf('El campo: %s no se encuentra en la petición y no es posible procesar', $campo), 0);
				endif;
				
			endif;
		}
		
		/**
		 * Validar::validarExtCampo()
		 * 
		 * Genera la validacion si hay que generar
		 * el proceso en caso de no existir se
		 * omitira la validacion y  se dara como
		 * exitosa la validacion
		 * 
		 * @param string $campo
		 * @param object $param
		 * @return void
		 */
		private function validarExtCampo($campo = false, $param = false) {
			if(call_user_func_array(array($this->peticiones, $this->metodoPeticion.'Existencia'), array($campo)) == true):
				$this->ValidarExistenciaProceso($campo, $param);
			endif;
			return (boolean) true;
		}
		
		/**
		 * Validar::ValidarExistenciaProceso()
		 * 
		 * Determina si hay el espacio de las
		 * validaciones
		 * 
		 * @param string $campo
		 * @param object $param
		 * @return bool
		 */
		private function ValidarExistenciaProceso($campo = false, $param = false) {
			if(array_key_exists('proceso', $param) == true):
				$this->validarCantidad($campo, $param);
			endif;
		}
		
		/**
		 * Validar::validarCantidad()
		 * 
		 * Determina si hay validaciones para
		 * realizar
		 * 
		 * @param string $campo
		 * @param object $param
		 * @return void
		 */
		private function validarCantidad($campo = false, $param = false) {
			if(count($param->proceso->validacion) >= 1):
				$this->validarValor($campo, $param);
			endif;
		}
		
		/**
		 * Validar::validarValor()
		 * 
		 * Genera el proceso de obtener el campo
		 * de la peticion y generar el proceso de
		 * validacion
		 * 
		 * @param string $campo
		 * @param object $param
		 * @return void
		 */
		private function validarValor($campo = false, $param = false) {
			$valor = call_user_func_array(array($this->peticiones, $this->metodoPeticion), array($campo));
			$this->validarSeleccion($campo, $param, $valor);
		}
		
		/**
		 * Validar::validarSeleccion()
		 * 
		 * Genera la validacion so el valor del
		 * campo es un array o un valor para
		 * generar la validacion
		 * 
		 * @param string $campo
		 * @param object $param
		 * @param mixed $valor
		 * @return void
		 */
		private function validarSeleccion($campo = false, $param = false, $valor = false) {
			if(is_array($valor) == true):
				$this->validarSeleccionArray($campo, $param, $valor);
			else:
				$this->validarEjecutar($campo, $param, $valor);
			endif;
		}
		
		/**
		 * Validar::validarSeleccionArray()
		 * 
		 * Recorre la matriz correspondiente para 
		 * determinar la validacion de cada uno de
		 * sus valores y pasar la ejecucion de la
		 * validacion
		 * 
		 * @param string $campo
		 * @param object $param
		 * @param mixed $valor
		 * @return void
		 */
		private function validarSeleccionArray($campo = false, $param = false, $valor = false) {
			foreach ($valor AS $inf):
				$this->validarSeleccion($campo, $param, $inf);
			endforeach;
		}
		
		/**
		 * Validar::validarEjecutar()
		 * 
		 * Ejecuta las validaciones
		 * correspondientes
		 * 
		 * @param string $campo
		 * @param object $param
		 * @return void
		 */
		private function validarEjecutar($campo = false, $param = false, $valor = false) {
			$validar = new CamposValidar($valor);
			foreach ($param->proceso->validacion AS $objeto):
				if(call_user_func_array(array($validar, lcfirst(get_class($objeto))), array($objeto)) == false):
					$this->contenedorError[] = sprintf($objeto->mensaje, $valor);
				endif;
			endforeach;
		}
	}