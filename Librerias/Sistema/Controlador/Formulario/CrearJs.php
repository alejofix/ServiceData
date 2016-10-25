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
	use \Neural\JQuery\ValidarForm;
	use \Sistema\Controlador\Formulario\Reflexion;
	
	class CrearJs {
		
		private $jQuery = false;
		private $clase = false;
		private $campos = false;
		private $formulario = false;
		
		/**
		 * CrearJs::__construct()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de construccion de la validacion
		 * correspondiente
		 * 
		 * @param string $app
		 * @param bool $validate
		 * @param bool $jquery
		 * @param string $namespace
		 * @return void
		 */
		function __construct($app = false, $validate = false, $jquery = false, $namespace = false) {
			$this->jQuery = new ValidarForm($app, $jquery, $validate);
			$reflexion = new Reflexion($namespace);
			$this->clase = $reflexion->claseComentarios();
			$this->campos = $reflexion->camposComentarios();
			$this->formulario = new $namespace;
		}
		
		/**
		 * CrearJs::crear()
		 * 
		 * Genera el proceso de la ejecucion de la
		 * creacion del script de formulario
		 * correspondiente
		 * 
		 * @return string
		 */
		public function crear() {
			if(count($this->campos) >= 1):
				return $this->seleccionCampos();
			else:
				return (boolean) false;
			endif;
		}
		
		/**
		 * CrearJs::seleccionCampos()
		 * 
		 * Recorre cada uno de los campos para
		 * realizar el proceso correspondiente de
		 * la creacion de la validacion
		 * 
		 * @return bool
		 */
		private function seleccionCampos() {
			foreach ($this->campos AS $campo => $param):
				$this->validarExistencia($campo, $param);
			endforeach;
			
			$this->jQuery->jQuery = $this->clase->jQuery->general;
			
			if($this->clase->formulario->ajax == true):
				$this->jQuery->peticionAjax($this->formulario->peticionAjax());
			endif;
			
			return $this->jQuery->mostrarValidacion($this->clase->idForm->id);
		}
		
		/**
		 * CrearJs::validarExistencia()
		 * 
		 * Genera la validacion de que exista el
		 * proceso para el contenedor de la
		 * validacion
		 * 
		 * @param string $campo
		 * @param array $param
		 * @return bool
		 */
		private function validarExistencia($campo = false, $param = false) {
			if(array_key_exists('proceso', $param) == true):
				return $this->validarValidacion($campo, $param);
			endif;
			return (boolean) false;
		}
		
		/**
		 * CrearJs::validarValidacion()
		 * 
		 * Genera la validacion si existe una
		 * validacion para el campo correspondiente
		 * 
		 * @param string $campo
		 * @param array $param
		 * @return bool
		 */
		private function validarValidacion($campo = false, $param = false) {
			if(count($param->proceso->validacion) >= 1):
				return $this->validacionAsignacion($campo, $param);
			endif;
			return (boolean) false;
		}
		
		/**
		 * CrearJs::validacionAsignacion()
		 * 
		 * Genera la asignacion de la variable del
		 * campo para crear las validaciones del
		 * caso
		 * 
		 * @param string $campo
		 * @param array $param
		 * @return void
		 */
		private function validacionAsignacion($campo = false, $param = false) {
			if($param->configuracion->array == true):
				call_user_func_array(array($this->jQuery, $campo), $param->configuracion->campos);
			else:
				call_user_func(array($this->jQuery, $campo));
			endif;
			return $this->asignacionValidacion($campo, $param);
		}
		
		/**
		 * CrearJs::asignacionValidacion()
		 * 
		 * Genera el proceso de asignacion de la
		 * validacion para el script js
		 * 
		 * @param string $campo
		 * @param array $param
		 * @return bool
		 */
		private function asignacionValidacion($campo = false, $param = false) {
			foreach ($param->proceso->validacion AS $objeto):
				call_user_func_array(array($this, lcfirst(get_class($objeto))), array($objeto));
			endforeach;
			return (boolean) true;
		}
		
		/**
		 * CrearJs::requerido()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function requerido($objeto = false) {
			$this->jQuery->_requerido($objeto->mensaje);
		}
		
		/**
		 * CrearJs::minCaracteres()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function minCaracteres($objeto = false) {
			$this->jQuery->_minCaracteres($objeto->cantidad, $objeto->mensaje);
		}
		
		/**
		 * CrearJs::maxCaracteres()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function maxCaracteres($objeto = false) {
			$this->jQuery->_maxCaracteres($objeto->cantidad, $objeto->mensaje);
		}
		
		/**
		 * CrearJs::rangoCaracteres()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function rangoCaracteres($objeto = false) {
			$this->jQuery->_rangoCaracteres($objeto->inicio, $objeto->fin, $objeto->mensaje);
		}
		
		/**
		 * CrearJs::minCantidad()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function minCantidad($objeto = false) {
			$this->jQuery->_minCantidad($objeto->cantidad, $objeto->mensaje);
		}
		
		/**
		 * CrearJs::maxCantidad()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function maxCantidad($objeto = false) {
			$this->jQuery->_maxCantidad($objeto->cantidad, $objeto->mensaje);
		}
		
		/**
		 * CrearJs::rangoCantidad()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function rangoCantidad($objeto = false) {
			$this->jQuery->_rangoCantidad($objeto->inicio, $objeto->fin, $objeto->mensaje);
		}
		
		/**
		 * CrearJs::correo()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function correo($objeto = false) {
			$this->jQuery->_correo($objeto->mensaje);
		}
		
		/**
		 * CrearJs::url()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function url($objeto = false) {
			$this->jQuery->_url($objeto->mensaje);
		}
		
		/**
		 * CrearJs::Fecha()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function Fecha($objeto = false) {
			$this->jQuery->_fecha($objeto);
		}
		
		/**
		 * CrearJs::fechaISO()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function fechaISO($objeto = false) {
			$this->jQuery->_fechaISO($objeto->mensaje);
		}
		
		/**
		 * CrearJs::numero()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function numero($objeto = false) {
			$this->jQuery->_numero($objeto->mensaje);
		}
		
		/**
		 * CrearJs::digitos()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function digitos($objeto = false) {
			$this->jQuery->_digitos($objeto->mensaje);
		}
		
		/**
		 * CrearJs::campoIgual()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function campoIgual($objeto = false) {
			$this->jQuery->_campoIgual($objeto->idCampo, $objeto->mensaje);
		}
		
		/**
		 * CrearJs::remoto()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function remoto($objeto = false) {
			$this->jQuery->_remoto($objeto->url, $objeto->metodo, $objeto->mensaje);
		}
		
		/**
		 * CrearJs::archivoMimeType()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function archivoMimeType($objeto = false) {
			call_user_func_array(array($this->jQuery, '_archivoMimeType'), $objeto->tipo);
		}
		
		/**
		 * CrearJs::archivoExtension()
		 * 
		 * Asigna la validacion correspondiente
		 * @param object $objeto
		 * @return void
		 */
		private function archivoExtension($objeto = false) {
			call_user_func_array(array($this->jQuery, '_archivoExtension'), $objeto->tipo);
		}
	}