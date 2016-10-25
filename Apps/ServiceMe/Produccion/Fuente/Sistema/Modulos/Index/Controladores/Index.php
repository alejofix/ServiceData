<?php

	namespace Controlador\Modulo\Index;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	use \Utilidades\Sesion;
	
	/**
	 * Controlador {Index}
	 * 
	 * El controlador es requerido extenderlo hacia la
	 * clase u objeto ubicado en el namespace \Mvc\Controlador.
	 * 
	 * El controlador debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del controlador debe ser igual a la clase
	 * controlador
	 * 
	 */
	class Index extends Controlador {
		
		private $sesion;
		
		/**
		 * Index::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del controlador
		 *
		 * @return mixed
		 */
		public function __construct() {
			parent::__construct();
		}
		
		/**
		 * Index::Index()
		 * 
		 * Metodo necesario para la carga del controlador
		 * el cual es necesario para la carga automatica
		 * del metodo inicial por defecto
		 *  
		 * @return mixed
		 */
		public function Index() {
			
			$this->plantilla->parametro('validacion', $this->validarFormulario->crearJs(APP, true, false, '\Formularios\Login\Index'));
			echo $this->plantilla->mostrarPlantilla('Base', 'Login.html');
		}
		
		/**
		 * Index::autenticar()
		 * 
		 * validacion de formulario
		 * @return raw
		 */
		public function autenticar() {
			$this->cabecera->header('json');
			
			if($this->validarFormulario->validar('\Formularios\Login\Index') == true):
				$this->validarUsuario();
			else:
				echo json_encode(array('status' => false, 'mensajes' => $this->validarFormulario->mensajeError()));
			endif;
		}
		
		/**
		 * Index::validarUsuario()
		 * 
		 * validacion de usuario en el cual genera la sesion o el mensaje dde errror correspondiente
		 * @return raw
		 */
		private function validarUsuario() {
			$consulta = $this->modelo->consultarUsuario((array) $this->validarFormulario->datosFormato());
			
			if(count($consulta) == 1):
				//echo json_encode(array('status' => true));
				$permisos = $this->modelo->consultarPermisos($consulta->getPermiso()->getId());
				
				foreach ($permisos AS $obj):
					$lista[$obj->getModulo()->getNombre()] = array(
						'lectura' => $obj->getBase()->getLectura(),
						'escritura' => $obj->getBase()->getEscritura(),
						'eliminar' => $obj->getBase()->getEliminar(),
						'actualizar' => $obj->getBase()->getActualizar()
					);
				endforeach;
				
				$data = array(
					'info' => array(
						'usuario' => $consulta->getUsuario(),
						'nombre' => trim($consulta->getNombreInicial().' '.$consulta->getNombreFinal()),
						'apellido' => trim($consulta->getApellidoInicial().' '.$consulta->getApellidoFinal()),
						'empresa' => $consulta->getEmpresa()->getNombre(),
						'em_id' => $consulta->getEmpresa()->getId(),
						'correo' => $consulta->getCorreo(),
						'genero' => $consulta->getGenero(),
						'cargo' => $consulta->getCargo()->getNombre(),
						'rr' => $consulta->getRr(),
					),
					'permisos' => $lista,
					'sesion' => array(
						'fecha' => $fecha = date("Y-m-d H:i:s"),
						'llave' => sha1(implode('_', array($consulta->getUsuario(), $consulta->getGenero(), $fecha)))
					)
				);
				
				$sesion = new Sesion();
				$sesion->registrar($data);
				
				echo json_encode(array('status' => true));
			else:
				echo json_encode(array('status' => false, 'mensaje' => array('Usuario y/o Contraseña incorrectos')));
			endif;
		}
	}