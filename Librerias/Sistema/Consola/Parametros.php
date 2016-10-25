<?php
	
	/**
	 * NeuralPHP Framework
	 * Marco de trabajo para aplicaciones web.
	 * 
	 * @author Zyos (Carlos Parra) <Neural.Framework@gmail.com>
	 * @copyright 2006-2015 NeuralPHP Framework
	 * @license GNU General Public License as published by the Free
	 * Software Foundation; either version 2 of the License.  
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
	
	namespace Sistema\Consola;
	
	use \Mvc\InterfaceParametros;
	
	class Parametros implements InterfaceParametros {
		
		private $contenedor = array();
		private $parametros = array();
		
		/**
		 * Parametros::asignarContenedor()
		 * 
		 * Asigna el valor al contenedor de datos
		 * para los procesos de consola y retorna
		 * el valor asignado en su momento, si el
		 * valor existe este sera sobre-escrito
		 * 
		 * @param string $nombre
		 * @param mixed $valor
		 * @return mixed
		 */
		public function asignarContenedor($nombre = false, $valor = false) {
			$this->contenedor[$nombre] = $valor;
		}
		
		/**
		 * Parametros::eliminarContenedor()
		 * 
		 * Elimina uno de los valores asignados al
		 * al contenedor y retornara true si se ha
		 * eliminado y si no fue posible eliminarlo
		 * o no existe el nombre asociativo del
		 * array retornara false
		 * 
		 * @param string $nombre
		 * @return bool
		 */
		public function eliminarContenedor($nombre = false) {
			if(array_key_exists($nombre, $this->contenedor) == true):
				unset($this->contenedor[$nombre]);
				return (boolean) true;
			endif;
			return (boolean) false;
		}
		
		/**
		 * Parametros::existenciaContenedor()
		 * 
		 * Valida si existe el nombre asocitivo sen
		 * encuentra dentro del array de datos
		 * retornando true su existencia
		 * 
		 * @param string $nombre
		 * @return bool
		 */
		public function existenciaContenedor($nombre = false) {
			if(is_bool($nombre) == false):
				return (array_key_exists($nombre, $this->contenedor) == true) ? true : false;
			else:
				throw new \RuntimeException('Debe ingresar el nombre de la llave para validar el contenedor');
			endif;
		}
		
		/**
		 * Parametros::existenciaParametro()
		 * 
		 * Valida si existe el nombre asocitivo sen
		 * encuentra dentro del array de datos
		 * retornando true su existencia
		 * 
		 * @param string $nombre
		 * @return bool
		 */
		public function existenciaParametro($nombre = false) {
			if(is_bool($nombre) == false):
				return (array_key_exists($nombre, $this->parametros) == true) ? true : false;
			else:
				throw new \RuntimeException('Debe ingresar el nombre de la llave para validar los parametros');
			endif;
		}
		
		/**
		 * Parametros::obtenerContenedor()
		 * 
		 * Retorna el valor de la llave asociativa
		 * del array de datos retorna false si no
		 * se encuentra la llave asociativa
		 * 
		 * @param string $nombre
		 * @return mixed
		 */
		public function obtenerContenedor($nombre = false) {
			if($this->existenciaContenedor($nombre) == true):
				return $this->contenedor[$nombre];
			endif;
			return (boolean) false;
		}
		
		/**
		 * Parametros::obtenerParametro()
		 * 
		 * Retorna el valor de la llave asociativa
		 * del array de datos retorna false si no
		 * se encuentra la llave asociativa
		 * 
		 * @param string $nombre
		 * @return mixed
		 */
		public function obtenerParametro($nombre = false) {
			if($this->existenciaParametro($nombre) == true):
				return $this->parametros[$nombre];
			endif;
			return (boolean) false;
		}
		
		/**
		 * Parametros::obtenerContenedores()
		 * 
		 * Retorna el array de datos solicitados
		 * @param string $nombre
		 * @return array
		 */
		public function obtenerContenedores() {
			return $this->contenedor;
		}
		
		/**
		 * Parametros::obtenerParametros()
		 * 
		 * Retorna el array de datos solicitados
		 * @param string $nombre
		 * @return array
		 */
		public function obtenerParametros() {
			return $this->parametros;
		}
		
		/**
		 * Parametros::asignarParametros()
		 * 
		 * Asigna los valores tomados directamente
		 * de los parametros enviados por el
		 * usuario
		 * 
		 * @param array $array
		 * @return void
		 */
		private function asignarParametros($array = false) {
			$this->parametros = $array;
		}
	}