<?php

	namespace Formularios\Mejoras\Gestion;

	/**
	 * @IdForm(id="form")
	 * @Formulario(metodo="post", ajax=true, formato=true)
	 * @JQuery(general="jQuery")
	 * @Seguridad(seguridad=true, token="da39a3ee5e6b4b0d3255bfef95601890afd80709") 
	 */
	class AjaxAprobado {

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
		 * @Nombre("mejora")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="integer")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo es requerido"), 
		 * 		@Numero(mensaje="El campo no es numerico")
		 * })
		 * @Formato({"trim"})
		 */
		private $mejora;
		
		public function getMejora() {
			return $this->mejora;
		}
		
		public function setMejora($mejora) {
			$this->mejora = $mejora;
		}

		/**
		 * AjaxAprobado::getId()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getId() {
			return $this->id;
		}
		
		/**
		 * AjaxAprobado::setId()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setId($id = null) {
			return $this->id = $id;
		}

		/**
		 * AjaxAprobado::peticionAjax()
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