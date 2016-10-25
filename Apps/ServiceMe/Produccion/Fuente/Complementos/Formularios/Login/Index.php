<?php

	namespace Formularios\Login;

	/**
	 * @IdForm(id="form_login")
	 * @Formulario(metodo="post", ajax=true, formato=true)
	 * @JQuery(general="jQuery")
	 * @Seguridad(seguridad=true, token="da39a3ee5e6b4b0d3255bfef95601890afd80709") 
	 */
	class Index {

		/**
		 * @Nombre("usuario")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Usuario es requerido"), 
		 * 		@MaxCaracteres(cantidad=50, mensaje="la cantidad maxima de caracteres es 50")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 */
		private $username;

		/**
		 * @Nombre("password")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Contraseña es requerido"), 
		 * 		@MinCaracteres(cantidad=5, mensaje="La cantidad minima de caracteres es 5")
		 * })
		 * @Formato({"trim", "sha1"})
		 */
		private $pass;

		/**
		 * Index::getUsername()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getUsername() {
			return $this->username;
		}
		
		/**
		 * Index::setUsername()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setUsername($username = null) {
			return $this->username = $username;
		}

		/**
		 * Index::getPass()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getPass() {
			return $this->pass;
		}
		
		/**
		 * Index::setPass()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setPass($pass = null) {
			return $this->pass = $pass;
		}

		/**
		 * Index::peticionAjax()
		 *
		 * Genera el proceso en JavaScript JQuery
		 * para la petición ajax
		 *
		 * @return string
		 */
		public function peticionAjax() {
			return 'jQuery.ajax({
				url : "{{ RUTA_APP|e }}/Index/Index/autenticar",
				data : jQuery(formulario).serialize(),
				dataType : "json",
				type : "POST",
				success : function(resultado) {
					if(resultado.status == true) {
						window.location.href="{{ RUTA_APP|e }}/Central";
					}
					else {
						sweetAlert("Error", resultado.mensaje.join("\n"), "error");
					}
				}
			});';
		}
	}