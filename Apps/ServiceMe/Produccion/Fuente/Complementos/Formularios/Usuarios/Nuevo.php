<?php

	namespace Formularios\Usuarios;

	/**
	 * @IdForm(id="nuevo_usuario")
	 * @Formulario(metodo="post", ajax=true, formato=true)
	 * @JQuery(general="jQuery")
	 * @Seguridad(seguridad=true, token="da39a3ee5e6b4b0d3255bfef95601890afd80709")
	 * @Complemento(url="{{ RUTA_APP }}/Usuarios/Nuevo/procesar", class="form-horizontal form-groups-bordered") 
	 */
	class Nuevo {

		/**
		 * @Nombre("setUsuario")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Usuario es requerido"), 
		 * 		@MaxCaracteres(cantidad=40, mensaje="la cantidad maxima de caracteres para Usuario es 40"),
		 * 		@MinCaracteres(cantidad=5, mensaje="La cantidad minima de caracteres para Usuario es 5"),
		 * 		@Remoto(url="{{ RUTA_APP|e }}/Usuarios/Nuevo/existencia", metodo="POST", mensaje="El usuario ya se encuentra registrado")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Usuario", type="text", class="form-control", placeholder="Ingresar Usuario", autofocus="autofocus")
		 */
		private $user;

		/**
		 * @Nombre("setPassword")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Contraseña es requerido"), 
		 * 		@MaxCaracteres(cantidad=255, mensaje="la cantidad maxima de caracteres es 255"), 
		 * 		@MinCaracteres(cantidad=5, mensaje="La cantidad minima de caracteres es 5")
		 * })
		 * @Formato({"trim", "sha1"})
		 * @Input(label="Contraseña", type="password", class="form-control", placeholder="Ingresar Contraseña")
		 */
		private $pass;

		/**
		 * @Nombre("setNombreInicial")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Nombre Inicial es requerido"), 
		 * 		@MaxCaracteres(cantidad=255, mensaje="la cantidad maxima de caracteres es 255")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Primer Nombre", type="text", class="form-control", placeholder="Ingresar Primer Nombre")
		 */
		private $pn;

		/**
		 * @Nombre("setNombreFinal")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={})
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Segundo Nombre", type="text", class="form-control", placeholder="Ingresar Segundo Nombre")
		 */
		private $sn;

		/**
		 * @Nombre("setApellidoInicial")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Apellido Inicial es requerido"), 
		 * 		@MaxCaracteres(cantidad=255, mensaje="la cantidad maxima de caracteres es 255")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Primer Apellido", type="text", class="form-control", placeholder="Ingresar Primer Apellido")
		 */
		private $pa;

		/**
		 * @Nombre("setApellidoFinal")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={})
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Segundo Apellido", type="text", class="form-control", placeholder="Ingresar Segundo Apellido")
		 */
		private $sa;

		/**
		 * @Nombre("setDocumento")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Número de Documento es requerido"), 
		 * 		@MaxCaracteres(cantidad=255, mensaje="la cantidad maxima de caracteres es 255")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Numero de Documento", type="text", class="form-control", placeholder="Ingresar Numero de Documento")
		 */
		private $numdoc;

		/**
		 * @Nombre("setFechaNacimiento")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Fecha Nacimiento es requerido"), 
		 * 		@Fecha(mensaje="El formato de fecha no es valido")
		 * })
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Fecha de Nacimiento", type="text", class="form-control datepicker", placeholder="Ingresar Fecha de Nacimiento")
		 */
		private $fn;

		/**
		 * @Nombre("setFechaExpedicion")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Fecha expedición Documento es requerido"), 
		 * 		@Fecha(mensaje="El formato de fecha no es valido")
		 * })
		 * @Formato({"trim"})
		 * @Input(label="Fecha de Expedicion Documento", type="text", class="form-control datepicker", placeholder="Ingresar Fecha de Expedicion Documento")
		 */
		private $fe;

		/**
		 * @Nombre("setFijo")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={})
		 * @Formato({"trim"})
		 * @Input(label="Telefono Fijo", type="text", class="form-control", placeholder="Ingresar Telefono Fijo")
		 */
		private $tf;

		/**
		 * @Nombre("setMovil")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={})
		 * @Formato({"trim"})
		 * @Input(label="Telefono Celular", type="text", class="form-control", placeholder="Ingresar Telefono Celular")
		 */
		private $tc;

		/**
		 * @Nombre("setEps")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={})
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="EPS", type="text", class="form-control", placeholder="Ingresar EPS")
		 */
		private $eps;

		/**
		 * @Nombre("setArp")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={})
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="ARL", type="text", class="form-control", placeholder="Ingresar ARL")
		 */
		private $arp;

		/**
		 * @Nombre("setRr")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={})
		 * @Formato({"trim", "mb_strtoupper"})
		 * @Input(label="Usuario AS400", type="text", class="form-control", placeholder="Ingresar Usuario AS400")
		 */
		private $rr;

		/**
		 * @Nombre("setGenero")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Genero es requerido")
		 * })
		 * @Formato({"trim"})
		 * @Select(label="Genero", class="form-control")
		 */
		private $ge;

		/**
		 * @Nombre("setCorreo")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={})
		 * @Formato({"trim", "mb_strtolower"})
		 * @Input(label="Correo", type="text", class="form-control", placeholder="Ingresar Correo")
		 */
		private $co;

		/**
		 * @Nombre("setEmpresa")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="integer")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Empresa es requerido")
		 * })
		 * @Formato({})
		 * @Select(label="Empresa", class="form-control")
		 */
		private $company;

		/**
		 * @Nombre("setPermiso")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="integer")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Permiso es requerido")
		 * })
		 * @Formato({})
		 * @Select(label="Permiso", class="form-control")
		 */
		private $pe;

		/**
		 * @Nombre("setCargo")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="integer")
		 * @Proceso(validacion={
		 * 		@Requerido(mensaje="El campo Cargo es requerido")
		 * })
		 * @Formato({})
		 * @Select(label="Cargo", class="form-control")
		 */
		private $ca;

		/**
		 * Nuevo::getUser()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getUser() {
			return $this->user;
		}
		
		/**
		 * Nuevo::setUser()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setUser($user = null) {
			return $this->user = $user;
		}

		/**
		 * Nuevo::getPass()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getPass() {
			return $this->pass;
		}
		
		/**
		 * Nuevo::setPass()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setPass($pass = null) {
			return $this->pass = $pass;
		}

		/**
		 * Nuevo::getPn()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getPn() {
			return $this->pn;
		}
		
		/**
		 * Nuevo::setPn()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setPn($pn = null) {
			return $this->pn = $pn;
		}

		/**
		 * Nuevo::getSn()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getSn() {
			return $this->sn;
		}
		
		/**
		 * Nuevo::setSn()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setSn($sn = null) {
			return $this->sn = $sn;
		}

		/**
		 * Nuevo::getPa()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getPa() {
			return $this->pa;
		}
		
		/**
		 * Nuevo::setPa()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setPa($pa = null) {
			return $this->pa = $pa;
		}

		/**
		 * Nuevo::getSa()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getSa() {
			return $this->sa;
		}
		
		/**
		 * Nuevo::setSa()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setSa($sa = null) {
			return $this->sa = $sa;
		}

		/**
		 * Nuevo::getNumdoc()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getNumdoc() {
			return $this->numdoc;
		}
		
		/**
		 * Nuevo::setNumdoc()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setNumdoc($numdoc = null) {
			return $this->numdoc = $numdoc;
		}

		/**
		 * Nuevo::getFn()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getFn() {
			return $this->fn;
		}
		
		/**
		 * Nuevo::setFn()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setFn($fn = null) {
			return $this->fn = $fn;
		}

		/**
		 * Nuevo::getFe()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getFe() {
			return $this->fe;
		}
		
		/**
		 * Nuevo::setFe()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setFe($fe = null) {
			return $this->fe = $fe;
		}

		/**
		 * Nuevo::getTf()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getTf() {
			return $this->tf;
		}
		
		/**
		 * Nuevo::setTf()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setTf($tf = null) {
			return $this->tf = $tf;
		}

		/**
		 * Nuevo::getTc()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getTc() {
			return $this->tc;
		}
		
		/**
		 * Nuevo::setTc()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setTc($tc = null) {
			return $this->tc = $tc;
		}

		/**
		 * Nuevo::getEps()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getEps() {
			return $this->eps;
		}
		
		/**
		 * Nuevo::setEps()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setEps($eps = null) {
			return $this->eps = $eps;
		}

		/**
		 * Nuevo::getArp()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getArp() {
			return $this->arp;
		}
		
		/**
		 * Nuevo::setArp()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setArp($arp = null) {
			return $this->arp = $arp;
		}

		/**
		 * Nuevo::getRr()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getRr() {
			return $this->rr;
		}
		
		/**
		 * Nuevo::setRr()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setRr($rr = null) {
			return $this->rr = $rr;
		}

		/**
		 * Nuevo::getGe()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getGe() {
			return $this->ge;
		}
		
		/**
		 * Nuevo::setGe()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setGe($ge = null) {
			return $this->ge = $ge;
		}

		/**
		 * Nuevo::getCo()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getCo() {
			return $this->co;
		}
		
		/**
		 * Nuevo::setCo()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setCo($co = null) {
			return $this->co = $co;
		}

		/**
		 * Nuevo::getCompany()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getCompany() {
			return $this->company;
		}
		
		/**
		 * Nuevo::setCompany()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setCompany($company = null) {
			return $this->company = $company;
		}

		/**
		 * Nuevo::getPe()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getPe() {
			return $this->pe;
		}
		
		/**
		 * Nuevo::setPe()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setPe($pe = null) {
			return $this->pe = $pe;
		}

		/**
		 * Nuevo::getCa()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function getCa() {
			return $this->ca;
		}
		
		/**
		 * Nuevo::setCa()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function setCa($ca = null) {
			return $this->ca = $ca;
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
			return 'jQuery.ajax({
				url : "{{ RUTA_APP }}/Usuarios/Nuevo/procesar",
				data : jQuery(formulario).serialize(),
				dataType : "html",
				type : "POST",
				error : function() {
					sweetAlert("Error...", "Consulte con el Administrador de Sistema", "error");	
				},
				success : function(resultado) {
					swal("Nuevo Usuario", "Datos almacenados Satisfactoriamente", "success");
					document.getElementById("nuevo_usuario").reset();
				},
			});';
		}
	}