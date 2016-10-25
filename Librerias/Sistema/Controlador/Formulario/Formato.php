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
	
	class Formato {
		
		private $tiposLista = array('boolean', 'integer', 'float', 'string', 'array', 'object', 'null');
		private $namespace = false;
		private $peticiones = false;
		private $configForm = false;
		private $confgCampos = false;
		
		/**
		 * Formato::__construct()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de formato de los datos enviados
		 * desde el formulario y se genera dicho
		 * formato a traves del archivo de
		 * configuracion y validacion del
		 * formulario
		 * 
		 * @param string $namespace
		 * @param object $configForm
		 * @param object $confgCampos
		 * @param object $peticiones
		 * @return void
		 */
		function __construct($namespace = false, $configForm = false, $confgCampos = false, $peticiones = false) {
			$this->namespace = $namespace;
			$this->configForm = $configForm;
			$this->confgCampos = $confgCampos;
			$this->peticiones = $peticiones;
		}
		
		/**
		 * Formato::formato()
		 * 
		 * Inicializa el proceso del formato
		 * solicitado
		 * 
		 * @return object
		 */
		public function formato() {
			$this->contenedorFormat = array();
			foreach ($this->confgCampos AS $campo => $param):
				$this->formatExistencia($campo, $param);
			endforeach;
			return (object) $this->contenedorFormat;
		}
		
		/**
		 * Formato::formatExistencia()
		 * 
		 * Ejecuta el proceso de formato de los
		 * campos
		 * 
		 * @param string $campo
		 * @param array $param
		 * @return void
		 */
		private function formatExistencia($campo = false, $param = false) {
			if(call_user_func_array(array($this->peticiones, ucfirst(mb_strtolower($this->configForm->formulario->metodo)).'Existencia'), array($campo)) == true):
				$this->contenedorFormat[$param->nombre->nombre] = $this->formatoCampo($param->formato->funciones, $param->tipoDato->tipo, call_user_func_array(array($this->peticiones, ucfirst(mb_strtolower($this->configForm->formulario->metodo))), array($campo)));
			endif;
		}
		
		/**
		 * Formato::raw()
		 * 
		 * Retorna la matriz de datos de la
		 * peticion del formulario sin ninguna
		 * modificacion
		 * 
		 * @return object
		 */
		public function raw() {
			return (object) call_user_func(array($this->peticiones, mb_strtolower($this->configForm->formulario->metodo)));
		}
		
		/**
		 * Formato::formulario()
		 * 
		 * Retorna el objeto del validador del
		 * formulario con los datos requeridos para
		 * su procesamiento
		 * 
		 * @return object
		 */
		public function formulario() {
			return $this->objeto(new $this->namespace, call_user_func(array($this->peticiones, mb_strtolower($this->configForm->formulario->metodo))));
		}
		
		/**
		 * Formato::objeto()
		 * 
		 * Genera el proceso de introducir los
		 * datos requeridos en el objeto
		 * correspondiente
		 * 
		 * @param object $objeto
		 * @param array $array
		 * @return object
		 */
		private function objeto($objeto = false, $array = false) {
			foreach ($array AS $campo => $param):
				
				if($campo != 'token'):
					call_user_func_array(
						array($objeto, 'set'.ucfirst($campo)), array(
							$this->formatoCampo(
								$this->confgCampos->{$campo}->formato->funciones, 
								$this->confgCampos->{$campo}->tipoDato->tipo, 
								$param
							)
						)
					);
				endif;
					
			endforeach;
			return $objeto;
		}
		
		/**
		 * Formato::formatoCampo()
		 * 
		 * Inicializa el formato de los campos
		 * correspondientes para asignarlos al
		 * objeto correspondiente
		 * 
		 * @param array $formato
		 * @param string $tipo
		 * @param mixed $param
		 * @return mixed
		 */
		private function formatoCampo($formato = false, $tipo = false, $param = false) {
			if(is_array($param) == true):
				return $this->formatoCampoArray($formato, $tipo, $param);
			else:
				return $this->formatoCampoEjecutar($formato, $tipo, $param);
			endif;
		}
		
		/**
		 * Formato::formatoCampoArray()
		 * 
		 * Genera el proceso de recorrer la matriz
		 * de datos y aplica el proceso del formato
		 * 
		 * @param array $formato
		 * @param string $tipo
		 * @param mixed $param
		 * @return mixed
		 */
		private function formatoCampoArray($formato = false, $tipo = false, $param = false) {
			foreach ($param AS $campo => $valor):
				$lista[$campo] = $this->formatoCampo($formato, $tipo, $valor);
			endforeach;
			return (object) $lista;
		}
		
		/**
		 * Formato::formatoCampoEjecutar()
		 * 
		 * Valida si hay formatos para ser
		 * aplicados
		 * 
		 * @param array $formato
		 * @param string $tipo
		 * @param mixed $param
		 * @return mixed
		 */
		private function formatoCampoEjecutar($formato = false, $tipo = false, $param = false) {
			if(count($formato) >= 1):
				return $this->formatoCampoProcesar($formato, $tipo, $param);
			endif;
			return $this->tipoExistencia($tipo, $param);
		}
		
		/**
		 * Formato::formatoCampoProcesar()
		 * 
		 * Recorre la matriz de validaciones a 
		 * aplicar
		 * 
		 * @param array $formatos
		 * @param string $tipo
		 * @param mixed $param
		 * @return mixed
		 */
		private function formatoCampoProcesar($formatos = false, $tipo = false, $param = false) {
			foreach ($formatos AS $formato):
				$param = $this->formatoExistencia($formato, $tipo, $param);
			endforeach;
			return $param;
		}
		
		/**
		 * Formato::formatoExistencia()
		 * 
		 * Determina si existe la funcion de
		 * formato correspondiente
		 * 
		 * @param array $formato
		 * @param string $tipo
		 * @param mixed $param
		 * @return mixed
		 */
		private function formatoExistencia($formato = false, $tipo = false, $param = false) {
			if(function_exists($formato) == true):
				return $this->formatoAplicado($formato, $tipo, $param);
			else:
				throw new Excepcion(sprintf('El formato: %s no existe o no esta habilitado para la validación del formulario', $formato), 0);
			endif;
		}
		
		/**
		 * Formato::formatoAplicado()
		 * 
		 * Aplica el formato indicado al valor del
		 * campo para ser procesado
		 * 
		 * @param array $formato
		 * @param string $tipo
		 * @param mixed $param
		 * @return mixed
		 */
		private function formatoAplicado($formato = false, $tipo = false, $param = false) {
			$campo = call_user_func_array($formato, array($param));
			return $this->tipoExistencia($tipo, $campo);
		}
		
		/**
		 * Formato::tipoExistencia()
		 * 
		 * Valida si el tipo para ser aplicado al
		 * campo es valido en dado caso se
		 * regresara una excepcion
		 * 
		 * @param string $tipo
		 * @param mixed $param
		 * @return mixed
		 */
		private function tipoExistencia($tipo = false, $param = false) {
			if(array_key_exists($tipo, array_flip($this->tiposLista)) == true):
				return $this->tipoAplicado($tipo, $param);
			else:
				throw new Excepcion(sprintf('El formato de tipo: %s no es valido y no es posible aplicarlo a la validación del formulario', $tipo), 0);
			endif;
		}
		
		/**
		 * Formato::tipoAplicado()
		 * 
		 * Asigna el tipo de dato indicado en la
		 * configuracion
		 * 
		 * @param string $tipo
		 * @param mixed $param
		 * @return mixed
		 */
		private function tipoAplicado($tipo = false, $param = false) {
			$campo = $param;
			return (settype($campo, $tipo) == true) ? $campo : $param;
		}
	}