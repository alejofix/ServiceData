<?php

	/**
	 * Namespace Modelo Modulo
	 * 
	 * Se genera el namespace para el MVC
	 * el cual se diferencia la carga de la misma
	 * @example namespace Modelo\MVC
	 */
	namespace Modelo\Modulo\Proyectos;
	use \Neural\BD\Conexion;
	
	/**
	 * Modelo {Lista}
	 * 
	 * El Modelo debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del Modelo y de la clase del modelo 
	 * debe ser igual a la clase controlador
	 */
	class Lista {
		
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
		 * Lista::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del Modelo
		 *
		 * @return mixed
		 */
		public function __construct() {
			$conexion = new Conexion(APPBD, APP);
			$this->conexion = $conexion->doctrineDBAL();
		//	$this->entidad = $conexion->doctrineORM();
		}
		
		/**
		 * Lista::Lista()
		 * 
		 * Metodo necesario para el proceso del Modelo
		 *  
		 * @return mixed
		 */
		public function Lista() {
			
		}
	}