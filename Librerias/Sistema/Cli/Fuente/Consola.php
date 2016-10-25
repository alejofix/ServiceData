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
	
	class Consola extends Command {
		
		private $entorno = 'Desarrollo';
		
		/**
		 * Consola::configure()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de configuracion del proceso
		 * interno de consola
		 * 
		 * @return void
		 */
		protected function configure() {
			$this->setName('fuente:consola:desarrollo');
			$this->setDescription('Genera la clase para ejecutar por consola entorno de Desarrollo');
			$this->addArgument('app', InputArgument::REQUIRED, 'Aplicación donde se creara el objeto correspondiente');
			$this->addArgument('namespace', InputArgument::REQUIRED, 'Nombre de la clase Y/o estructura de la clase');
		}
		
		/**
		 * Consola::execute()
		 * 
		 * Ejecuta el proceso correspondiente para
		 * la creacion del controlador de consola
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		protected function execute(InputInterface $input, OutputInterface $output) {
			if(ConfigAcceso::appExistencia($input->getArgument('app')) == true):
				$this->escrituraConsola($input, $output);
			else:
				throw new \RuntimeException(sprintf('La aplicación: [ %s ] no existe en el archivo de configuracion', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Consola::escrituraConsola()
		 * 
		 * Genera la validacion de los permisos de
		 * escritura del directorio de consola
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function escrituraConsola(InputInterface $input, OutputInterface $output) {
			$input->consolaDir = implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, ConfigAcceso::leer($input->getArgument('app'), 'fuente', 'directorio'), $this->entorno, 'Fuente', 'Complementos', 'Consola'));
			if(is_writable($input->consolaDir) == true):
				$this->existenciaArchivo($input, $output);
			else:
				throw new \RuntimeException(sprintf('El directorio de consola no tiene permisos de escritura en la aplicación: [ %s ]', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Consola::existenciaArchivo()
		 * 
		 * Valida la existencia del archivo
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaArchivo(InputInterface $input, OutputInterface $output) {
			$input->namespace = explode(':', $input->getArgument('namespace'));
			$input->namespace = array_map(function($data) {
				return ucfirst($data);
			}, $input->namespace);
			
			$input->archivo = implode(DIRECTORY_SEPARATOR, array_merge(array($input->consolaDir), $input->namespace)).'.php';
			if(file_exists($input->archivo) == false):
				$this->seleccionNamespace($input, $output);
			else:
				throw new \RuntimeException(sprintf('El archivo de consola ya existe en la aplicación: [ %s ] en el entorno de desarrollo', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Consola::seleccionNamespace()
		 * 
		 * Genera el proceso de seleccion para
		 * determinar la creacion de la estructura
		 * o solo del archivo
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function seleccionNamespace(InputInterface $input, OutputInterface $output) {
			$input->namespace = explode(':', $input->getArgument('namespace'));
			$input->namespace = array_map(function($data) {
				return ucfirst($data);
			}, $input->namespace);
			
			if(count($input->namespace) > 1):
				$this->estructuraProcesar($input, $output);
			else:
				$input->claseNombre = $input->namespace[0];
				$input->namespace = 'Consola';
				$this->procesarArchivo($input, $output);
			endif;
		}
		
		/**
		 * Consola::estructuraProcesar()
		 * 
		 * Crea la estructura correspondiente para
		 * crear el archivo solicitado
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function estructuraProcesar(InputInterface $input, OutputInterface $output) {
			$input->claseNombre = array_pop($input->namespace);
			$ruta = implode(DIRECTORY_SEPARATOR, array_merge(array($input->consolaDir), $input->namespace));
			$input->namespace = implode('\\', array_merge(array('Consola'), $input->namespace));
			
			if(is_dir($ruta) == false):
				mkdir($ruta, 0777, true);
				$this->procesarArchivo($input, $output);
			else:
				$this->procesarArchivo($input, $output);
			endif;
		}
		
		/**
		 * Consola::procesarArchivo()
		 * 
		 * Genera el proceso de creacion del
		 * archivo
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function procesarArchivo(InputInterface $input, OutputInterface $output) {
			if(touch($input->archivo) == true):
				$this->procesarCrear($input, $output);
			else:
				throw new \RuntimeException('Se ha presentado un error en la creación del archivo, esto puede presentarse por error permisos de escritura');
			endif;
		}
		
		/**
		 * Consola::procesarCrear()
		 * 
		 * Genera el proceso de creacion del
		 * archivo
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function procesarCrear(InputInterface $input, OutputInterface $output) {
			$fopen = fopen($input->archivo, 'w');
			fwrite($fopen, $this->clasePlantilla($input->namespace, ucfirst($input->claseNombre)));
			fclose($fopen);
			
			$output->writeln("\n\n<info>Se ha creado el archivo de consola con exito</info>\n\n");
		}
		
		/**
		 * Consola::clasePlantilla()
		 * 
		 * Genera la plantilla de la clase
		 * correspondiente para el proceso de
		 * consola
		 * 
		 * @param string $namespace
		 * @param string $clase
		 * @return string
		 */
		private function clasePlantilla($namespace = false, $clase = false) {
			return <<<EOT
<?php
	
	/**
	 * Namespace Controlador Consola
	 * 
	 * Se genera el namespace para la Consola
	 * el cual se diferencia la carga de la misma
	 * @example namespace Consola\{directorio}\{clase}
	 */
	namespace {$namespace};
	
	use \Mvc\Consola;
	use \Mvc\InterfaceParametros;
	use \Mvc\InterfaceUtilidades;
	
	class {$clase} extends Consola {
		
		/**
		 * {$clase}::__construct()
		 * 
		 * Asigna las variables requeridas para el
		 * proceso de consola y la asignacion de
		 * los parametros requeridos para el
		 * proceso correspondiente
		 * 
		 * @return void
		 */
		function __construct() {
			
		}
		
		/**
		 * {$clase}::ejecutar()
		 * 
		 * Metodo protegido necesario y obligado
		 * para el proceso de consola y la
		 * ejecucion del proceso solicitado
		 * 
		 * @param object \$param
		 * @return raw
		 */
		protected function ejecutar(InterfaceParametros \$param, InterfaceUtilidades \$complemento) {
			
		}
	}
EOT;
		}
	}