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
	
	namespace Cli\Formulario;
	
	use \Sistema\Utilidades\ConfigAcceso;
	use \Symfony\Component\Console\Command\Command;
	use \Symfony\Component\Console\Helper\Table;
	use \Symfony\Component\Console\Input\InputArgument;
	use \Symfony\Component\Console\Input\InputInterface;
	use \Symfony\Component\Console\Input\InputOption;
	use \Symfony\Component\Console\Output\OutputInterface;
	
	class Desarrollo extends Command {
		
		private $namespace;
		private $metodoPeticion;
		private $param;
		private $complementos;
		private $campos;
		private $token;
		private $nombreClase;
		private $validaciones = array(
			'requerido' => 'Requerido(mensaje="El campo es requerido")', 
			'mincaracteres' => 'MinCaracteres(cantidad=1, mensaje="La cantidad minima de caracteres es 1")', 
			'maxcaracteres' => 'MaxCaracteres(cantidad=255, mensaje="la cantidad maxima de caracteres es 255")',
			'rangocaracteres' => 'RangoCaracteres(inicio=1, fin=255, mensaje="El rango de caracteres es de 1 a 255")', 
			'mincantidad' => 'MinCantidad(cantidad=1, mensaje="Cantidad numerica minima es 1")', 
			'maxcantidad' => 'MaxCantidad(cantidad=255, mensaje="La cantidad maxima es de 255")', 
			'rangocantidad' => 'RangoCantidad(inicio=1, fin=255, mensaje="El rango es de 1 a 255")', 
			'correo' => 'Correo(mensaje="El formato de correo no es valido")', 
			'url' => 'Url(mensaje="El formato de URL no es valido")', 
			'fecha' => 'Fecha(mensaje="El formato de fecha no es valido")', 
			'fechaiso' => 'FechaISO(mensaje="El formato de fecha no es valido")', 
			'numero' => 'Numero(mensaje="El campo no es numerico")', 
			'digitos' => 'Digitos(mensaje="El campo no es numerico")', 
			'campoigual' => 'CampoIgual(idCampo="password", mensaje="Los campos no son iguales")', 
			'remoto' => 'Remoto(url="url para la peticion", metodo="POST", mensaje="No es valido el dato")', 
			'archivoextension' => 'ArchivoExtension(tipo={"jpg", "png"})', 
			'archivomimetype' => 'ArchivoMimeType(tipo={"image/jpeg", "application/vnd.ms-excel"})'
		);
		
		/**
		 * Desarrollo::configure()
		 * 
		 * Genera las variables necesarias para el
		 * proceso de configuracion del proceso
		 * interno de consola
		 * 
		 * @return void
		 */
		protected function configure() {
			$this->setName('formulario:desarrollo');
			$this->setDescription('Genera el archivo de configuración para la validación de formularios');
			$this->addArgument('app', InputArgument::REQUIRED, 'Nombre de la aplicación asignada al formulario');
			$this->addArgument('metodo', InputArgument::REQUIRED, 'Petición de envio del formulario [GET - POST]');
			$this->addArgument('namespace', InputArgument::REQUIRED, 'Nombre de la clase que se asigna al formulario');
			$this->addArgument('campos', InputArgument::REQUIRED | InputArgument::IS_ARRAY, 'Configuración campo del formulario');
		}
		
		/**
		 * Desarrollo::execute()
		 * 
		 * ejecuta el proceso correspondiente de la
		 * consola
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		protected function execute(InputInterface $input, OutputInterface $output) {
			$this->param = (object) $input->getArguments();
			
			if(ConfigAcceso::appExistencia($this->param->app) == true):
				$this->seleccionPeticion($input, $output);
			else:
				throw new \RuntimeException(sprintf('La aplicación: [ %s ] no existe en el archivo de configuración', $this->param->app));
			endif;
		}
		
		/**
		 * Desarrollo::seleccionPeticion()
		 * 
		 * Valida el metodo ingresado ya que solo
		 * es permitido peticiones POST y GET
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function seleccionPeticion(InputInterface $input, OutputInterface $output) {
			if(array_key_exists(mb_strtolower($this->param->metodo), array_flip(array('post', 'get'))) == true):
				$this->metodoPeticion = mb_strtolower($this->param->metodo);
				$this->existenciaNamespace($input, $output);
			else:
				throw new \RuntimeException(sprintf('El metodo: [ %s ] no es valido, solo es permitido [ POST - GET ]', $this->param->metodo));
			endif;
		}
		
		/**
		 * Desarrollo::existenciaNamespace()
		 * 
		 * Se valida la existencia del archivo que
		 * se generara y determinar si es posible
		 * crearlo o no
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaNamespace(InputInterface $input, OutputInterface $output) {
			$this->complementos = implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, ConfigAcceso::leer($this->param->app, 'fuente', 'directorio'), 'Desarrollo', 'Fuente', 'Complementos', 'Formularios'));
			$namespace = explode(':', $this->param->namespace);
			$archivo = $this->complementos.DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR, $namespace).'.php';
			
			if(file_exists($archivo) == false):
				$this->formatoCampos($input, $output);
			else:
				throw new \RuntimeException(sprintf('El archivo: [ %s ] ya existe dentro del directorio de formularios', implode(DIRECTORY_SEPARATOR, $namespace)));
			endif;
		}
		
		/**
		 * Desarrollo::formatoCampos()
		 *
		 * Genera el formato correspondiente para
		 * la construccion de la clase para la
		 * validacion del formulario
		 *  
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function formatoCampos(InputInterface $input, OutputInterface $output) {
			$lista = array();
			$contador = 0;
			foreach ($this->param->campos AS $param):
				list($campo, $columna, $validacion) = explode(':', $param);
				$lista[$contador]['campo'] = $campo;
				$lista[$contador]['columna'] = $columna;
				$lista[$contador]['validacion'] = $this->formatoValidacion($campo, $validacion);
				$contador++;
			endforeach;
			$this->campos = $lista;
			$this->escrituraFormularios($input, $output);
		}
		
		/**
		 * Desarrollo::escrituraFormularios()
		 * 
		 * Genera la validacion de los permisos de
		 * escritura del directorio de las
		 * validaciones de formularios
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function escrituraFormularios(InputInterface $input, OutputInterface $output) {
			if(is_writable($this->complementos) == true):
				$this->crearProceso($input, $output);
			else:
				throw new \RuntimeException('El directorio de formularios no tiene los permisos para lectura y escritura para la creación de la validación');
			endif;
		}
		
		/**
		 * Desarrollo::crearProceso()
		 * 
		 * Genera el proceso de la creacion y
		 * construccion de la clase de validacion
		 * de formularios
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function crearProceso(InputInterface $input, OutputInterface $output) {
			$namespace = explode(':', $this->param->namespace);
			$this->token = sha1($this->namespace);
			
			if(count($namespace) >= 2):
				
				$archivo = implode(DIRECTORY_SEPARATOR, array_merge(array($this->complementos), $namespace)).'.php';
				$this->nombreClase = array_pop($namespace);
				$this->namespace = implode('\\', array_merge(array('Formularios'), $namespace));
				mkdir(dirname($archivo), 0777, true);
				touch($archivo);
			else:
				$archivo = implode(DIRECTORY_SEPARATOR, array($this->complementos, $namespace[0].'.php'));
				$this->nombreClase = $namespace[0];
				$this->namespace = 'Formularios';
				touch($archivo);
			endif;
			
			$plantilla = $this->archivoFormatoClase();
			
			$fopen = fopen($archivo, 'w');
			fwrite($fopen, $plantilla);
			fclose($fopen);
			
			$output->writeln("\n\n<info>Se ha creado la validación de formulario correctamente</info>\n\n");
		}
		
		/**
		 * Desarrollo::archivoFormatoClase()
		 * 
		 * Organiza los datos correspondientes para
		 * la construccion de la clase de
		 * validacion
		 * 
		 * @return string
		 */
		private function archivoFormatoClase() {
			foreach ($this->campos AS $param):
				$val = implode(", \n\t\t * 	\t@", $param['validacion']);
				$propiedad[] = $this->propiedadPlantilla($param['campo'], $param['columna'], $val);
				$metodos[] = $this->metodoPlantilla($param['campo'], ucfirst($param['campo']));
			endforeach;
			
			return $this->clasePlantilla(implode("\n\n", $propiedad), implode("\n\n", $metodos));
		}
		
		/**
		 * Desarrollo::formatoValidacion()
		 * 
		 * Genera el formato de las validaciones,
		 * se valida la existencia de la validacion
		 * y retorna la funcion correspondiente
		 * como plantilla para el proceso de la
		 * construccion de la validacion
		 * 
		 * @param string $campo
		 * @param string $validacion
		 * @return array
		 */
		private function formatoValidacion($campo = false, $validacion = false) {
			$formato = explode(',', $validacion);
			if(count($formato) >= 1 AND empty($formato[0]) == false):
				
				foreach ($formato AS $validar):
					$validador = mb_strtolower(trim($validar));
					if(array_key_exists($validador, $this->validaciones) == false):
						throw new \RuntimeException(sprintf('La validación: [ %s ] no es correcta en el campo: [ %s ]', $validar, $campo));
					else:
						$lista[] = $this->validaciones[$validador];
					endif;
				endforeach;
				
				return (isset($lista) == true) ? $lista : array();
			else:
				return array();
			endif;
		}
		
		/**
		 * Desarrollo::metodoPlantilla()
		 * 
		 * Genera la plantilla correspondiente para
		 * los metodos que se requieren de cada uno
		 * de los campos de formulario para obtener
		 * los datos con los formatos indicados
		 * 
		 * @param string $campo
		 * @param string $metodo
		 * @return string
		 */
		private function metodoPlantilla($campo = false, $metodo = false) {
			return <<<EOT
		/**
		 * {$this->nombreClase}::get{$metodo}()
		 *
		 * Retorna el valor del campo asignado
		 * @return mixed
		 */
		public function get{$metodo}() {
			return \$this->{$campo};
		}
		
		/**
		 * {$this->nombreClase}::set{$metodo}()
		 *
		 * Asigna el valor del campo asignado
		 * @return void
		 */
		public function set{$metodo}(\${$campo} = null) {
			return \$this->{$campo} = \${$campo};
		}
EOT;
		}
		
		/**
		 * Desarrollo::propiedadPlantilla()
		 * 
		 * Genera la plantilla base para el proceso
		 * de la propiedad correspondiente a
		 * validar
		 * 
		 * @param string $campo
		 * @param string $nombre
		 * @param string $validacion
		 * @param string $formato
		 * @return string
		 */
		private function propiedadPlantilla($campo = false, $nombre = false, $validacion = false) {
			return <<<EOT
		/**
		 * @Nombre("{$nombre}")
		 * @Configuracion(existencia=true, array=false, campos={""})
		 * @TipoDato(tipo="string")
		 * @Proceso(validacion={
		 * 		@{$validacion}
		 * })
		 * @Formato({})
		 */
		private \${$campo};
EOT;
		}
		
		/**
		 * Desarrollo::clasePlantilla()
		 * 
		 * Genera la plantilla correspondiente de
		 * la clase que validara el formulario y
		 * construira el script de validacion del
		 * lado del cliente
		 * 
		 * @return string
		 */
		private function clasePlantilla($propiedades = false, $metodos = false) {
			return <<<EOT
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

	namespace {$this->namespace};

	/**
	 * @IdForm(id="form")
	 * @Formulario(metodo="{$this->metodoPeticion}", ajax=false, formato=true)
	 * @JQuery(general="jQuery")
	 * @Seguridad(seguridad=false, token="{$this->token}") 
	 */
	class {$this->nombreClase} {

{$propiedades}

{$metodos}

		/**
		 * {$this->nombreClase}::peticionAjax()
		 *
		 * Genera el proceso en JavaScript JQuery
		 * para la petición ajax
		 *
		 * @return string
		 */
		public function peticionAjax() {
			return 'jQuery.ajax({
				url : "url de la consulta",
				data : jQuery(formulario).serialize(),
				dataType : "json",
				type : "POST",
				success : function(resultado) {
					
				}
			});';
		}
	}
EOT;
		}
	}
