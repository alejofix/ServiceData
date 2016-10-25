<?php

	/**
	 * Namespace Modelo Modulo
	 * 
	 * Se genera el namespace para el MVC
	 * el cual se diferencia la carga de la misma
	 * @example namespace Modelo\MVC
	 */
	namespace Modelo\Modulo\Formularios;
	use \Neural\BD\Conexion;
	
	/**
	 * Modelo {Motivo}
	 * 
	 * El Modelo debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del Modelo y de la clase del modelo 
	 * debe ser igual a la clase controlador
	 */
	class Motivo {
		
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
		 * Motivo::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del Modelo
		 *
		 * @return mixed
		 */
		public function __construct($id = false) {
			$conexion = new Conexion(APPBD, APP);
			$this->conexion = $conexion->doctrineDBAL();
			// $this->entidad = $conexion->doctrineORM();
		}
		
		public function existenciaTipo(){
			$consulta = $this->conexion->prepare('SELECT COUNT(ID) AS CANTIDAD FROM TBL_FORMULARIOS_SEC_MOTIVO_TIPO WHERE ID = ? AND ESTADO = ?');
			$consulta->bindValue(1, $id, \PDO::PARAM_INT);
			$consulta->bindValue(2, 1, \PDO::PARAM_INT);
			$consulta->execute();
			return $consulta->fetch(PDO::FETCH_ASSOC);
		}
		
		public function listadoTipo(){
			$consulta = $this->conexion->prepare('SELECT ID, RAZON FROM TBL_FORMULARIOS_SEC_MOTIVO_RAZON WHERE TIPO = ? AND ESTADO = ?');
			$consulta->bindValue(1, $tipo, \PDO::PARAM_INT);
			$consulta->bindValue(2, 1, \PDO::PARAM_INT);
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		} 
		
		
	}