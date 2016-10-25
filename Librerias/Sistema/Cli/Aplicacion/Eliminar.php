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
	
	namespace Cli\Aplicacion;
	
	use \Sistema\Utilidades\ConfigAcceso;
	use \Symfony\Component\Console\Command\Command;
	use \Symfony\Component\Console\Helper\Table;
	use \Symfony\Component\Console\Input\InputArgument;
	use \Symfony\Component\Console\Input\InputInterface;
	use \Symfony\Component\Console\Input\InputOption;
	use \Symfony\Component\Console\Output\OutputInterface;
	use \Symfony\Component\Console\Question\ChoiceQuestion;
	
	class Eliminar extends Command {
		
		private $comandos = array();
		private $aplicacion = false;
		
		/**
		 * Eliminar::configure()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de configuracion del proceso
		 * interno de consola
		 * 
		 * @return void
		 */
		protected function configure() {
			$this->setName('app:eliminar');
			$this->setDescription('Muestra el listado de aplicaciones que pueden ser eliminadas (Interactivo)');
		}
		
		/**
		 * Eliminar::execute()
		 * 
		 * ejecuta el proceso correspondiente de la
		 * consola
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		protected function execute(InputInterface $input, OutputInterface $output) {
			
			$output->writeln("\n\n\tEliminar Aplicación\n\n");
			$output->writeln('En este aparatado podra eliminar las aplicaciones que se encuentran registradas.');
			$output->writeln('La aplicación [Predeterminado] no sera posible eliminarla');
			$output->writeln('El directorio y los archivos fuentes y publicos no seran eliminados.');
			$output->writeln("");
			
			$tabla = new Table($output);
			$tabla->setHeaders(array('Seleccion', 'Nombre', 'Directorio', 'Creación'));
			$tabla->setRows($this->listado($input, $output));
			$output->writeln($tabla->render());

			
			$output->writeln("\n");
			
			if(count($this->comandos) >= 1):
				$ayuda = $this->getHelper('question');
				$pregunta = new ChoiceQuestion("<question>Seleccione la aplicación a eliminar:</question> \n", $this->comandos);
				$pregunta->setErrorMessage('Ha seleccionado una opción no valida');
				$this->aplicacion = $ayuda->ask($input, $output, $pregunta);
				$this->confirmarEliminacion($input, $output);
			endif;
		}
		
		/**
		 * Eliminar::confirmarEliminacion()
		 * 
		 * Genera la pregunta de confirmacion para
		 * eliminar la aplicacion seleccionada
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function confirmarEliminacion(InputInterface $input, OutputInterface $output) {
			$ayuda = $this->getHelper('question');
			$pregunta = new ChoiceQuestion("\n<question>Esta seguro de elimunar la aplicación [ $this->aplicacion ]:</question> \n", array('1' => 'Si', '2' => 'No'));
			$pregunta->setErrorMessage('Ha seleccionado una opción no valida');
			$confirmacion = $ayuda->ask($input, $output, $pregunta);
			
			if($confirmacion == 'Si'):
				$this->eliminarProceso($input, $output);
			endif;
		}
		
		/**
		 * Eliminar::eliminarProceso()
		 * 
		 * Determina si el archivo de configuracion
		 * de accesos tiene los permisos necesarios
		 * para el proceso de eliminar la
		 * aplicacion indicada
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function eliminarProceso(InputInterface $input, OutputInterface $output) {
			$archivo = implode(DIRECTORY_SEPARATOR, array(ROOT_CONFIG, 'Acceso.json'));
			
			if(is_writable($archivo) == true):
				$this->eliminarExistencia($input, $output, $archivo);
			else:
				throw new \RuntimeException('El archivo de configuración no tiene permisos de lectura - escritura');
			endif;
		}
		
		/**
		 * Eliminar::eliminarExistencia()
		 * 
		 * Metodo en el cual se realiza el proceso
		 * de eliminar la aplicacion indicada
		 * 
		 * @param object $input
		 * @param object $output
		 * @param string $archivo
		 * @return raw
		 */
		private function eliminarExistencia(InputInterface $input, OutputInterface $output, $archivo) {
			
			if(ConfigAcceso::appExistencia($this->aplicacion) == true):
				$confg = json_decode(file_get_contents($archivo), true);
				unset($confg[$this->aplicacion]);
				$confg = json_encode($confg, CONSOLA_JSON);
				
				$fopen = fopen($archivo, 'w');
				fwrite($fopen, $confg);
				fclose($fopen);
				
				$output->writeln(sprintf("\n\nLa aplicación: %s fue eliminada con exito\n\n", $this->aplicacion));
				
			else:
				throw new \RuntimeException(sprintf('La aplicación: % no existe en el archivo de configuración', $this->aplicacion));
			endif;
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
			$listado = ConfigAcceso::leer();
			$contador = 1;
			foreach ($listado AS $nombre => $param):
				$lista[] = array(
					$contador, 
					$nombre, 
					(is_dir(implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, $param['fuente']['directorio']))) == true) ? '<info>EXISTE</info>' : '<error>NO EXISTE</error>',
					$param['informacion']['creacion']
				);
				
				if($nombre != 'Predeterminado'):
					$this->comandos[$contador] = $nombre;
				endif;
				
				$contador++;
			endforeach;
			return $lista;
		}
	}