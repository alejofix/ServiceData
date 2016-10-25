<?php

	/**
	 * Namespace Controlador Modulo
	 * 
	 * Se genera el namespace para el Modulo
	 * el cual se diferencia la carga de la misma
	 * @example namespace Controlador\Modulo\{nombre del modulo}
	 */
	namespace Controlador\Modulo\Usuarios;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	use \Utilidades\Sesion;	
	
	/**
	 * Controlador {Nuevo}
	 * 
	 * El controlador es requerido extenderlo hacia la
	 * clase u objeto ubicado en el namespace \Mvc\Controlador.
	 * 
	 * El controlador debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del controlador debe ser igual a la clase
	 * controlador
	 */
	class Nuevo extends Controlador {
		
		private $sesion;
		
		/**
		 * Nuevo::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del controlador
		 *
		 * @Permisos("escritura")
		 * @return mixed
		 */
		public function __construct() {
			parent::__construct();
			$this->sesion = new Sesion($this, $this->url, $this->plantilla);
		}

		/**
		 * Nuevo::Index()
		 * 
		 * Metodo necesario para la carga del controlador
		 * el cual es necesario para la carga automatica
		 * del metodo inicial por defecto
		 *
		 * @Permisos("escritura")
		 * @return mixed
		 */
		public function Index() {
			
			$this->plantilla->parametro('formula', new \Utilidades\Formularios\Constructor('\Formularios\Usuarios\Nuevo'));
			$this->plantilla->parametro('empresas', $this->modelo->listarEmpresas());
			$this->plantilla->parametro('cargos', $this->modelo->listarCargos());
			$this->plantilla->parametro('permisos', $this->modelo->listarPermisos());
			$this->plantilla->parametro('validacion', $this->validarFormulario->crearJs(APP, true, false, '\Formularios\Usuarios\Nuevo'));
			echo $this->plantilla->mostrarPlantilla('Nuevo', 'Index.html');
		}
		
		/**
		 * Nuevo::procesar()
		 * 
		 * Genera el proceso de guardar la informacion del nuevo usuario
		 * @Permisos("escritura")
		 * @return raw
		 */
		public function procesar() {
			if($this->validarFormulario->validar('\Formularios\Usuarios\Nuevo') == true):
				$resultado = $this->modelo->guardar((array) $this->validarFormulario->datosFormato());
				
				if($resultado == 0):
					throw new Excepcion('No fue posible guardar los datos, validar con el administrador del sistema', 0, APP, 'usuarios:nuevo');
				endif;
				
			//	echo $this->plantilla->mostrarPlantilla('Nuevo', 'Usuario_Nuevo.html');
				
			else:
				print_r($this->validarFormulario->mensajeError());
			endif;
		}
		
		/**
		 * Nuevo::existencia()
		 * 
		 * peticion ajax donde se determina si el usuario ingresado 
		 * ya existe en la base de datos
		 * 
		 * @Permisos("escritura")
		 * @return string
		 */
		public function existencia() {
			if($this->request->ajax() == true):
				
				if($this->request->post->existencia('user') == true):
					echo ($this->modelo->existenciaUsuario(mb_strtoupper($this->request->post->obtener('user'))) == true) ? 'false' : 'true';
				else:
					echo 'true';
				endif;
				
			else:
				throw new Excepcion('No es posible procesar su peticion', 10, APP);
			endif;
		}
	}