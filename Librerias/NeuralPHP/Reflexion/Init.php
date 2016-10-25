<?php
	
	namespace NeuralPHP\Reflexion;
	use \Doctrine\Common\Annotations\AnnotationReader;
	
	class Init {
		
		/**
		 * Init::lector
		 * 
		 * Variable que contiene el objeto de
		 * AnnotationReader de doctrine para la
		 * lectura de las anotaciones
		 * correspondientes al archivo de
		 * configuracion de la validacion de
		 * formularios
		 * 
		 * @return object
		 */
		private $lector;
		
		/**
		 * Init::reflexion
		 * 
		 * Variable que contiene el objeto de
		 * ReflectionClass de PHP para la lectura
		 * de las anotaciones nativo
		 * correspondientes al archivo de
		 * configuracion de la validacion de
		 * formularios
		 * 
		 * @return object
		 */
		private $reflexion;
		
		/**
		 * Init::__construct()
		 *
		 * Asigna los objetos de procesamiento de
		 * comentarios a los objetos contenedores
		 * correspondientes generando la
		 * disponibilidad total para toda la clase 
		 * 
		 * @param string $namespace 
		 * @return void
		 */
		function __construct($namespace = false) {
			if(is_string($namespace) == true):
				$this->constructExistencia($namespace);
			else:
				throw new Excepcion('El namespace para realizar el proceso de reflexión debe ser ingresado como texto');
			endif;
		}
		
		/**
		 * Init::constructExistencia()
		 * 
		 * Genera la validacion de la existencia
		 * del namespace indicado 
		 * 
		 * @param string $namespace 
		 * @return void
		 */
		private function constructExistencia($namespace = null) {
			if(class_exists($namespace) == true):
				$this->lector = new AnnotationReader();
				$this->reflexion = new \ReflectionClass($namespace);
			else:
				throw new Excepcion(sprintf('El namespace: {%s} no existe o no fue cargada', $namespace));
			endif;
		}
		
		/**
		 * Init::registrarAnotaciones()
		 *
		 * genera el proceso de registrar las clases de las anotaciones correspondientes
		 * para generar el parser correspondiente y retornarlas como objetos
		 *  
		 * @param string $directorio
		 * @return void
		 */
		public function registrarAnotaciones($directorio = null) {
			if(is_dir($directorio) == true):
				$array = \glob(implode(DIRECTORY_SEPARATOR, array($directorio, '*.php')));
				foreach ($array AS $archivo):
					require_once $archivo;
				endforeach;
			else:
				throw new Excepcion('No existe el directorio para registrar las anotaciones');
			endif;
		}
		
		/**
		 * Init::clase()
		 *
		 * Retorna el array de comentarios junto
		 * con sus valores correspondiente de la
		 * clase indicada 
		 * 
		 * @return array
		 */
		public function clase() {
			return $this->formatoAnotacion($this->lector->getClassAnnotations($this->reflexion));
		}
		
		/**
		 * Init::metodos()
		 * 
		 * Retorna el array de comentarios junto
		 * con sus valores correspondiente de la
		 * clase indicada 
		 * 
		 * @return array
		 */
		public function metodos() {
			if(count($this->reflexion->getMethods()) >= 1):
				return $this->metodosFormato($this->reflexion->getMethods());
			endif;
			return array();
		}
		
		/**
		 * Init::metodosFormato()
		 * 
		 * Genera el proceso de organizar los
		 * metodos variables de la clase en un
		 * array para su mejor comprension 
		 * 
		 * @param array $array 
		 * @return array
		 */
		private function metodosFormato(array $array) {
			foreach ($array AS $parametro):
				$lista[$parametro->name] = $this->formatoAnotacion($this->lector->getMethodAnnotations($this->reflexion->getMethod($parametro->name)));
			endforeach;
			return (isset($lista) == true) ? $lista : array();
		}
		
		/**
		 * Init::propiedades()
		 * 
		 * Retorna el array de datos con el listado
		 * de propiedades dentro de la clase
		 * indicada 
		 * 
		 * @return array
		 */
		public function propiedades() {
			if(count($this->reflexion->getProperties()) >= 1):
				return $this->propiedadesFormato($this->reflexion->getProperties());
			endif;
			return array();
		}
		
		/**
		 * Init::propiedadesFormato()
		 * 
		 * Genera el proceso de organizar las
		 * propiedades variables de la clase en un
		 * array para su mejor comprension 
		 * 
		 * @param array $array 
		 * @return array
		 */
		private function propiedadesFormato(array $array) {
			foreach ($array AS $parametro):
				$lista[$parametro->name] = $this->formatoAnotacion($this->lector->getPropertyAnnotations($this->reflexion->getProperty($parametro->name)));
			endforeach;
			return (isset($lista) == true) ? $lista : array();
		}
		
		/**
		 * Init::formatoAnotacion()
		 *
		 * Retorna el objeto correspondiente
		 * organizado para su facil comprension 
		 * 
		 * @param object $objeto 
		 * @return array
		 */
		private function formatoAnotacion($array = null) {
			if(count($array) >= 1):
				foreach ($array AS $clase):
					$lista[lcfirst(get_class($clase))] = (array) $clase;
				endforeach;
			endif;
			return (isset($lista) == true) ? $lista : array();
		}
	}