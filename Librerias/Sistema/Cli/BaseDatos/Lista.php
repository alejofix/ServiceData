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
	
	namespace Cli\BaseDatos;
	
	use \Sistema\Utilidades\ConfigBaseDatos;
	use \Symfony\Component\Console\Command\Command;
	use \Symfony\Component\Console\Helper\Table;
	use \Symfony\Component\Console\Input\InputArgument;
	use \Symfony\Component\Console\Input\InputInterface;
	use \Symfony\Component\Console\Input\InputOption;
	use \Symfony\Component\Console\Output\OutputInterface;
	
	class Lista extends Command {
		
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
			$this->setName('bd:lista');
			$this->setDescription('Muestra el listado de conexiones registradas');
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
			
			$output->writeln("\n\tLISTADO DE CONEXIONES REGISTRADAS\n\n");
			
			$tabla = new Table($output);
			$tabla->setHeaders(array('Nombre', 'Entorno', 'Servidor', 'Driver'));
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
			$listado = ConfigBaseDatos::leer();
			
			foreach ($listado AS $nombre => $param):
				$lista[] = array($nombre, 'Desarrollo', $param['Desarrollo']['host'], $param['Desarrollo']['driver']);
				$lista[] = array($nombre, 'Produccion', $param['Produccion']['host'], $param['Produccion']['driver']);
			endforeach;
			return $lista;
		}
	}