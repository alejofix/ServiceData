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
	
	class Predeterminado extends Command {
		
		/**
		 * Predeterminado::configure()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de configuracion del proceso
		 * interno de consola
		 * 
		 * @return void
		 */
		protected function configure() {
			$this->setName('app:predeterminado');
			$this->setDescription('Asigna la aplicación que sera la predeterminada en la carga');
		}
		
		/**
		 * Predeterminado::execute()
		 * 
		 * ejecuta el proceso correspondiente de la
		 * consola
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		protected function execute(InputInterface $input, OutputInterface $output) {
			$app = (is_bool(ConfigAcceso::leer('Predeterminado', 'fuente', 'aplicacion')) == true) ? 'NO ASIGNADA' : ConfigAcceso::leer('Predeterminado', 'fuente', 'aplicacion');
			$output->writeln("\n\n\tSELECCION DE APLICACION PREDETERMINADA\n\n");
			$output->writeln("APLICACION: ".$app);
			
			$listaPreguntas = $this->listadoAplicaciones($input, $output);
			if(count($listaPreguntas) >= 1):
				$ayuda = $this->getHelper('question');
				$pregunta = new ChoiceQuestion("\n<question>Seleccione la aplicación predeterminada:</question>\n", $listaPreguntas);
				$pregunta->setErrorMessage('La opción seleccionada no es valida');
				$input->respuesta = $ayuda->ask($input, $output, $pregunta);
				$this->escrituraConfg($input, $output);
			else:
				$output->writeln("\n\n<error>No hay aplicaciones para configurar como Predeterminado</error>\n\n");
			endif;
		}
		
		/**
		 * Predeterminado::escrituraConfg()
		 * 
		 * Genera la validacion si el archivo de
		 * configuracion de accesos es posible
		 * escribirlo
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function escrituraConfg(InputInterface $input, OutputInterface $output) {
			$input->archivo = implode(DIRECTORY_SEPARATOR, array(ROOT_CONFIG, 'Acceso.json'));
			
			if(is_writable($input->archivo) == true):
				$this->procesar($input, $output);
			else:
				throw new \RuntimeException('El archivo de configuración de accesos no tiene permisos de escritura');
			endif;
		}
		
		/**
		 * Predeterminado::procesar()
		 * 
		 * Genera el proceso de actualizar los
		 * datos de la configuracion predeterminada
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function procesar(InputInterface $input, OutputInterface $output) {
			$confg = json_decode(file_get_contents($input->archivo), true);
			$confg['Predeterminado']['fuente']['aplicacion'] = $input->respuesta;
			$confg['Predeterminado']['fuente']['directorio'] = ConfigAcceso::leer($input->respuesta, 'fuente', 'directorio');
			
			$configuracion = json_encode($confg, CONSOLA_JSON);
			$fopen = fopen($input->archivo, 'w');
			fwrite($fopen, $configuracion);
			fclose($fopen);
			
			$output->writeln("\n\n<info>Se ha guardado la configuración correctamente</info>\n\n");
		}
		
		/**
		 * Predeterminado::listadoAplicaciones()
		 * 
		 * Genera el listado de aplicaciones para
		 * la pregunta correspondiente
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function listadoAplicaciones(InputInterface $input, OutputInterface $output) {
			$array = ConfigAcceso::leer();
			$contador = 1;
			foreach ($array AS $nombre => $param):
				if($nombre != 'Predeterminado'):
					$lista[$contador] = $nombre;
					$contador++;
				endif;
			endforeach;
			return (isset($lista) == true) ? $lista : array();
		}
	}