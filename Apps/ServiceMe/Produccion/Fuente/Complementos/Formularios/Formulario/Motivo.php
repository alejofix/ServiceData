<?php

	namespace Formularios\Formulario;

	/**
	 * @IdForm(id="formularios")
	 * @Formulario(metodo="post", ajax=false, formato=true)
	 * @JQuery(general="jQuery")
	 * @Seguridad(seguridad=false, token="da39a3ee5e6b4b0d3255bfef95601890afd80709") 
	 */
	class Motivo {

		/**
		 * @Nombre("setTipo")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo es requerido")
		 * })
		 * @Formato({})
		 */
		private $tip;

		/**
		 * @Nombre("setCuenta")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo es requerido"), 
		 * 		@Numero(mensaje="El campo no es numerico")
		 * })
		 * @Formato({})
		 */
		private $cta;

		/**
		 * @Nombre("setRazon")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo es requerido")
		 * })
		 * @Formato({})
		 */
		private $raz;

		/**
		 * @Nombre("setFecha")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Fecha(mensaje="El formato de fecha no es valido"), 
		 * 		@Requerido(mensaje="El campo es requerido")
		 * })
		 * @Formato({})
		 */
		private $fec;

		/**
		 * @Nombre("setReferencia")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@MinCaracteres(cantidad=1, mensaje="La cantidad minima de caracteres es 1"), 
		 * 		@MaxCaracteres(cantidad=255, mensaje="la cantidad maxima de caracteres es 255")
		 * })
		 * @Formato({})
		 */
		private $ref;

		/**
		 * @Nombre("setInformacion")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@MinCaracteres(cantidad=1, mensaje="La cantidad minima de caracteres es 1"), 
		 * 		@MaxCaracteres(cantidad=255, mensaje="la cantidad maxima de caracteres es 255")
		 * })
		 * @Formato({})
		 */
		private $info;

		/**
		 * Motivo::getTip()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getTip() {
			return $this->tip;
		}
		
		/**
		 * Motivo::setTip()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setTip($tip = null) {
			return $this->tip = $tip;
		}

		/**
		 * Motivo::getCta()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getCta() {
			return $this->cta;
		}
		
		/**
		 * Motivo::setCta()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setCta($cta = null) {
			return $this->cta = $cta;
		}

		/**
		 * Motivo::getRaz()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getRaz() {
			return $this->raz;
		}
		
		/**
		 * Motivo::setRaz()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setRaz($raz = null) {
			return $this->raz = $raz;
		}

		/**
		 * Motivo::getFec()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getFec() {
			return $this->fec;
		}
		
		/**
		 * Motivo::setFec()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setFec($fec = null) {
			return $this->fec = $fec;
		}

		/**
		 * Motivo::getRef()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getRef() {
			return $this->ref;
		}
		
		/**
		 * Motivo::setRef()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setRef($ref = null) {
			return $this->ref = $ref;
		}

		/**
		 * Motivo::getInfo()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getInfo() {
			return $this->info;
		}
		
		/**
		 * Motivo::setInfo()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setInfo($info = null) {
			return $this->info = $info;
		}

		/**
		 * Motivo::peticionAjax()
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