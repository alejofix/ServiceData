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
			$this->entidad = $conexion->doctrineORM();
			// $this->entidad = $conexion->doctrineORM();
			
		}
		
		/**
		 * Nuevo::Guardar()
		 * 
		 * Metodo necesario para el proceso del Modelo - Guardar el Proyecto
		 *  
		 * @return mixed
		 */
		
		public function Guardar($array = array(), $usuario = null) {
			
			$estado = $this->entidad->getRepository('\Entidades\ServiceMe\TblGeneralEstados')->findOneBy(array('id' => 5));
			$usuarioApertura = $this->entidad->getRepository('\Entidades\ServiceMe\TblUsuarios')->findOneBy(array('usuario' => $usuario));
			
			$proyecto = new \Entidades\ServiceMe\TblMejoramientoPriProyectos();
			$proyecto->setFecha(new \DateTime(date("Y-m-d H:i:s")));
			$proyecto->setEstado($estado);
			$proyecto->setUsuarioApertura($usuarioApertura);
			
			foreach ($array AS $columna => $valor):
				call_user_func_array(array($proyecto, $columna), array($valor));
			endforeach;
			
			$this->entidad->persist($proyecto);
			$this->entidad->flush();
			
			return $proyecto->getId();
		}
	}