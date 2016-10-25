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
	
	class ModeloModulo extends Command {
		
		private $parametro;
		private $controladorDirectorio;
		private $metodos;
		
		/**
		 * ControladorModulo::configure()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de configuracion del proceso
		 * interno de consola
		 * 
		 * @return void
		 */
		protected function configure() {
			$this->setName('fuente:modulo:modelo');
			$this->setDescription('Crear el Modelo solicitado en Modulo en entorno de Desarrollo');
			$this->addArgument('app', InputArgument::REQUIRED, 'Nombre de la aplicación');
			$this->addArgument('modulo', InputArgument::REQUIRED, 'Nombre del modulo');
			$this->addArgument('controlador', InputArgument::REQUIRED, 'Nombre del controlador que se asignara');
			$this->addArgument('metodos', InputArgument::OPTIONAL | InputArgument::IS_ARRAY, 'Metodos a crear');
		}
		
		/**
		 * ControladorModulo::execute()
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
		 * ControladorModulo::existenciaDirectorio()
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
				$this->existenciaModulo($input, $output);
			else:
				throw new \RuntimeException(sprintf('El directorio de la aplicación: [ %s ] no existe', $this->parametro['app']));
			endif;
		}
		
		/**
		 * ControladorModulo::existenciaModulo()
		 * 
		 * Genera la validacion de la exitencia del
		 * directorio del modulo indicado
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaModulo(InputInterface $input, OutputInterface $output) {
			if(is_dir(implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, ConfigAcceso::leer($this->parametro['app'], 'fuente', 'directorio'), 'Desarrollo', 'Fuente', 'Sistema', 'Modulos', $this->parametro['modulo']))) == true):
				$this->escrituraControlador($input, $output);
			else:
				throw new \RuntimeException(sprintf('El Modulo: [ %s ] de la aplicación: [ %s ] no existe', $this->parametro['modulo'], $this->parametro['app']));
			endif;
		}
		
		/**
		 * ControladorModulo::escrituraControlador()
		 * 
		 * Valida los permisos de lectura y
		 * escritura del directorio de
		 * modelos para poder realizar el
		 * proceso de creacion del modelo
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function escrituraControlador(InputInterface $input, OutputInterface $output) {
			$this->controladorDirectorio = implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, ConfigAcceso::leer($this->parametro['app'], 'fuente', 'directorio'), 'Desarrollo', 'Fuente', 'Sistema', 'Modulos', $this->parametro['modulo'], 'Modelos'));
			
			if(is_writable($this->controladorDirectorio) == true):
				$this->existenciaControlador($input, $output);
			else:
				throw new \RuntimeException(sprintf('El directorio de Modelos del modulo: [ %s ] de la aplicación: [ %s ] no tiene permisos de lectura y escritura', $this->parametro['modulo'], $this->parametro['app']));
			endif;
		}
		
		/**
		 * ControladorModulo::existenciaControlador()
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
				throw new \RuntimeException(sprintf('El archivo Modelo ya existe dentro del Modulo [%s]', $this->parametro['modulo']));
			endif;
		}
		
		/**
		 * ControladorModulo::crearArchivo()
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
		 * ControladorModulo::escribirArchivo()
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
			$modulo = trim($this->parametro['modulo']);
			
			
			if(count($this->parametro['metodos']) >= 1):
				$this->formatoMetodos($clase);
			endif;
			
			$formato = (is_array($this->metodos) == true) ? $this->clasePlantilla($modulo, $clase, implode("\n\n", $this->metodos)) : $this->clasePlantilla($modulo, $clase, '');
			
			$fopen = fopen($archivo, 'w');
			fwrite($fopen, $formato);
			fclose($fopen);
			
			$output->writeln("\n\n<info>Se ha creado el modelo solicitado en el Modulo</info>\n\n");
		}
		
		/**
		 * ControladorModulo::formatoMetodos()
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
		 * ControladorModulo::formatoAnotaciones()
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
		 * ControladorModulo::formatoParametros()
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
		 * ControladorModulo::metodoPlantilla()
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
		 * Metodo necesario para el proceso del Modelo
		 * {$anotacion} 
		 * @return mixed
		 */
		public function {$metodo}({$variable}) {
			
		}
EOT;
		}
		
		/**
		 * ControladorModulo::clasePlantilla()
		 * 
		 * Genera la plantilla de la clase para la
		 * creacion del archivo del controlador
		 * 
		 * @param string $clase
		 * @param string $metodos
		 * @return string
		 */
		private function clasePlantilla($modulo = false, $clase = false, $metodos = false) {
			return <<<EOT
<?php

	/**
	 * Namespace Modelo Modulo
	 * 
	 * Se genera el namespace para el MVC
	 * el cual se diferencia la carga de la misma
	 * @example namespace Modelo\MVC
	 */
	namespace Modelo\Modulo\\{$modulo};
	use \Neural\BD\Conexion;
	
	/**
	 * Modelo {{$clase}}
	 * 
	 * El Modelo debe ser generado en notacion UpperCamelCasse
	 * no debe contener simbolos como [\][_][-]
	 * 
	 * El nombre del archivo del Modelo y de la clase del modelo 
	 * debe ser igual a la clase controlador
	 */
	class {$clase} {
		
		/**
		 * Asigna el objeto de conexion para todo
		 * el modelo el cual se puede ejecutar SQL
		 * directamente
		 */
		private \$conexion = false;
		
		/**
		 * Asigan el objeto de conexion para poder
		 * utilizar las entidades generadas por
		 * Doctrine ORM
		 */
		private \$entidad = false;
		
		/**
		 * {$clase}::__construct()
		 * 
		 * Asigna las variables necesarias para el
		 * proceso del Modelo
		 *
		 * @return mixed
		 */
		public function __construct() {
			\$conexion = new Conexion('Nombre Conexion BD', 'Nombre de la Aplicacion');
			\$this->conexion = \$conexion->doctrineDBAL();
			\$this->entidad = \$conexion->doctrineORM();
		}
		
{$metodos}
	}
EOT;
		}
	}