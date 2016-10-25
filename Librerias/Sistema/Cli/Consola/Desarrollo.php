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
	
	namespace Cli\Consola;
	
	use \Doctrine\ORM\Proxy\Autoloader;
	use \Sistema\Consola\Parametros;
	use \Sistema\Consola\Utilidades;
	use \Sistema\Utilidades\ConfigAcceso;
	use \Symfony\Component\Console\Command\Command;
	use \Symfony\Component\Console\Input\InputArgument;
	use \Symfony\Component\Console\Input\InputInterface;
	use \Symfony\Component\Console\Input\InputOption;
	use \Symfony\Component\Console\Output\OutputInterface;
	
	class Desarrollo extends Command {
		
		private $entorno = 'Desarrollo';
		
		/**
		 * Desarrollo::configure()
		 * 
		 * Genera los parametros basicos de configuracion
		 * @return void
		 */
		protected function configure() {
			$this->setName('app:desarrollo');
			$this->setDescription('Ejecuta el archivo de consola en entorno de Desarrollo');
			$this->addArgument('app', InputArgument::REQUIRED, 'Aplicacion a ejecutar');
			$this->addArgument('claseConsola', InputArgument::REQUIRED, 'Clase a ejecutar');
			$this->addArgument('parametros', InputArgument::IS_ARRAY, 'Lista de parametros separados por espacio');
		}
		
		/**
		 * Desarrollo::execute()
		 * 
		 * Genera el proceso de ejecucion del script
		 * indicado
		 * 
		 * @param mixed $input
		 * @param mixed $output
		 * @return raw
		 */
		protected function execute(InputInterface $input, OutputInterface $output) {
			if(ConfigAcceso::appExistencia($input->getArgument('app')) == true):
				$this->lecturaDirectorio($input, $output);
			else:
				throw new \RuntimeException(sprintf('La aplicación: [ %s ] no existe en el archivo de configuración', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Desarrollo::existenciaControlador()
		 * 
		 * Genera la validacion de la lectura
		 * del directorio de consola para el
		 * proceso
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function lecturaDirectorio(InputInterface $input, OutputInterface $output) {
			$input->namespace = implode('\\', array_merge(array('Consola'), explode(':', $input->getArgument('claseConsola'))));
			$input->appDir = implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, ConfigAcceso::leer($input->getArgument('app'), 'fuente', 'directorio'), $this->entorno, 'Fuente'));
			$input->consolaDir = implode(DIRECTORY_SEPARATOR, array($input->appDir, 'Complementos', 'Consola'));
			$input->archivo = implode(DIRECTORY_SEPARATOR, array_merge(array($input->consolaDir), explode(':', $input->getArgument('claseConsola')))).'.php';
			
			if(is_readable($input->consolaDir) == true):
				$this->existenciaControlador($input, $output);
			else:
				throw new \RuntimeException(sprintf('El directorio de consola de la aplicación: [ %s ] no tiene permisos de lectura para ejecutar el proceso', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Desarrollo::existenciaControlador()
		 * 
		 * Genera la validacion de la existencia
		 * del controlador de consola para iniciar
		 * el proceso correspondiente
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaControlador(InputInterface $input, OutputInterface $output) {
			if(file_exists($input->archivo) == true):
				$this->lecturaControlador($input, $output);
			else:
				throw new \RuntimeException(sprintf('El archivo del proceso de consola no existe dentro de la aplicación: [ %s ]', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Desarrollo::lecturaControlador()
		 * 
		 * Genera la validacion si el controlador
		 * tiene permisos de lectura
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function lecturaControlador(InputInterface $input, OutputInterface $output) {
			if(is_readable($input->archivo) == true):
				$this->opcionesConsola($input, $output);
			else:
				throw new \RuntimeException(sprintf('El archivo de consola no tiene permisos de lectura de la aplicación: [ %s ]', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Desarrollo::opcionesConsola()
		 * 
		 * Genera la carga de archivos
		 * correspondientes para el proceso de
		 * consola
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function opcionesConsola(InputInterface $input, OutputInterface $output) {
			
			define('ENV_ENTORNO', $this->entorno);
			define('ENV_TIPO', 'MVC');
			date_default_timezone_set(ConfigAcceso::leer($input->getArgument('app'), 'sistema', 'tiempo', 'zona'));
			require implode(DIRECTORY_SEPARATOR, array($input->appDir, 'Configuracion', 'Parametros.php'));
			
			$consola = new \AutoCargador('Consola', implode(DIRECTORY_SEPARATOR, array($input->appDir, 'Complementos')));
			$entidades = new \AutoCargador('Entidades', implode(DIRECTORY_SEPARATOR, array($input->appDir, 'Complementos', 'ORM')));
		 	$formulario = new \AutoCargador('Formularios', implode(DIRECTORY_SEPARATOR, array($input->appDir, 'Complementos')));
		 	$interface = new \AutoCargador('Interfaces', implode(DIRECTORY_SEPARATOR, array($input->appDir, 'Complementos')));
		 	$utilidades = new \AutoCargador('Utilidades', implode(DIRECTORY_SEPARATOR, array($input->appDir, 'Complementos')));
		 	$modeloMVC = new \AutoCargador('Modelo', implode(DIRECTORY_SEPARATOR, array($input->appDir, 'Sistema')));
		 	Autoloader::register(implode(DIRECTORY_SEPARATOR, array($input->appDir, 'Complementos', 'ORM', 'Proxy')), 'Proxy');
		 	
		 	$consola->registrar();
		 	$entidades->registrar();
		 	$formulario->registrar();
		 	$interface->registrar();
		 	$utilidades->registrar();
		 	$modeloMVC->registrarModelo();
		 	
		 	$this->existenciaClaseControlador($input, $output);
		}
		
		/**
		 * Desarrollo::existenciaClaseControlador()
		 * 
		 * Valida la existencia de la clase
		 * correspondiente
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaClaseControlador(InputInterface $input, OutputInterface $output) {
			if(class_exists($input->namespace) == true):
				$this->existenciaClaseMetodo($input, $output);
			else:
				throw new \RuntimeException(sprintf('El clase de consola no existen dentro de la aplicación: [ %s ]', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Desarrollo::existenciaClaseMetodo()
		 * 
		 * Determina si existe el metodo que
		 * inicializa la ejecucion del proceso
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaClaseMetodo(InputInterface $input, OutputInterface $output) {
			if(method_exists($input->namespace, 'ejecutar') == true):
				$this->procesoEjecucion($input, $output);
			else:
				throw new \RuntimeException(sprintf('El metodo de ejecución del controlador de consola no existe en la aplicación: [ %s ]', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Desarrollo::procesoEjecucion()
		 * 
		 * Ejecuta el proceso del controlador de
		 * consola
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function procesoEjecucion(InputInterface $input, OutputInterface $output) {
			$consola = new $input->namespace;
			$clase = new \ReflectionClass($consola);
			$objEntrada = new Parametros();
			$complementos = new Utilidades();
			
			$propiedad = $clase->getParentClass()->getProperty('parametros');
			$propiedad->setAccessible(true);
			$parametros = $propiedad->getValue($consola);
			
			if(count($parametros) >= 1):
				$reflectionClass = new \ReflectionClass($objEntrada);
				$reflectionProperty = $reflectionClass->getProperty('parametros');
				$reflectionProperty->setAccessible(true);
				$reflectionProperty->setValue($objEntrada, $this->formatoParametros($parametros, $input->getArgument('parametros')));
			endif;
			
			$metodo = new \ReflectionMethod($input->namespace, 'ejecutar');
			$metodo->setAccessible(true);
			$metodo->invokeArgs($consola, array($objEntrada, $complementos));
		}
		
		/**
		 * Desarrollo::formatoParametros()
		 * 
		 * Toma el valor correspondiente y asigna
		 * el nombre asociado al valor ingresado
		 * 
		 * @param array $objeto
		 * @param array $entrada
		 * @return
		 */
		private function formatoParametros($objeto = array(), $entrada = array()) {
			foreach ($objeto AS $indicador => $param):
				if(array_key_exists($indicador, $entrada) == true):
					$lista[$param['parametro']] = $this->formatoValor(mb_strtolower($param['tipo']), $entrada[$indicador]);
				endif;
			endforeach;
			return (isset($lista) == true) ? $lista : array();
		}
		
		/**
		 * Desarrollo::formatoValor()
		 * 
		 * Asigna el tipo de valor a la informacion
		 * ingresada
		 * 
		 * @param string $tipo
		 * @param string $valor
		 * @return mixed
		 */
		private function formatoValor($tipo = false, $valor = false) {
			$valido = array('integer' => 0, 'float' => 1, 'string' => 2, 'boolean' => 3);
			if(array_key_exists($tipo, $valido) == true):
				settype($valor, $tipo);
			endif;
			return $valor;
		}
	}