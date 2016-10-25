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
	
	class Campos {
		
		private $campo = false;
		
		/**
		 * Campos::__construct()
		 * 
		 * Genera la variable correspondiente para
		 * ser validada
		 * 
		 * @param string $campo
		 * @return void
		 */
		function __construct($campo = false) {
			$this->campo = $campo;
		}
		
		/**
		 * Campos::requerido()
		 * 
		 * Genera la validacion si hay un texto
		 * @param mixed $info
		 * @return bool
		 */
		public function requerido($objeto = false) {
			return (empty($this->campo) == false) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Campos::_minCaracteres()
		 * 
		 * Valida que la cantidad minima de
		 * caracteres que tiene la cadena
		 * 
		 * @param string $info
		 * @param integer $cantidad
		 * @return bool
		 */
		public function minCaracteres($objeto = false) {
			return (strlen($this->campo) >= $objeto->cantidad) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Campos::_maxCaracteres()
		 *
		 * Genera la validacion de la cantidad
		 * maxima que debe tener la cadena
		 *  
		 * @param string $cadena
		 * @param integer $cantidad
		 * @return bool
		 */
		public function maxCaracteres($objeto = false) {
			return (strlen($this->campo) <= $objeto->cantidad) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Campos::_rangoCaracteres()
		 * 
		 * Genera la validacion de el rango de
		 * caracteres que debe tener la cadena
		 * 
		 * @param string $cadena
		 * @param integer $inicio
		 * @param integer $fin
		 * @return bool
		 */
		public function rangoCaracteres($objeto = false) {
			return (strlen($this->campo) >= $objeto->inicio AND strlen($this->campo) <= $objeto->fin) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Campos::_minCantidad()
		 * 
		 * Valida que el valor numerico sea igual
		 * o mayor al indicado que debe tener el
		 * campo
		 * 
		 * @param integer $numero
		 * @param integer $cantidad
		 * @return bool
		 */
		public function minCantidad($objeto = false) {
			return ($this->campo >= $objeto->cantidad) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Campos::_maxCantidad()
		 * 
		 * Valida que el valor numerico sea igual
		 * o menor al indicado que debe tener el
		 * campo
		 * 
		 * @param integer $numero
		 * @param integer $cantidad
		 * @return bool
		 */
		public function maxCantidad($objeto = false) {
			return ($this->campo <= $objeto->cantidad) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Campos::_rangoCantidad()
		 * 
		 * Valida que el numero cumpla con el
		 * rango numerico requerido
		 * 
		 * @param integer $numero
		 * @param integer $inicio
		 * @param integer $fin
		 * @return bool
		 */
		public function rangoCantidad($objeto = false) {
			return ($this->campo >= $objeto->inicio AND $this->campo <= $objeto->fin) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Campos::_correo()
		 * 
		 * Genera la validacion del campo sea un
		 * correo electronico
		 * 
		 * @param string $correo
		 * @return bool
		 */
		public function correo($objeto = false) {
			$validacion = filter_var($this->campo, FILTER_VALIDATE_EMAIL);
			return (is_string($validacion) == true) ? (boolean) true : (boolean) false;
		}
		
		/**
		 * Campos::_url()
		 * 
		 * Genera la validacion de la url
		 * ingresada
		 * 
		 * @param string $cadena
		 * @return bool
		 */
		public function url($objeto = false) {
			$validacion = filter_var($this->campo, FILTER_VALIDATE_URL);
			return (is_string($validacion) == true) ? (boolean) true : false;
		}
		
		/**
		 * Campos::_fecha()
		 * 
		 * Genera la validacion de la fecha
		 * necesaria para la cadena
		 * 
		 * @param string $cadena
		 * @return bool
		 */
		public function fecha($objeto = false) {
			$validacion = strtotime($this->campo);
			return (is_numeric($validacion) == true) ? (boolean) true : false;
		}
		
		/**
		 * Campos::_fechaISO()
		 * 
		 * Genera la validacion de la fecha
		 * necesaria para la cadena
		 * 
		 * @param string $cadena
		 * @return bool
		 */
		public function fechaISO($objeto = false) {
			return $this->fecha();
		}
		
		/**
		 * Campos::_numero()
		 * 
		 * Genera la validacion del dato es
		 * numerico
		 * 
		 * @param integer $numero
		 * @return bool
		 */
		public function numero($objeto = false) {
			return (is_numeric($this->campo) == true) ? (boolean) true : false;
		}
		
		/**
		 * Campos::_digitos()
		 * 
		 * Genera la validacion de la informacion
		 * es numerica del digito
		 * 
		 * @param integer $numero
		 * @return bool
		 */
		public function digitos($objeto = false) {
			return $this->numero();
		}
		
		/**
		 * Campos::_campoIgual()
		 * 
		 * Valida una cadena sea igual a otra
		 * @param string $cadena
		 * @param string $campo
		 * @return bool
		 */
		public function campoIgual($objeto = false) {
			return (boolean) true;
		}
		
		/**
		 * Campos::remoto()
		 * 
		 * Validacion solo js
		 * @param object $objeto
		 * @return bool
		 */
		public function remoto($objeto = false) {
			return (boolean) true;
		}
		
		/**
		 * Campos::archivoExtension()
		 * 
		 * Validacion solo js
		 * @param object $objeto
		 * @return bool
		 */
		public function archivoExtension($objeto = false) {
			return (boolean) true;
		}
		
		/**
		 * Campos::archivoMimeType()
		 * 
		 * Validacion solo js
		 * @param object $objeto
		 * @return bool
		 */
		public function archivoMimeType($objeto = false) {
			return (boolean) true;
		}
	}