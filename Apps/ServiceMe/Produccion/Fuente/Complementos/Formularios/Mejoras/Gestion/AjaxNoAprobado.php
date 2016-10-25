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

	namespace Formularios\Mejoras\Gestion;

	/**
	 * @IdForm(id="form")
	 * @Formulario(metodo="post", ajax=true, formato=true)
	 * @JQuery(general="jQuery")
	 * @Seguridad(seguridad=false, token="da39a3ee5e6b4b0d3255bfef95601890afd80709") 
	 */
	class AjaxNoAprobado {

		/**
		 * @Nombre("id")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="integer")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo es requerido"), 
		 * 		@Numero(mensaje="El campo no es numerico")
		 * })
		 * @Formato({"trim"})
		 */
		private $id;

		/**
		 * @Nombre("descripcion")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo descripcion es requerido")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 */
		private $descripcion;

		/**
		 * AjaxNoAprobado::getId()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getId() {
			return $this->id;
		}
		
		/**
		 * AjaxNoAprobado::setId()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setId($id = null) {
			return $this->id = $id;
		}

		/**
		 * AjaxNoAprobado::getDescripcion()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getDescripcion() {
			return $this->descripcion;
		}
		
		/**
		 * AjaxNoAprobado::setDescripcion()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setDescripcion($descripcion = null) {
			return $this->descripcion = $descripcion;
		}

		/**
		 * AjaxNoAprobado::peticionAjax()
		 *
		 * Genera el proceso en JavaScript JQuery
		 * para la petición ajax
		 *
		 * @return string
		 */
		public function peticionAjax() {
			return 'jQuery.ajax({
				url : "url de la consulta",
				data : jQuery(formulario).serialize(),
				dataType : "json",
				type : "POST",
				success : function(resultado) {
					
				}
			});';
		}
	}