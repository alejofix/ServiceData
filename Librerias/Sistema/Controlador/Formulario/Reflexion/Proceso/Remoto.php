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
	class Remoto {
		
		/**
		 * Remoto::mensaje
		 * 
		 * Asigna el mensaje de error correspondiente
		 * @return string
		 */
		public $mensaje;
		
		/**
		 * Remoto::url
		 * 
		 * Asigna la URL para la peticion correspondiente
		 * @return string
		 */
		public $url;
		
		/**
		 * Remoto::metodo
		 * 
		 * Asigna el metodo de envio para la peticion ajax
		 * de forma remota estos puede ser GET o POST
		 * 
		 * @return string
		 */
		public $metodo = 'POST';
	}