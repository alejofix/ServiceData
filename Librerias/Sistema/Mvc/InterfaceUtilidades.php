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
	
	namespace Mvc;
	
	interface InterfaceUtilidades {
		
		/**
		 * InterfaceUtilidades::Cabecera()
		 * 
		 * Retorna el objeto de manejo base de
		 * cabeceras
		 * 
		 * @return object
		 */
		public function cabecera();
		
		/**
		 * InterfaceUtilidades::conexion()
		 * 
		 * Retorna el objeto de la conexion a la
		 * base de datos
		 * 
		 * @param string $app
		 * @param string $conexion
		 * @return object
		 */
		public function conexion($app, $conexion);
		
		/**
		 * InterfaceUtilidades::gab()
		 * 
		 * Retorna el objeto correspondiente para
		 * guardar - actualizar - borrar
		 * 
		 * @param string $conexion
		 * @param string $tabla
		 * @return object
		 */
		public function gab($conexion, $tabla);
		
		/**
		 * InterfaceUtilidades::generadorQuery()
		 * 
		 * Genera el objeto para crear query con la
		 * libreria queryBuilder de Doctrine
		 * 
		 * @param string $conexion
		 * @return object
		 */
		public function generadorQuery($conexion);
		
		/**
		 * InterfaceUtilidades::importarModelo()
		 *
		 * Retorna el objeto del modelo
		 * seleccionado en el cual puede obtener
		 * datos de los modelos creados en la
		 * aplicacion actual
		 *  
		 * @param string $modulo
		 * @param string $modelo
		 * @return object
		 */
		public function importarModelo($modulo, $modelo);
		
		/**
		 * InterfaceUtilidades::plantilla()
		 * 
		 * Genera el proceso de plantillas con la
		 * libreria Twig
		 * 
		 * @return object
		 */
		public function plantilla($app);
		
		/**
		 * InterfaceUtilidades::validar()
		 * 
		 * Genera el objeto correspondiente donde
		 * se encuentran las diferentes
		 * validaciones basicas que se pueden
		 * realizar
		 * 
		 * @return object
		 */
		public function validar();
	}