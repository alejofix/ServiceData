<?php

	/**
	 * Namespace Modelo Modulo
	 * 
	 * Se genera el namespace para el MVC
	 * el cual se diferencia la carga de la misma
	 * @example namespace Modelo\MVC
	 */
	namespace Modelo\Modulo\Usuarios;
	use \Neural\BD\Conexion;
	use \Entidades\ServiceMe\TblUsuarios AS Usuarios;
	
	/**
	 * Modelo {Nuevo}
	 * 
	 * El Modelo debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del Modelo y de la clase del modelo 
	 * debe ser igual a la clase controlador
	 */
	class Nuevo {
		
		/**
		 * Asigna el objeto de conexion para todo
		 * el modelo el cual se puede ejecutar SQL
		 * directamente
		 */
		private $conexion = false;
		
		/**
		 * Asigan el objeto de conexion para poder
		 * utilizar las entidades generadas por
		 * Doctrine ORM
		 */
		private $entidad = false;
		
		/**
		 * Nuevo::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del Modelo
		 *
		 * @return mixed
		 */
		public function __construct() {
			$conexion = new Conexion(APPBD, APP);
			$this->conexion = $conexion->doctrineDBAL();
			$this->entidad = $conexion->doctrineORM();
		}
		
		/**
		 * Nuevo::guardar()
		 * 
		 * Metodo necesario para el proceso del Modelo
		 *  
		 * @return mixed
		 */
		public function guardar($array = array()) {
			
			$usuario = new Usuarios();
			
			foreach ($array AS $metodo => $valor):
				if($metodo == 'setEmpresa'):
					call_user_func_array(array($usuario, $metodo), array($this->entidad->getRepository('\Entidades\ServiceMe\TblGeneralEmpresas')->findOneBy(array('id' => $valor))));
				elseif($metodo == 'setPermiso'):
					call_user_func_array(array($usuario, $metodo), array($this->entidad->getRepository('\Entidades\ServiceMe\TblPermisos')->findOneBy(array('id' => $valor))));
				elseif($metodo == 'setCargo'):
					call_user_func_array(array($usuario, $metodo), array($this->entidad->getRepository('\Entidades\ServiceMe\TblGeneralCargo')->findOneBy(array('id' => $valor))));
				elseif($metodo == 'setFechaNacimiento' OR $metodo == 'setFechaExpedicion'):
					call_user_func_array(array($usuario, $metodo), array(new \DateTime($valor)));
				else:
					call_user_func_array(array($usuario, $metodo), array($valor));
				endif;
				
			endforeach;
			
			$usuario->setEstado($this->entidad->getRepository('\Entidades\ServiceMe\TblGeneralEstados')->findOneBy(array('id' => 1)));
			
			$this->entidad->persist($usuario);
			$this->entidad->flush();
			
			return $usuario->getId();
		}
		
		public function listarEmpresas() {
			return $this->entidad
					->getRepository('\Entidades\ServiceMe\TblGeneralEmpresas')
					->findBy(array('estado' => 1), array('nombre' => 'ASC'));
		}
		
		public function listarCargos() {
			return $this->entidad
					->getRepository('\Entidades\ServiceMe\TblGeneralCargo')
					->findBy(array(), array('nombre' => 'ASC'));
		}
		
		public function listarPermisos() {
			return $this->entidad
					->getRepository('\Entidades\ServiceMe\TblPermisos')
					->findBy(array('estado' => 1), array('nombre' => 'ASC'));
		}
		
		public function existenciaUsuario($usuario) {
			return $this->entidad
					->getRepository('\Entidades\ServiceMe\TblUsuarios')
					->findOneBy(array('usuario' => $usuario));
		}
	}