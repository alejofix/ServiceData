<?php

	namespace Modelo\Modulo\Index;
	use \Neural\BD\Conexion;
	
	/**
	 * Modelo {Index}
	 * 
	 * El Modelo debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del Modelo y de la clase del modelo 
	 * debe ser igual a la clase controlador
	 */
	class Index {
		
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
		 * Index::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del Modelo
		 *
		 * @return mixed
		 */
		public function __construct() {
			$conexion = new Conexion(APPBD, APP);
			$this->entidad = $conexion->doctrineORM();
		}
		
		/**
		 * Index::consultarUsuario()
		 * 
		 * Consulta de usuario del login para el ingreso
		 * @return object
		 */
		public function consultarUsuario($array = array()) {
			return $this->entidad->getRepository('\Entidades\ServiceMe\TblUsuarios')->findOneBy($array);
		}
		
		/**
		 * Index::consultarPermisos()
		 * 
		 * consulta de permsisos segun el id del usuario
		 * @param mixed $id
		 * @return
		 */
		public function consultarPermisos($id = null) {
			return $this->entidad->getRepository('\Entidades\ServiceMe\TblPermisosSecSeleccion')->findBy(array('permiso' => $id));
		}
	}