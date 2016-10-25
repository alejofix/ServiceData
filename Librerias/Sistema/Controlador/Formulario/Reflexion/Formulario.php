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
	class Formulario {
		
		/**
		 * Formulario:metodo
		 * 
		 * Asigna el metodo de envio del
		 * formulario ya sea POST o GET
		 * 
		 * @return string
		 */
		public $metodo;
		
		/**
		 * Formulario:ajax
		 * 
		 * Asigna si se debe validar el envio del
		 * formulario por ajax o no
		 * 
		 * @return bool
		 */
		public $ajax;
		
		/**
		 * Formulario:formato
		 * 
		 * Asigna el formato que debe retornarse en
		 * los datos de la peticion, los posibles
		 * valores son false para manejar los datos
		 * con el formato final y valor true para 
		 * manejar los datos con la clase del
		 * formulario
		 * 
		 * @return bool
		 */
		public $formato = false;
	}