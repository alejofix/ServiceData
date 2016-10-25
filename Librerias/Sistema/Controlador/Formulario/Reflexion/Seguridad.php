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
	class Seguridad {
		
		/**
		 * Seguridad:seguridad
		 * 
		 * Asigna si hay que generar la validacion
		 * de un token adicional agregando un campo
		 * hidden en el formulario con el token
		 * correspondiente
		 * 
		 * @return bool
		 */
		public $seguridad = true;
		
		/**
		 * Seguridad:token
		 * 
		 * Asigna el token que debe ser validado
		 * el cual debe existir en los datos enviados
		 * en el formulario
		 * 
		 * @return bool
		 */
		public $token;
	}