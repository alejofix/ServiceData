<?php

	/**
	 * Namespace Modelo Modulo
	 * 
	 * Se genera el namespace para el MVC
	 * el cual se diferencia la carga de la misma
	 * @example namespace Modelo\MVC
	 */
	namespace Modelo\Modulo\Mejoras;
	use \Neural\BD\Conexion;
	
	/**
	 * Modelo {Listado}
	 * 
	 * El Modelo debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del Modelo y de la clase del modelo 
	 * debe ser igual a la clase controlador
	 */
	class Listado {
		
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
		 * Listado::__construct()
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
		 * Listado::Listado()
		 * 
		 * Genera el listado de de las mejoras que se encuentran
		 * en estados ACTIVO, ESCALADO
		 * Se organizan el resultado por estado y fecha, mostrando
		 * primero los estados escalados y luego los activos
		 * fecha desde el mas antiguo hasta el mas new york
		 * Se muestran los datos solo por empresas excepto
		 * claro que observa todos
		 *  
		 * @return object
		 */
		public function Listado($id_empresa = false) {
			
			$qb = $this->entidad->createQueryBuilder();
			
			if($id_empresa > 1):
				
				return $qb->select('m')
					->from('\Entidades\ServiceMe\TblMejoramientoPriMejoras', 'm')
					->innerJoin('m.usuario', 'u')
					->innerJoin('u.empresa', 'e')
					->where($qb->expr()->in('m.estado', array(9, 7, 1)))
					->andWhere('e.id = :id')
					->setParameter('id', $id_empresa)
				//	->addOrderBy('m.estado', 'ASC')
					->addOrderBy('m.fecha', 'ASC')
					->getQuery()
					->getResult();	
			else:
				return $qb->select('m')
					->from('\Entidades\ServiceMe\TblMejoramientoPriMejoras', 'm')
					->where($qb->expr()->in('m.estado', array(9, 7, 1)))
				//	->addOrderBy('m.estado', 'ASC')
					->addOrderBy('m.fecha', 'ASC')
					->getQuery()
					->getResult();
			endif;
		}
	}