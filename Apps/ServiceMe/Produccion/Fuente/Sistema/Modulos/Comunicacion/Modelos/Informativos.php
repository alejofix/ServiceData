<?php

	/**
	 * Namespace Modelo Modulo
	 * 
	 * Se genera el namespace para el MVC
	 * el cual se diferencia la carga de la misma
	 * @example namespace Modelo\MVC
	 */
	namespace Modelo\Modulo\Comunicacion;
	use \Neural\BD\Conexion;
	
	/**
	 * Modelo {Informativos}
	 * 
	 * El Modelo debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del Modelo y de la clase del modelo 
	 * debe ser igual a la clase controlador
	 */
	class Informativos {
		
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
		 * Informativos::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del Modelo
		 *
		 * @return mixed
		 */
		public function __construct() {
			$conexion = new Conexion('Nombre Conexion BD', 'Nombre de la Aplicacion');
			$this->conexion = $conexion->doctrineDBAL();
			$this->entidad = $conexion->doctrineORM();
		}
		

	}