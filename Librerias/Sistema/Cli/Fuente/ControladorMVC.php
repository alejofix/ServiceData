<?php
	
	/**
	 * NeuralPHP Framework
	 * Marco de trabajo para aplicaciones web.
	 * 
	 * @author Zyos (Carlos Parra) <Neural.Framework@gmail.com>
	 * @copyright 2006-2015 NeuralPHP Framework
	 * @license GNU General Public License as published by the Free
	 * Software Foundation; either version 2 of the License.  
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
	 
	namespace Cli\Fuente;
	
	use \Sistema\Utilidades\ConfigAcceso;
	use \Symfony\Component\Console\Command\Command;
	use \Symfony\Component\Console\Helper\Table;
	use \Symfony\Component\Console\Input\InputArgument;
	use \Symfony\Component\Console\Input\InputInterface;
	use \Symfony\Component\Console\Input\InputOption;
	use \Symfony\Component\Console\Output\OutputInterface;
	
	class ControladorMVC extends Command {
		
		private $parametro;
		private $controladorDirectorio;
		private $metodos;
		
		/**
		 * ControladorMVC::configure()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de configuracion del proceso
		 * interno de consola
		 * 
		 * @return void
		 */
		protected function configure() {
			$this->setName('fuente:mvc:controlador');
			$this->setDescription('Crear el controlador solicitado en el MVC en entorno de Desarrollo');
			$this->addArgument('app', InputArgument::REQUIRED, 'Nombre de la aplicación');
			$this->addArgument('controlador', InputArgument::REQUIRED, 'Nombre del controlador que se asignara');
			$this->addArgument('metodos', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, 'Metodos a crear');
			$this->addOption('constructor', 'c', InputOption::VALUE_NONE, 'Agrega el constructor de la clase');
		}
		
		/**
		 * ControladorMVC::execute()
		 * 
		 * ejecuta el proceso correspondiente de la
		 * consola
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		protected function execute(InputInterface $input, OutputInterface $output) {
			$this->parametro = $input->getArguments();
			
			if(ConfigAcceso::appExistencia($this->parametro['app']) == true):
				$this->existenciaDirectorio($input, $output);
			else:
				throw new \RuntimeException(sprintf('La aplicación: [ %s ] no existe en el archivo de configuración', $this->parametro['app']));
			endif;
		}
		
		/**
		 * Controlador::existenciaDirectorio()
		 * 
		 * Genera la validacion de la existencia
		 * del directorio de la aplicacion
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaDirectorio(InputInterface $input, OutputInterface $output) {
			if(is_dir(implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, ConfigAcceso::leer($this->parametro['app'], 'fuente', 'directorio')))) == true):
				$this->escrituraControlador($input, $output);
			else:
				throw new \RuntimeException(sprintf('El directorio de la aplicación: [ %s ] no existe', $this->parametro['app']));
			endif;
		}
		
		/**
		 * Controlador::escrituraControlador()
		 * 
		 * Valida los permisos de lectura y
		 * escritura del directorio de
		 * controladores para poder realizar el
		 * proceso de creacion del controlador
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function escrituraControlador(InputInterface $input, OutputInterface $output) {
			$this->controladorDirectorio = implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, ConfigAcceso::leer($this->parametro['app'], 'fuente', 'directorio'), 'Desarrollo', 'Fuente', 'Sistema', 'MVC', 'Controladores'));
			
			if(is_writable($this->controladorDirectorio) == true):
				$this->existenciaControlador($input, $output);
			else:
				throw new \RuntimeException(sprintf('El directorio de Controladores de la aplicación: [ %s ] no tiene permisos de lectura y escritura', $this->parametro['app']));
			endif;
		}
		
		/**
		 * Controlador::existenciaControlador()
		 * 
		 * Valida la existencia del controlador
		 * solicitado
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaControlador(InputInterface $input, OutputInterface $output) {
			$archivo = implode(DIRECTORY_SEPARATOR, array($this->controladorDirectorio, ucfirst($this->parametro['controlador']).'.php'));
			
			if(file_exists($archivo) == false):
				$this->crearArchivo($input, $output, $archivo);
			else:
				throw new \RuntimeException('El archivo controlador ya existe dentro del MVC');
			endif;
		}
		
		/**
		 * Controlador::crearArchivo()
		 *
		 * Genera el proceso correspondiente para
		 * la creacion del archivo
		 *  
		 * @param object $input
		 * @param object $output
		 * @param string $archivo
		 * @return raw
		 */
		private function crearArchivo(InputInterface $input, OutputInterface $output, $archivo) {
			if(touch($archivo) == true):
				$this->escribirArchivo($input, $output, $archivo);
			else:
				throw new \RuntimeException('Se ha presentado un error al crear el archivo, es posible que se presenten problemas de permisos para la creación');
			endif;
		}
		
		/**
		 * Controlador::escribirArchivo()
		 * 
		 * Genera el proceso de escribir las
		 * plantillas de la clase en el controlador
		 * correspondiente
		 * 
		 * @param object $input
		 * @param object $output
		 * @param string $archivo
		 * @return raw
		 */
		private function escribirArchivo(InputInterface $input, OutputInterface $output, $archivo) {
			$clase = ucfirst(trim($this->parametro['controlador']));
			
			if($input->getOption('constructor') == true):
				$this->metodos['__construct'] = $this->constructorPlantilla($clase);
			endif;
			
			$this->metodos['Index'] = $this->metodoPlantilla($clase, 'Index', '', '');
			
			if(count($this->parametro['metodos']) >= 1):
				$this->formatoMetodos($clase);
			endif;
			
			$formato = $this->clasePlantilla($clase, implode("\n\n", $this->metodos));
			
			$fopen = fopen($archivo, 'w');
			fwrite($fopen, $formato);
			fclose($fopen);
			
			$output->writeln("\n\n<info>Se ha creado el controlador solicitado en el MVC</info>\n\n");
		}
		
		/**
		 * Controlador::formatoMetodos()
		 * 
		 * Ejecuta el formato correspondiente para
		 * generar los metodos
		 * 
		 * @param string $clase
		 * @return void
		 */
		private function formatoMetodos($clase = false) {
			foreach ($this->parametro['metodos'] AS $param):
				$array = explode(':', $param);
				
				if(count($array) > 1):
					$lista = explode(',', $array[1]);
					$formato = $this->metodoPlantilla($clase, $array[0], $this->formatoParametros($lista), $this->formatoAnotaciones($lista));
				else:
					$formato = $this->metodoPlantilla($clase, $array[0], '', '');
				endif;
				
				$this->metodos[$array[0]] = $formato;
				
			endforeach;
		}
		
		/**
		 * Controlador::formatoAnotaciones()
		 * 
		 * Genera el formato de los parametros para
		 * las anotaciones
		 * 
		 * @param array $array
		 * @return array
		 */
		private function formatoAnotaciones($array = false) {
			foreach ($array AS $param):
				$lista[] = '@param mixed $'.trim($param);
			endforeach;
			return implode("\n\t\t * ", $lista);
		}
		
		/**
		 * Controlador::formatoParametros()
		 * 
		 * Genera el formato de los parametros que
		 * construira en el metodo
		 * 
		 * @param array $array
		 * @return string
		 */
		private function formatoParametros($array = false) {
			foreach ($array AS $param):
				$lista[] = '$'.trim($param).' = false';
			endforeach;
			return implode(', ', $lista);
		}
		
		/**
		 * Controlador::constructorPlantilla()
		 * 
		 * Genera la plantilla para asignar el
		 * constructor de la clase correspondiente
		 * 
		 * @param string $clase
		 * @return string
		 */
		private function constructorPlantilla($clase = false) {
			return <<<EOT
		/**
		 * {$clase}::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del controlador
		 *
		 * @return mixed
		 */
		public function __construct() {
			parent::__construct();
		}
EOT;
		}
		
		/**
		 * Controlador::metodoPlantilla()
		 * 
		 * Genera la plantilla del metodo para la
		 * creacion del archivo del controlador
		 * 
		 * @param string $clase
		 * @param string $metodo
		 * @param string $variable
		 * @param string $anotacion
		 * @return string
		 */
		private function metodoPlantilla($clase = false, $metodo = false, $variable = false, $anotacion = false) {
			return <<<EOT
		/**
		 * {$clase}::{$metodo}()
		 * 
		 * Metodo necesario para la carga del controlador
		 * el cual es necesario para la carga automatica
		 * del metodo inicial por defecto
		 *
		 * {$anotacion} 
		 * @return mixed
		 */
		public function {$metodo}({$variable}) {
			
		}
EOT;
		}
		
		/**
		 * Controlador::clasePlantilla()
		 * 
		 * Genera la plantilla de la clase para la
		 * creacion del archivo del controlador
		 * 
		 * @param string $clase
		 * @param string $metodos
		 * @return string
		 */
		private function clasePlantilla($clase = false, $metodos = false) {
			return <<<EOT
<?php

	/**
	 * Namespace Controlador MVC
	 * 
	 * Se genera el namespace para el MVC
	 * el cual se diferencia la carga de la misma
	 * @example namespace Controlador\MVC
	 */
	namespace Controlador\MVC;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	
	/**
	 * Controlador {{$clase}}
	 * 
	 * El controlador es requerido extenderlo hacia la
	 * clase u objeto ubicado en el namespace \Mvc\Controlador.
	 * 
	 * El controlador debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del controlador debe ser igual a la clase
	 * controlador
	 */
	class {$clase} extends Controlador {

{$metodos}
	}
EOT;
		}
	}