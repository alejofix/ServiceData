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
	
	class ListaDesarrollo extends Command {
		
		private $entorno = 'Desarrollo';
		
		/**
		 * Lista::configure()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de configuracion del proceso
		 * interno de consola
		 * 
		 * @return void
		 */
		protected function configure() {
			$this->setName('modulos:lista:desarrollo');
			$this->setDescription('Muestra el listado de modulos registrados en la aplicación');
			$this->addArgument('app', InputArgument::REQUIRED, 'Nombre de la aplicación');
		}
		
		/**
		 * Lista::execute()
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
				$this->mostrarListado($input, $output);
			else:
				throw new \RuntimeException('La aplicación no existe en el archivo de configuración');
			endif;
		}
		
		/**
		 * Lista::mostrarListado()
		 * 
		 * Muestra el listado correspondiente
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function mostrarListado(InputInterface $input, OutputInterface $output) {
			$listado = ConfigModulos::leer(ConfigAcceso::leer($input->getArgument('app'), 'fuente', 'directorio'), $this->entorno);
			
			$output->writeln("\n\tLISTADO DE MODULOS REGISTRADOS\n\n");
			$output->writeln(sprintf('APLICACION: %s', $input->getArgument('app')));
			$output->writeln(sprintf('ENTORNO: %s', $this->entorno));
			$output->writeln(sprintf('MODULOS HABILITADOS: %s', ($listado['configuracion']['habilitado'] == true) ? '<info>SI</info>' : '<error>NO</error>')."\n\n");
			
			$tabla = new Table($output);
			$tabla->setHeaders(array('Nombre', 'Estado', 'Mantenimiento'));
			$tabla->setRows($this->listado($input, $output));
			$tabla->render();
			
			$output->writeln("");
		}
		
		/**
		 * Lista::listado()
		 * 
		 * Genera la matriz de datos para generar
		 * el listado de la tabla correspondiente
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function listado(InputInterface $input, OutputInterface $output) {
			$listado = ConfigModulos::leer(ConfigAcceso::leer($input->getArgument('app'), 'fuente', 'directorio'), 'Desarrollo');
			
			foreach ($listado['modulos'] AS $nombre => $param):
				$lista[] = array(
					$nombre, 
					($param['habilitado'] == true) ? '<info>ACTIVO</info>' : '<error>INACTIVO</error>', 
					($param['mantenimiento'] == true) ? '<error>ACTIVO</error>' : '<info>INACTIVO</info>'
				);
			endforeach;
			return $lista;
		}
	}