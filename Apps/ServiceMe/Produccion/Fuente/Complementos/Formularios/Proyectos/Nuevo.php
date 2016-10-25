<?php

	namespace Formularios\Proyectos;

	/**
	 * @IdForm(id="nuevo_proyecto")
	 * @Formulario(metodo="post", ajax=true, formato=true)
	 * @JQuery(general="jQuery")
	 * @Seguridad(seguridad=true, token="da39a3ee5e6b4b0d3255bfef95601890afd80709") 
	 * @Complemento(url="{{ RUTA_APP }}/Proyectos/Nuevo/procesar", class="form-horizontal form-groups-bordered")
	 */
	class Nuevo {

		/**
		 * @Nombre("setNombre")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Nombre Proyecto es requerido"), 
		 * 		@RangoCaracteres(inicio=5, fin=50, mensaje="El rango de caracteres Nombre Proyecto es de 5 a 50")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Nombre Proyecto", type="text", class="form-control", placeholder="Ingresar Nombre del Proyecto", autofocus="autofocus")
		 */
		private $nom;
		
		/**
		 * @Nombre("SetDescripcion")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Descripción es requerido"), 
		 * 		@RangoCaracteres(inicio=5, fin=140, mensaje="El rango de caracteres Descripción es de 5 a 140")
		 * })
		 * @Formato({"trim"})
		 * @Textarea(label="Descripción", class="form-control", placeholder="Ingresar Descripción del Proyecto")
		 */
		private $des;

		/**
		 * @Nombre("setTipo")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Tipo Proyecto es requerido")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Select(label="Tipo Proyecto", class="form-control")
		 */
		private $tip;

		/**
		 * @Nombre("setHoras")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="integer")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Horas Proyecto es requerido"), 
		 * 		@RangoCantidad(inicio=1, fin=2304, mensaje="El rango es de 1 a 2304 Horas")
		 * })
		 * @Formato({"trim"})
		 * @Input(label="Horas", type="number", class="form-control", placeholder="Ingresar Tiempo estimado en Horas")
		 */
		private $hor;

		
		/**
		 * Nuevo::getNom()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getNom() {
			return $this->nom;
		}
		
		/**
		 * Nuevo::setNom()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setNom($nom = null) {
			return $this->nom = $nom;
		}

		/**
		 * Nuevo::getDes()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getDes() {
			return $this->des;
		}
		
		/**
		 * Nuevo::setDes()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setDes($des = null) {
			return $this->des = $des;
		}

		/**
		 * Nuevo::getTip()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getTip() {
			return $this->tip;
		}
		
		/**
		 * Nuevo::setTip()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setTip($tip = null) {
			return $this->tip = $tip;
		}

		/**
		 * Nuevo::getHor()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getHor() {
			return $this->hor;
		}
		
		/**
		 * Nuevo::setHor()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setHor($hor = null) {
			return $this->hor = $hor;
		}

		/**
		 * Nuevo::peticionAjax()
		 *
		 * Genera el proceso en JavaScript JQuery
		 * para la petición ajax
		 *
		 * @return string
		 */
		public function peticionAjax() {
			return '
				jQuery.ajax({
				url : "{{ RUTA_APP }}/Proyectos/Nuevo/procesar",
				data : jQuery(formulario).serialize(),
				dataType : "html",
				type : "POST",
				success : function(resultado) {
					console.log(resultado);
					if(resultado.status = true) {
						swal("Proyecto " + resultado.codigo, "Se ha creado correctamente el proyecto con el codigo: " + resultado.codigo, "success");
						jQuery("#nuevo_proyecto")[0].reset();
					}
					else {
						swal("Error de Proyecto", "Se han presentado los siguientes errores: \n" + resultado.mensaje, "error");
					}
				}
			});
			';
		}
	}