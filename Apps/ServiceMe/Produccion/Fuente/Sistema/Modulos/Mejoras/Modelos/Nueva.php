<?php

	/**
	 * Namespace Modelo Modulo
	 * 
	 * Se genera el namespace para el MVC
	 * el cual se diferencia la carga de la misma
	 * @example namespace Modelo\MVC
	 */
	namespace Modelo\Modulo\Mejoras;
	use \Neural\Excepcion;
	use \Neural\BD\Conexion;
	use \Entidades\ServiceMe\TblUsuarios AS Usuarios;
	use \Entidades\ServiceMe\TblMejoramientoPriMejoras AS Mejoras;
	
	/**
	 * Modelo {Nueva}
	 * 
	 * El Modelo debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del Modelo y de la clase del modelo 
	 * debe ser igual a la clase controlador
	 */
	class Nueva {
		
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
		
		private $adjuntos;
		
		/**
		 * Nueva::__construct()
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
			$this->adjuntos = implode(DIRECTORY_SEPARATOR, array(dirname(dirname(dirname(dirname(__DIR__)))), 'Complementos', 'Adjuntos', 'Mejoras'));
		}
		
		/**
		 * Nueva::guardarMejora()
		 * 
		 * Se guarda mejora y objetivos
		 * @param array $array
		 * @param string $usuario
		 * @return integer
		 */
		public function guardarMejora($array = array(), $usuario, $archivos = array()) {
			
			if(is_dir($this->adjuntos) == false):
				throw new Excepcion('No existe el directorio de adjuntos de mejoras', 0, APP);
			endif;
			
			if(is_readable($this->adjuntos) == false):
				throw new Excepcion('No es posible leer el directorio de adjuntos de mejoras', 0, APP);
			endif;
			
			if(is_writable($this->adjuntos) == false):
				throw new Excepcion('No es posible escribir en el directorio de adjuntos de mejoras', 0, APP);
			endif;
			
			$user = $this->entidad->getRepository('\Entidades\ServiceMe\TblUsuarios')->findOneBy(array('usuario' => $usuario));
			$estado = $this->entidad->getRepository('\Entidades\ServiceMe\TblGeneralEstados')->findOneBy(array('id' => 1));
			$fecha = new \DateTime();
			
			$mejora = new \Entidades\ServiceMe\TblMejoramientoPriMejoras();
			$mejora->setHerramienta($array['setHerramienta']);
			$mejora->setProducto($this->entidad->getRepository('Entidades\ServiceMe\TblGeneralServicios')->findOneBy(array('id' => $array['setProducto'])));
			$mejora->setArbol($array['setArbol']);
			$mejora->setTitulo($array['setTitulo']);
			$mejora->setDescripcion($array['setDescripcion']);
			$mejora->setEstado($estado);
			$mejora->setUsuario($user);
			$mejora->setFecha($fecha);
			
			$this->entidad->persist($mejora);
			
			
			foreach ($array['setRuta'] AS $llave => $info):
				
				$proceso = (array) $array['setProceso'];
				
				$ruta = new \Entidades\ServiceMe\TblMejoramientoSecMejorasRutas();
				$ruta->setDescripcion($info);
				$ruta->setProceso($proceso[$llave]);
				$ruta->setMejora($mejora);
				
				$this->entidad->persist($ruta);
				
			endforeach;
			
			foreach ($array['setObjetivo'] AS $valor):
				
				$objetivo = new \Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos();
				$objetivo->setMejora($mejora);
				$objetivo->setFechaObjetivo($fecha);
				$objetivo->setObjetivo($valor);
				$objetivo->setEstado($estado);
				
				$this->entidad->persist($objetivo);
				
			endforeach;
			
			$this->entidad->flush();
			
			if(is_array($archivos) == true):
				$this->procesarArchivos($archivos, $mejora, $estado);
			endif;
			
			return $mejora->getId();
		}
		
		public function listarServicios(){
			return $this->entidad
				->getRepository('\Entidades\ServiceMe\TblGeneralServicios')
				->findBy(array(), array('producto' => 'ASC'));
			
		}
		
		public function listarUsuariosEscalados(){
			return $this->entidad
				->getRepository('\Entidades\ServiceMe\TblUsuarios')
				->findBy(array('cargo' => 1), array('nombreInicial' => 'ASC'));
			
		}
		
		/**
		 * Nueva::procesarArchivos()
		 * 
		 * Guarda los archivos correpsondientes
		 * @param mixed $archivos
		 * @param mixed $mejora
		 * @param mixed $estado
		 * @return void
		 */
		private function procesarArchivos($archivos = array(), $mejora, $estado) {
			 
			 if(count($archivos['archivos']['name'])>= 1):
			 	
			 	foreach ($archivos['archivos']['name'] AS $index => $valor):
			 		$nombre = sprintf('%s.%s', sha1(strtotime(date("Y-m-d H:i:s")).$valor), pathinfo($valor, PATHINFO_EXTENSION));
			 		$adjunto = new \Entidades\ServiceMe\TblMejoramientoSecMejorasAdjuntos();
			 		$adjunto->setArchivo($nombre);
			 		$adjunto->setDocumento($valor);
			 		$adjunto->setFecha(new \DateTime());
			 		$adjunto->setMejora($mejora);
			 		$adjunto->setEstado($estado);
			 		
			 		$this->entidad->persist($adjunto);
			 		$this->entidad->flush();
			 		
			 		move_uploaded_file($archivos['archivos']['tmp_name'][$index], implode(DIRECTORY_SEPARATOR, array($this->adjuntos, $nombre)));
			 	endforeach;
			 	
			 endif;
		}
		
	}