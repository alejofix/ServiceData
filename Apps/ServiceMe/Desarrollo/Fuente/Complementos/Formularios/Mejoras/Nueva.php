<?php

	namespace Formularios\Mejoras;

	/**
	 * @IdForm(id="nueva_mejora")
	 * @Formulario(metodo="post", ajax=false, formato=true)
	 * @JQuery(general="jQuery")
	 * @Seguridad(seguridad=true, token="da39a3ee5e6b4b0d3255bfef95601890afd80709")
	 * @Complemento(url="{{ RUTA_APP }}/Mejoras/Nueva/Documentar", class="form-horizontal form-groups-bordered", archivos=true) 
	 */
	class Nueva {

		/**
		 * @Nombre("setHerramienta")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Selección Herramienta es requerido")
		 * })
		 * @Formato({})
		 * @Select(label="Herramienta", class="form-control", autofocus="autofocus")
		 */
		private $her;

		/**
		 * @Nombre("setProducto")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="integer")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Producto es requerido")
		 * })
		 * @Formato({})
		 * @Select(label="Producto", class="form-control")
		 */
		private $pro;

		/**
		 * @Nombre("setArbol")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Árbol es requerido"),
		 * 		@RangoCaracteres(inicio=5, fin=50, mensaje="El rango de caracteres Árbol es de 5 a 50")
		 * })
		 * @Formato({})
		 * @Input(label="Árbol", type="text", class="form-control", placeholder="Ingresar Nombre del Árbol")
		 */
		private $arb;

		/**
		 * @Nombre("setTitulo")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Título es requerido"),
		 * 		@RangoCaracteres(inicio=5, fin=50, mensaje="El rango de caracteres Título es de 5 a 50")
	 	 * })
		 * @Formato({})
		 * @Input(label="Título de la Mejora", type="text", class="form-control", placeholder="Ingresar Título")
		 */
		private $tit;

		/**
		 * @Nombre("setDescripcion")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Descripción es requerido"), 
		 * 		@RangoCaracteres(inicio=5, fin=275, mensaje="El rango de caracteres Descripción es de 5 a 275")
		 * })
		 * @Formato({})
		 * @Textarea(label="Descripción", class="form-control", placeholder="Ingresar Descripción de Mejora")
		 */
		private $des;

		/**
		 * @Nombre("setObjetivo")
		 * @Configuracion(existencia=true, array=true, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Objetivo es requerido una vez"), 
		 * 		@RangoCaracteres(inicio=5, fin=275, mensaje="El rango de caracteres Objetivo es de 5 a 275")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Textarea(label="Objetivo", class="form-control", placeholder="Ingresar Objetivo", array=true)
		 */
		private $obj;
		
		/**
		 * @Nombre("setRuta")
		 * @Configuracion(existencia=true, array=true, campos={"ruta", "", "ruta"})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Descripcion Ruta", class="form-control", placeholder="Ingresar Ruta", array=true, campo={""})
		 */
		private $ruta;
		
		/**
		 * @Nombre("setProceso")
		 * @Configuracion(existencia=true, array=true, campos={"ruta", "", "proceso"})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Select(label="Proceso", class="form-control", array=true, campo={""})
		 */
		private $proceso;
		
		/**
		 * @Nombre("adjuntos")
		 * @Configuracion(existencia=true, array=true, campos={"file", ""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(type="file", label="Descripcion Ruta", class="form-control", placeholder="Archivo adjuto", array=true, campo={""})
		 */
		private $archivos;
		
		public function getArchivos() {
			return $this->archivos;
		}
		
		public function setArchivos($archivo = null) {
			$this->archivos = $archivo;
		}
		
		/**
		 * Index::getObj()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getObj() {
			return $this->obj;
		}
		
		/**
		 * Index::setObj()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setObj($obj = null) {
			return $this->obj = $obj;
		}

		/**
		 * Nueva::getUsu()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getUsu() {
			return $this->usu;
		}
		
		/**
		 * Nueva::setUsu()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setUsu($usu = null) {
			return $this->usu = $usu;
		}

		/**
		 * Nueva::getFec()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getFec() {
			return $this->fec;
		}
		
		/**
		 * Nueva::setFec()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setFec($fec = null) {
			return $this->fec = $fec;
		}

		/**
		 * Nueva::getHer()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getHer() {
			return $this->her;
		}
		
		/**
		 * Nueva::setHer()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setHer($her = null) {
			return $this->her = $her;
		}

		/**
		 * Nueva::getPro()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getPro() {
			return $this->pro;
		}
		
		/**
		 * Nueva::setPro()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setPro($pro = null) {
			return $this->pro = $pro;
		}

		/**
		 * Nueva::getArb()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getArb() {
			return $this->arb;
		}
		
		/**
		 * Nueva::setArb()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setArb($arb = null) {
			return $this->arb = $arb;
		}

		/**
		 * Nueva::getTit()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getTit() {
			return $this->tit;
		}
		
		/**
		 * Nueva::setTit()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setTit($tit = null) {
			return $this->tit = $tit;
		}

		/**
		 * Nueva::getDes()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getDes() {
			return $this->des;
		}
		
		/**
		 * Nueva::setDes()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setDes($des = null) {
			return $this->des = $des;
		}

		/**
		 * Nueva::getAdj()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getAdj() {
			return $this->adj;
		}
		
		/**
		 * Nueva::setAdj()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setAdj($adj = null) {
			return $this->adj = $adj;
		}

		/**
		 * Nueva::getEst()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getEst() {
			return $this->est;
		}
		
		/**
		 * Nueva::setEst()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setEst($est = null) {
			return $this->est = $est;
		}

		/**
		 * Nueva::peticionAjax()
		 *
		 * Genera el proceso en JavaScript JQuery
		 * para la petición ajax
		 *
		 * @return string
		 */
		public function peticionAjax() {
			return 'jQuery.ajax({
				url : "{{ RUTA_APP }}/Mejoras/Nueva/Documentar",
				data : jQuery(formulario).serialize(),
				dataType : "json",
				type : "POST",
				error : function(error) {
					alert("Se ha presentado un error validar con el administrador del sistema");
				},
				success : function(resultado) {
					if(resultado.status >= 1) {
						//jQuery("#respuesta").html(resultado);
						window.location.href = "{{ RUTA_APP }}/Mejoras/Observar/Index/" + resultado.status;
					}
					else {
						//sweetalert con los errores
						alert("Hay Errores en el formulario");
					}
				}
			});';
		}
	}