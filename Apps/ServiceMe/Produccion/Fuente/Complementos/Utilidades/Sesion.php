<?php
	
	namespace Utilidades;
	use \Neural\Excepcion;
	use \Neural\Sesion\SesionPHP;
	use \NeuralPHP\Reflexion\Init AS Comentarios;
	
	
	class Sesion {
		
		private $sesionPHP;
		private $contenedor;
		
		/**
		 * Sesion::__construct()
		 * 
		 * asignamos la sesion respectiva
		 * @return void
		 */
		function __construct($clase = null, $mod_rewrite = null, $twig = null) {
			$this->sesionPHP = new SesionPHP(APP, date("Y-m-d"));
			
			if(is_array($mod_rewrite) == true):
				$this->validacion($mod_rewrite, $clase);
				$twig->extension(new \Utilidades\Twig\AppExtension($this->contenedor['permisos'], $this->contenedor['info']));
			endif;
		}
		
		private function validacion($mod = null, $clase = null) {
			$ruta = new \Mvc\Rutas(APP, ENV_ENTORNO);
			if($this->sesionPHP->obtenerExistencia(APP) == false):
				header("Location: ".$ruta->mvc('LogOut', 'Index', 'NoPermitido'));
			endif;
			
			$this->contenedor = $array = $this->sesionPHP->obtener(APP);
			
			if($array['sesion']['llave'] != sha1(implode('_', array($array['info']['usuario'], $array['info']['genero'], $array['sesion']['fecha'])))):
				header("Location: ".$ruta->mvc('LogOut', 'Index', 'NoPermitido'));
			endif;
			
			if(array_key_exists($mod['modulo']['modulo'], $array['permisos']) == false):
				throw new Excepcion('No tiene permisos para observar el modulo solicitado', 100, APP);
			endif;
			
			if($array['permisos'][$mod['modulo']['modulo']]['lectura'] == 0):
				throw new Excepcion('No tiene permisos para observar el modulo solicitado', 101, APP);
			endif;
			
			$comentarios = new Comentarios(get_class($clase));
			$comentarios->registrarAnotaciones(__DIR__.DIRECTORY_SEPARATOR.'Anotaciones');
			$contenedor = $comentarios->metodos();
			
			if(array_key_exists($mod['modulo']['metodo'], $contenedor) == true):
				
				if(array_key_exists('permisos', $contenedor[$mod['modulo']['metodo']]) == false):
					throw new Excepcion('No tiene permisos para observar este modulo', 0, APP);
				endif;
				
				if(array_key_exists($contenedor[$mod['modulo']['metodo']]['permisos']['nombre'], $array['permisos'][$mod['modulo']['modulo']]) == false):
					throw new Excepcion('No tiene permisos para observar este modulo', 0, APP);
				endif;
				
				if($array['permisos'][$mod['modulo']['modulo']][$contenedor[$mod['modulo']['metodo']]['permisos']['nombre']] == 0):
					throw new Excepcion('No tiene permisos para observar este modulo', 0, APP);
				endif;

			else:
				throw new Excepcion('No tiene permisos para observar el metodo solicitado', 101, APP);
			endif;
		}
		
		/**
		 * Sesion::registrar()
		 * 
		 * registra una nueva sesion
		 * @param mixed $array
		 * @return void
		 */
		public function registrar($array) {
			$this->sesionPHP->asignar(APP, $array);
		}
		
		public function infoSesion() {
			return $this->contenedor['sesion'];
		}
		
		public function infoUsuario($llave = null) {
			if($llave == null):
				return $this->contenedor['info'];
			else:
				return (array_key_exists($llave, $this->contenedor['info']) == true) ? $this->contenedor['info'][$llave] : null;
			endif;
		}
		
		public function infoPermisos() {
			return $this->contenedor['permisos'];
		}
	}