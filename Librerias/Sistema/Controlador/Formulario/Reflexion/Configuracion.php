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
	
	/**
	 * @Annotation
	 */
	class Configuracion {
		
		/**
		 * Configuracion:existencia
		 * 
		 * Asigna el valor para realizar la validacion
		 * si el campo debe existir en los datos enviados
		 * en el formulario, de lo contrario no se valida
		 * su existencia obligatoria
		 * 
		 * @return bool
		 */
		public $existencia = true;
		
		/**
		 * Configuracion:array
		 * 
		 * Genera la validacion si el campo es un array
		 * de datos o solo es un campo de un solo valor
		 * 
		 * @return bool
		 */
		public $array = false;
		
		/**
		 * Configuracion:campos
		 * 
		 * Array en json para generar el array
		 * de datos del campo para su validacion
		 * 
		 * @return array
		 */
		public $campos = array();
	}