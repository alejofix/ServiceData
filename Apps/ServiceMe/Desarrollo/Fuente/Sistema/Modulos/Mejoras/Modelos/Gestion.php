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
	 * Modelo {Gestion}
	 * 
	 * El Modelo debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del Modelo y de la clase del modelo 
	 * debe ser igual a la clase controlador
	 */
	class Gestion {
		
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
		 * Gestion::__construct()
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
		 * Gestion::consultaMejora()
		 * 
		 * Genera la consulta de la mejora a gestionar
		 * @param integer $id 
		 * @return object
		 */
		public function consultaMejora($id = false) {
			return $this->entidad->getRepository('Entidades\ServiceMe\TblMejoramientoPriMejoras')
					->findOneBy(array('id' => $id));
		}
		
		/**
		 * Gestion::guardarAjaxAprobado()
		 * 
		 * Genera la actualizacion de la aprobacion
		 * de la mejora solicitada
		 * 
		 * @param array $array
		 * @return string
		 */
		public function guardarAjaxAprobado($array = array()) {
			
			$objetivo = $this->entidad->getRepository('Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos')->findOneBy(array('id' => $array['id']));
			$objetivo->setEstado($this->entidad->getRepository('Entidades\ServiceMe\TblGeneralEstados')->findOneBy(array('id' => 8)));
			
			$this->entidad->flush();
			
			return $objetivo->getEstado()->getNombre();
		}
		
		/**
		 * Gestion::ajaxNoAprobado()
		 * 
		 * @param mixed $array
		 * @param bool $usuario
		 * @return
		 */
		public function guardarAjaxNoAprobado($array = array(), $usuario = false) {
			$objetivo = $this->entidad->getRepository('Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos')->findOneBy(array('id' => $array['id']));
			$objetivo->setEstado($this->entidad->getRepository('Entidades\ServiceMe\TblGeneralEstados')->findOneBy(array('id' => 9)));
			
			$nota = new \Entidades\ServiceMe\TblMejoramientoSecMejorasNotas();
			$nota->setObjetivo($objetivo);
			$nota->setUsuario($this->entidad->getRepository('Entidades\ServiceMe\TblUsuarios')->findOneBy(array('usuario' => $usuario)));
			$nota->setNota($array['descripcion']);
			$nota->setFecha(new \DateTime());
			
			$this->entidad->persist($nota);
			$this->entidad->flush();
			
			$this->validacionEstadosMejora($array);
			
			return $objetivo->getEstado()->getNombre();
		}
		
		private function validacionEstadosMejora($array = array()) {
			
			$objetivos = $this->entidad->getRepository('Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos')->findBy(array('mejora' => $array['mejora']));
			//Consulta de no aprobados
			$aprobacion = $this->entidad->getRepository('Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos')->findBy(array('mejora' => $array['mejora'], 'estado' => 9));
			if(count($objetivos) == count($aprobacion)):
				
				$consulta = $this->entidad->getRepository('Entidades\ServiceMe\TblMejoramientoPriMejoras')->findOneBy(array('id' => $array['mejora']));
				$consulta->setEstado($this->entidad->getRepository('Entidades\ServiceMe\TblGeneralEstados')->findOneBy(array('id' => 9)));
				$this->entidad->flush();
				
			endif;
		}
	}