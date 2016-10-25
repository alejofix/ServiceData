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
	 
	namespace Cli\Modulos;
	
	use \Sistema\Utilidades\ConfigAcceso;
	use \Sistema\Utilidades\ConfigModulos;
	use \Symfony\Component\Console\Command\Command;
	use \Symfony\Component\Console\Helper\Table;
	use \Symfony\Component\Console\Input\InputArgument;
	use \Symfony\Component\Console\Input\InputInterface;
	use \Symfony\Component\Console\Input\InputOption;
	use \Symfony\Component\Console\Output\OutputInterface;
	
	class Nuevo extends Command {
		
		private $entorno = 'Desarrollo';
		private $directorios = array('Controladores', 'Modelos', 'Vistas');
		
		/**
		 * Nuevo::configure()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de configuracion del proceso
		 * interno de consola
		 * 
		 * @return void
		 */
		protected function configure() {
			$this->setName('modulos:nuevo:desarrollo');
			$this->setDescription('Agrega un nuevo modulo en la aplicación en entorno de Desarrollo');
			$this->addArgument('app', InputArgument::REQUIRED, 'Nombre de la aplicación');
			$this->addArgument('modulo', InputArgument::REQUIRED, 'Nombre del nuevo modulo');
			$this->addArgument('descripcion', InputArgument::REQUIRED, 'descripción del nuevo modulo');
		}
		
		/**
		 * Nuevo::execute()
		 * 
		 * ejecuta el proceso correspondiente de la
		 * consola
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		protected function execute(InputInterface $input, OutputInterface $output) {
			if(ConfigAcceso::appExistencia($input->getArgument('app')) == true):
				$this->existenciaDirectorioApp($input, $output);
			else:
				throw new \RuntimeException(sprintf('La aplicación: [ %s ] no existe en el archivo de configuración', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Nuevo::existenciaDirectorioApp()
		 * 
		 * Genera la validacion de la existencia
		 * del directorio de archivos de la
		 * aplicacion
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaDirectorioApp(InputInterface $input, OutputInterface $output) {
			$input->appDirectorio = implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, ConfigAcceso::leer($input->getArgument('app'), 'fuente', 'directorio')));
			
			if(is_dir($input->appDirectorio) == true):
				$this->existenciaDirectorioModulo($input, $output);
			else:
				throw new \RuntimeException(sprintf('El directorio de la aplicación: [ %s ] no existe', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Nuevo::existenciaDirectorioModulo()
		 * 
		 * Valida la existencia del directorio del
		 * modulo dentro de la aplicacion
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaDirectorioModulo(InputInterface $input, OutputInterface $output) {
			$input->directorioModulo = implode(DIRECTORY_SEPARATOR, array($input->appDirectorio, $this->entorno, 'Fuente', 'Sistema', 'Modulos', $input->getArgument('modulo')));
			
			if(is_dir($input->directorioModulo) == false):
				$this->escrituraModulos($input, $output);
			else:
				throw new \RuntimeException(sprintf('El directorio del modulo: [ %s ] de la aplicación: [ %s ] existe dentro del directorio de modulos', $input->getArgument('modulo'), $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Nuevo::escrituraModulos()
		 * 
		 * Determina si el directorio de modulos
		 * tiene los permisos de lectura y
		 * escritura para crear la estructura del
		 * modulo
		 * 
		 * @param mixed $input
		 * @param mixed $output
		 * @return void
		 */
		private function escrituraModulos(InputInterface $input, OutputInterface $output) {
			if(is_writable(dirname($input->directorioModulo)) == true):
				$this->escrituraConfiguracion($input, $output);
			else:
				throw new \RuntimeException(sprintf('El directorio de modulos de la aplicación: [ %s ] no tiene permisos de lectura y escritura', $input->getArgument('app')));
			endif;
		}
		
		/**
		 * Nuevo::escrituraConfiguracion()
		 * 
		 * Genera la validacion de la escritura del
		 * archivo de configuracion
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function escrituraConfiguracion(InputInterface $input, OutputInterface $output) {
			$input->confgRuta = implode(DIRECTORY_SEPARATOR, array(dirname(dirname(dirname($input->directorioModulo))), 'Configuracion', 'Modulos.json'));
			
			if(is_writable($input->confgRuta) == true):
				$this->existenciaModuloConfg($input, $output);
			else:
				throw new \RuntimeException('El archivo de configuración de modulos no tiene permisos de escritura para agregar el modulo');
			endif;
		}
		
		/**
		 * Nuevo::existenciaModuloConfg()
		 * 
		 * Determina si existe el modulo
		 * configurado en el archivo de
		 * configuracion de modulos
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaModuloConfg(InputInterface $input, OutputInterface $output) {
			$confg = json_decode(file_get_contents($input->confgRuta), true);
			
			if(array_key_exists($input->getArgument('modulo'), $confg['modulos']) == false):
				$this->crearDirectorioModulo($input, $output);
			else:
				throw new \RuntimeException('Ya se encuentra registrado en el archivo de configuración el modulo indicado');
			endif;
		}
		
		/**
		 * Nuevo::crearDirectorioModulo()
		 * 
		 * Genera el proceso de creacion del
		 * directorio base del modulo
		 * correspondiente
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function crearDirectorioModulo(InputInterface $input, OutputInterface $output) {
			if(mkdir($input->directorioModulo, 0777, true) == true):
				$this->crearEstructuraModulo($input, $output);
			else:
				throw new \RuntimeException('No es posible crear el directorio del modulo inciado');
			endif;
		}
		
		/**
		 * Nuevo::crearEstructuraModulo()
		 * 
		 * Genera el proceso de la creacion de la
		 * estructura interna del modulo
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function crearEstructuraModulo(InputInterface $input, OutputInterface $output) {
			foreach ($this->directorios AS $directorio):
				
				if(mkdir(implode(DIRECTORY_SEPARATOR, array($input->directorioModulo, $directorio)), 0777, true) == false):
					throw new \RuntimeException(sprintf('No es posible crear el directorio [ %s ] de la estructura del modulo', $directorio));
					break;
				endif;
				
			endforeach;
			
			$this->escribirConfiguracion($input, $output);
		}
		
		/**
		 * Nuevo::escribirConfiguracion()
		 * 
		 * Escribe la configuracion del nuevo
		 * modulo
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function escribirConfiguracion(InputInterface $input, OutputInterface $output) {
			$confg = json_decode(file_get_contents($input->confgRuta), true);
			$confg['modulos'] = array_merge(
				$confg['modulos'],
				array(
					$input->getArgument('modulo') => array(
						'habilitado' => true,
						'mantenimiento' => false,
						'descripcion' => $input->getArgument('descripcion')
					)
				)
			);
			ksort($confg['modulos']);
			
			$formato = json_encode($confg, CONSOLA_JSON);
			
			$fopen = fopen($input->confgRuta, 'w');
			fwrite($fopen, $formato);
			fclose($fopen);
			
			$output->writeln("\n\n<info>Se ha creado con exito el nuevo modulo</info>\n\n");
		}
	}