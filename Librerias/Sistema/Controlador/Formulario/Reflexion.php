<?php
	
	/**
	 * NeuralPHP Framework
	 * Marco de trabajo para aplicaciones web.
	 * 
	 * @author Zyos (Carlos Parra) <Neural.Framework@gmail.com>
	 * @copyright 2006-2015 NeuralPHP Framework
	 * @license GNU General Public License as published by the Free Software Foundation; either version 2 of the License.  
	 * @see http://neuralframework.com/
	 * @version 4.0
	 * 
	 * This program is free software; you can redistribute it and/or
	 * modify it under the terms of the GNU General Public License
	 * as published by the Free Software Foundation; either version 2
	 * of the License, or 1 any later version.
	 * 
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 */
	
	namespace Sistema\Controlador\Formulario;
	
	use \Doctrine\Common\Annotations\AnnotationReader;
	use \Neural\Excepcion;
	
	class Reflexion {
		
		private $lector = false;
		private $reflexion = false;
		
		/**
		 * Reflexion::__construct()
		 * 
		 * Genera las variables iniciales para el
		 * proceso de obtener las anotaciones y
		 * configuraciones del caso
		 * 
		 * @param string $namespace
		 * @return void
		 */
		function __construct($namespace = false) {
			if(is_string($namespace) == true):
				$this->appCarga();
				$this->lector = new AnnotationReader();
				$this->reflexion = new \ReflectionClass($namespace);
			else:
				throw new Excepcion('Debe ingresar el namespace del formulario para la validación', 0);
			endif;
		}
		
		/**
		 * Reflexion::appCarga()
		 * 
		 * Genera la ṕre-carga de los objetos
		 * para poder inicializarlos y tenerlos
		 * disponibles como contenedores
		 * 
		 * @return void
		 */
		private function appCarga() {
			$array = array('Configuracion', 'Formato', 'Formulario', 'IdForm', 'JQuery', 'Nombre', 'Proceso', 'Seguridad', 'TipoDato', 
				'Proceso'.DIRECTORY_SEPARATOR.'CampoIgual', 'Proceso'.DIRECTORY_SEPARATOR.'Correo', 'Proceso'.DIRECTORY_SEPARATOR.'Digitos', 
				'Proceso'.DIRECTORY_SEPARATOR.'Fecha', 'Proceso'.DIRECTORY_SEPARATOR.'FechaISO', 'Proceso'.DIRECTORY_SEPARATOR.'MaxCantidad', 
				'Proceso'.DIRECTORY_SEPARATOR.'MaxCaracteres', 'Proceso'.DIRECTORY_SEPARATOR.'MinCantidad', 'Proceso'.DIRECTORY_SEPARATOR.'MinCaracteres', 'Proceso'.DIRECTORY_SEPARATOR.'Numero', 'Proceso'.DIRECTORY_SEPARATOR.'RangoCantidad', 
				'Proceso'.DIRECTORY_SEPARATOR.'RangoCaracteres', 'Proceso'.DIRECTORY_SEPARATOR.'Requerido', 'Proceso'.DIRECTORY_SEPARATOR.'Url',
				'Proceso'.DIRECTORY_SEPARATOR.'Remoto', 'Proceso'.DIRECTORY_SEPARATOR.'ArchivoMimeType', 'Proceso'.DIRECTORY_SEPARATOR.'ArchivoExtension',
				'Html'.DIRECTORY_SEPARATOR.'Input', 'Html'.DIRECTORY_SEPARATOR.'Select', 'Html'.DIRECTORY_SEPARATOR.'Complemento', 'Html'.DIRECTORY_SEPARATOR.'Textarea' 
			);
			foreach ($array AS $clase):
				require_once implode(DIRECTORY_SEPARATOR, array(__DIR__, 'Reflexion', $clase.'.php'));
			endforeach;
		}
		
		/**
		 * Reflexion::claseComentarios()
		 * 
		 * Retorna las anotaciones y
		 * configuraciones correspondientes para el
		 * proceso de validacion
		 * 
		 * @return array object
		 */
		public function claseComentarios(){ 
			return (object) $this->camposOrganizar($this->lector->getClassAnnotations($this->reflexion));
		}
		
		/**
		 * Reflexion::camposComentarios()
		 * 
		 * Retorna las anotaciones y
		 * configuraciones correspondientes para el
		 * proceso de validacion
		 * 
		 * @return array object
		 */
		public function camposComentarios() {
			if(count($this->reflexion->getProperties()) >= 1):
				return $this->camposProcesar($this->reflexion->getProperties());
			else:
				return array();
			endif;
		}
		
		/**
		 * Reflexion::camposProcesar()
		 * 
		 * Procesa los campos correspondientes
		 * para obtener las anotaciones y
		 * configuraciones correspondientes
		 * 
		 * @param object $array
		 * @return object array
		 */
		private function camposProcesar($array = false) {
			foreach ($array AS $param):
				$lista[$param->name] = $this->camposOrganizar($this->lector->getPropertyAnnotations($this->reflexion->getProperty($param->name)));
			endforeach;
			unset($array, $param);
			return (object) $lista;
		}
		
		/**
		 * Reflexion::camposOrganizar()
		 * 
		 * Organiza los datos obtenidos para el
		 * proceso de identificacion
		 * 
		 * @param array $array
		 * @return object array
		 */
		private function camposOrganizar($array = false) {
			foreach ($array AS $param):
				$lista[lcfirst(get_class($param))] = $param;
			endforeach;
			unset($array, $param);
			return (object) $lista;
		}
	}