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
	
	namespace Sistema\Controlador;
	
	use \Neural\Excepcion;
	use \Symfony\Component\HttpFoundation\Request;
	
	class Peticiones {
		
		private $contPost = false;
		private $contGet = false;
		
		/**
		 * Peticiones::__construct()
		 * 
		 * Genera el instancia del request
		 * correspondiente para el tratamiento de
		 * los datos
		 * 
		 * @return void
		 */
		function __construct() {
			$peticion = Request::createFromGlobals();
			$this->contPost = $peticion->request;
			$this->contGet = $peticion->query;
			$_POST = null;
			$_GET = null;
			$_REQUEST = null;
		}
		
		/**
		 * Peticiones::ajax()
		 * 
		 * Determina si esta recibiendo un
		 * peticion ajax y retorna true en caso de
		 * exito
		 * 
		 * @return bool
		 */
		public function ajax() {
			return (empty($_SERVER['HTTP_X_REQUESTED_WITH']) == false AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Peticiones::existenciaPost()
		 * 
		 * Valida la existencia de datos POST en
		 * la petición, en este caso determina si
		 * hay parametros enviados
		 * 
		 * @return bool
		 */
		public function existenciaPost() {
			return ($this->contPost->count() >= 1) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Peticiones::existenciaGet()
		 * 
		 * Valida la existencia de datos GET en la
		 * petición, en este caso determina si hay
		 * parametros enviados
		 * 
		 * @return bool
		 */
		public function existenciaGet() {
			return ($this->contGet->count() >= 1) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Peticiones::postExistencia()
		 * 
		 * Genera la validacion de la existencia
		 * de la llave(s) indicada(s) retornando
		 * true si existen
		 * 
		 * @return bool
		 */
		public function postExistencia($llave = false) {
			return ($this->contPost->has($llave) == true) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Peticiones::getExistencia()
		 * 
		 * Genera la validacion de la existencia
		 * de la llave(s) indicada(s) retornando
		 * true si existen
		 * 
		 * @return bool
		 */
		public function getExistencia($llave = false) {
			return ($this->contGet->has($llave) == true) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Peticiones::parametrosLlaveExistencia()
		 * 
		 * Genera la validacion de las llaves en
		 * primer nivel lo cual retornara true para
		 * la existencia de la llaves indicadas
		 * 
		 * @param object $objeto
		 * @param array $array
		 * @return bool
		 */
		private function parametrosLlaveExistencia($objeto = false, $array = false) {
			foreach ($array AS $nombre):
				if($objeto->has($nombre) == true):
					$lista[] = true;
				endif;
			endforeach;
			return (isset($lista) == true) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Peticiones::post()
		 * 
		 * Retorna todos los datos post enviados
		 * es posible indicar las llaves que se
		 * requieran en dado caso de no existir la
		 * llave se  lanzara una excepcion
		 * indicando la inexistencia de la llave
		 * 
		 * @return mixed
		 */
		public function post() {
			$array = func_get_args();
			if(count($array) >= 1):
				return $this->parametros($this->contPost, $array);
			else:
				return $this->contPost->all();
			endif;
		}
		
		/**
		 * Peticiones::get()
		 * 
		 * Retorna todos los datos post enviados
		 * es posible indicar las llaves que se
		 * requieran en dado caso de no existir la
		 * llave se  lanzara una excepcion
		 * indicando la inexistencia de la llave
		 * 
		 * @return mixed
		 */
		public function get() {
			$array = func_get_args();
			if(count($array) >= 1):
				return $this->parametros($this->contGet, $array);
			else:
				return $this->contGet->all();
			endif;
		}
		
		/**
		 * Peticiones::parametros()
		 * 
		 * Genera el proceso de validacion de la
		 * existencia de la llave correspondiente
		 * de lo contrario regresara una excepcion
		 * indicando que no existe
		 * 
		 * @param bool $llaves
		 * @return mixed
		 */
		private function parametros($objeto = false, $array = false) {
			if(count($array) > 1):
				return $this->paramMultiple($objeto, $array);
			else:
				return $objeto->get($array[0]);
			endif;
		}
		
		/**
		 * Peticiones::paramMultiple()
		 * 
		 * Genera el proceso de validacion de la
		 * existencia de la llave correspondiente
		 * de lo contrario regresara una excepcion
		 * indicando que no existe
		 * 
		 * @param bool $llaves
		 * @return mixed
		 */
		private function paramMultiple($objeto = false, $array = false) {
			foreach ($array AS $nombre):
				if($objeto->has($nombre) == true):
					$lista[$nombre] = $objeto->get($nombre);
				else:
					throw new Excepcion(sprintf('El parametro: %s no existe dentro de la petición', $nombre), 0);
					break;
				endif;
			endforeach;
			return $lista;
		}
	}