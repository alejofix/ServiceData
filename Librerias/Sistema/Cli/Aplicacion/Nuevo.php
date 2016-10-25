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
	use \Symfony\Component\Console\Input\InputArgument;
	use \Symfony\Component\Console\Input\InputInterface;
	use \Symfony\Component\Console\Input\InputOption;
	use \Symfony\Component\Console\Output\OutputInterface;
	
	class Nuevo extends Command {
		
		private $nombre = false;
		private $directorio = false;
		private $descripcion = false;
		private $codificacion = false;
		private $predeterminado = false;
		
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
			$this->setName('app:nuevo');
			$this->setDescription('Crear una nueva aplicacion');
			$this->addArgument('nombre', InputArgument::REQUIRED, 'Nombre de la aplicacion');
			$this->addArgument('directorio', InputArgument::REQUIRED, 'Nombre del directorio fuente');
			$this->addArgument('descripcion', InputArgument::REQUIRED, 'Descripción de la aplicacion');
			$this->addOption('codificar', 'c', InputOption::VALUE_NONE, 'Codificar directorio fuente de la aplicación');
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
			$this->nombre = trim($input->getArgument('nombre'));
			$this->directorio = trim($input->getArgument('directorio'));
			$this->descripcion = trim($input->getArgument('descripcion'));
			$this->codificacion = $input->getOption('codificar');
			$this->existenciaApp($input, $output);
		}
		
		/**
		 * Nuevo::existenciaApp()
		 * 
		 * Genera la validacion de la existencia de
		 * la aplicacion en el archivo de
		 * configuracion
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaApp(InputInterface $input, OutputInterface $output) {
			if(ConfigAcceso::appExistencia($this->nombre) == false):
				$this->existenciaDirectorio($input, $output);
			else:
				throw new \RuntimeException('La aplicación ya existe y se encuentra configurada');
			endif;
		}
		
		/**
		 * Nuevo::existenciaDirectorio()
		 * 
		 * Genera la validacion de la existencia
		 * del directorio que se creara para el
		 * sistema fuente de la aplicacion
		 * 
		 * @param object $input
		 * @param object $output
		 * @return raw
		 */
		private function existenciaDirectorio(InputInterface $input, OutputInterface $output) {
			$this->directorio = ($this->codificacion == true) ? md5($this->directorio) : $this->directorio;
			if(is_dir(implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, $this->directorio))) == false):
				$this->existenciaLectura($input, $output);
			else:
				throw new \RuntimeException('No es posible crear el directorio de la aplicación ya existe');
			endif;
		}
		
		/**
		 * Nuevo::existenciaLectura()
		 * 
		 * Genera la validacion si el directorio es
		 * posible escribir en el de lo contrario
		 * lanzara una excepcion cancelando la
		 * creacion de la aplicacion
		 * 
		 * @return raw
		 */
		private function existenciaLectura(InputInterface $input, OutputInterface $output) {
			if(is_writable(ROOT_APPS) == true):
				$this->existenciaLecturaConfg($input, $output);
			else:
				throw new \RuntimeException('El directorio contenedor de aplicaciones no es posible escribir en el directorio');
			endif;
		}
		
		/**
		 * Nuevo::existenciaLecturaConfg()
		 * 
		 * Valida si es posible escribir en el
		 * archivo de configuracion de accesos para
		 * registrar la nueva aplicacion se creara
		 * 
		 * @return raw
		 */
		private function existenciaLecturaConfg(InputInterface $input, OutputInterface $output) {
			$confg = implode(DIRECTORY_SEPARATOR, array(ROOT_CONFIG, 'Acceso.json'));
			if(is_writable($confg) == true):
				$this->procesar($input, $output, $confg);
			else:
				throw new \RuntimeException('El archivo de configuración de accesos no es posible escribir en el archivo');
			endif;
		}
		
		/**
		 * Nuevo::procesar()
		 *
		 * Genera el proceso general de de
		 * ejecucion del proceso de creacion de la
		 * estructura de la aplicacion
		 *  
		 * @param string $confg
		 * @return raw
		 */
		private function procesar(InputInterface $input, OutputInterface $output, $confg = false) {
			$entornos = array('Desarrollo', 'Produccion');
			
			mkdir(implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, $this->directorio)));
			
			foreach ($entornos AS $entorno):
				$this->procesarEntornos($entorno);
				$this->procesarArchivosConfig($entorno);
			endforeach;
			
			$this->procesarRegistrar($confg);
			
			$output->writeln("\n");
			$output->writeln('<info>Aplicación creada con exito</info>');
			$output->writeln("\n");
		}
		
		/**
		 * Nuevo::procesarRegistrar()
		 * 
		 * Genera el proceso general de realizar el
		 * registro de la nueva aplicacion
		 * 
		 * @param string $confg
		 * @return raw
		 */
		private function procesarRegistrar($confg = false) {
			$archivo = json_decode(file_get_contents($confg), true);
			$matriz = array_merge($archivo, $this->estructura());
			ksort($matriz);
			$matriz = json_encode($matriz, CONSOLA_JSON);
			
			$fopen = fopen($confg, 'w');
			fwrite($fopen, $matriz);
			fclose($fopen);
		}
		
		/**
		 * Nuevo::procesarEntornos()
		 *
		 * Genera el listado de directorios en los
		 * cuales se crearan, se realiza la
		 * validacion de la existencia de cada uno
		 * de los directorios en caso de existir se
		 * omite su creacion
		 *  
		 * @param string $entorno
		 * @return raw
		 */
		private function procesarEntornos($entorno = false) {
			$lista = $this->estructuraRuta(ROOT_APPS, $this->directorio, $entorno);
			foreach ($lista AS $ruta):
				if(is_dir($ruta['ruta']) == false):
					if(mkdir($ruta['ruta']) == false):
						throw new \RuntimeException('Se ha presentado un error al crear el directorio');
					endif;
				endif;
			endforeach;
		}
		
		/**
		 * Nuevo::procesarArchivosConfig()
		 * 
		 * Genera el proceso de creacion de los
		 * archivos de configuracion necesarios
		 * para el funcionamiento de la aplicacion
		 * 
		 * @param string $entorno
		 * @return raw
		 */
		private function procesarArchivosConfig($entorno = false) {
			$lista = array(
				array('metodo' => 'archivoConfiguracionExcepciones', 'ruta' => implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, $this->directorio, $entorno, 'Fuente', 'Configuracion', 'Excepciones.json'))),
				array('metodo' => 'archivoConfiguracionModulos', 'ruta' => implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, $this->directorio, $entorno, 'Fuente', 'Configuracion', 'Modulos.json'))),
				array('metodo' => 'archivoConfiguracionParametros', 'ruta' => implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, $this->directorio, $entorno, 'Fuente', 'Configuracion', 'Parametros.php'))),
				array('metodo' => 'archivoConfiguracionPlantilla', 'ruta' => implode(DIRECTORY_SEPARATOR, array(ROOT_APPS, $this->directorio, $entorno, 'Fuente', 'Sistema', 'Plantillas', 'Excepciones', 'Predeterminado.html')))
			);
			
			foreach ($lista AS $proceso):
				touch($proceso['ruta']);
				$fopen = fopen($proceso['ruta'], 'w');
				//fwrite($fopen, pack("CCC",0xef,0xbb,0xbf));
				fwrite($fopen, call_user_func(array($this, $proceso['metodo'])));
				fclose($fopen);
			endforeach;
		}
		
		/**
		 * Nuevo::estructuraRuta()
		 * 
		 * Genera la lista completa de las rutas
		 * correspondientes a la estructura a crear
		 * para la aplicacion indicada
		 * 
		 * @param string $root
		 * @param string $directorio
		 * @param string $entorno
		 * @return array
		 */
		private function estructuraRuta($root = false, $directorio = false, $entorno = false) {
			$lista[] = array('directorio' => $entorno, 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno)));
			$lista[] = array('directorio' => $entorno.' - Fuente', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Complementos', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Complementos')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Complementos - Consola', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Complementos', 'Consola')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Complementos - Formularios', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Complementos', 'Formularios')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Complementos - Interfaces', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Complementos', 'Interfaces')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Complementos - ORM', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Complementos', 'ORM')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Complementos - ORM', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Complementos', 'ORM', 'Entidades')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Complementos - ORM', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Complementos', 'ORM', 'Proxy')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Complementos - Temporal', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Complementos', 'Temporal')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Complementos - Utilidades', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Complementos', 'Utilidades')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Configuracion', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Configuracion')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Sistema', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Sistema')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Sistema - Modulos', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Sistema', 'Modulos')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Sistema - MVC', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Sistema', 'MVC')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Sistema - MVC - Controladores', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Sistema', 'MVC', 'Controladores')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Sistema - MVC - Modelos', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Sistema', 'MVC', 'Modelos')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Sistema - MVC - Vistas', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Sistema', 'MVC', 'Vistas')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Sistema - Plantillas', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Sistema', 'Plantillas')));
			$lista[] = array('directorio' => $entorno.' - Fuente - Sistema - Plantillas', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Fuente', 'Sistema', 'Plantillas', 'Excepciones')));
			$lista[] = array('directorio' => $entorno.' - Publico', 'ruta' => implode(DIRECTORY_SEPARATOR, array($root, $directorio, $entorno, 'Publico')));
			return $lista;
		}
		
		/**
		 * Nuevo::estructura()
		 * 
		 * Genera la estructura basica de la
		 * configuracion de accesos de la
		 * aplicacion correspondiente
		 * 
		 * @return array
		 */
		private function estructura() {
			return array(
				$this->nombre => array(
					'informacion' => array(
						'descripcion' => $this->descripcion,
						'creacion' => date("Y-m-d H:i:s"),
						'modificacion' => date("Y-m-d H:i:s")
					),
					'fuente' => array('directorio' => $this->directorio, 'publico' => (boolean) true),
					'localhost' => array('habilitado' => true, 'ip' => array('::1', '127.0.0.1')),
					'sistema' => array(
						'estructura' => array('Desarrollo' => true, 'Produccion' => true),
						'src' => array('permiso' => 755),
						'tiempo' => array('zona' => 'America/Bogota')
					),
					'criptografia' => array(
						'hashBinario' => (boolean) true,
						'compresion' => array('habilitado' => (boolean) false, 'nivelCompresion' => 8),
						'RIJNDAEL' => hash('ripemd128', date("Y-m-d H:i:s")),
						'BLOWFISH' => hash('ripemd160', date("Y-m-d H:i:s"))
					),
					'twig' => array(
						'codificacion' => 'UTF-8',
						'debug' => array('Desarrollo' => true, 'Produccion' => false),
						'cache' => array('Desarrollo' => false, 'Produccion' => false)
					)
				)
			);
		}
		
		/**
		 * Nuevo::archivoConfiguracionExcepciones()
		 * 
		 * Genera el contenido necesario para el
		 * proceso del archivo de configuracion
		 * 
		 * @return string
		 */
		private function archivoConfiguracionExcepciones() {
			return <<<EOT
{
	"predeterminado" : [ "Excepciones", "Predeterminado.html" ],
	"asignado" : {
		"mantenimiento" : [ "Excepciones", "Predeterminado.html" ]
	}
}
EOT;
		}
		
		/**
		 * Nuevo::archivoConfiguracionModulos()
		 * 
		 * Genera el contenido necesario para el
		 * proceso del archivo de configuracion
		 * 
		 * @return string
		 */
		private function archivoConfiguracionModulos() {
			return <<<EOT
{
	"configuracion" : {
		"habilitado" : false
	},
	"modulos" : []
}
EOT;
		}
		
		/**
		 * Nuevo::archivoConfiguracionParametros()
		 * 
		 * Genera el contenido necesario para el
		 * proceso del archivo de configuracion
		 * 
		 * @return string
		 */
		private function archivoConfiguracionParametros() {
			return <<<EOT
<?php
	
	/**
	 * NeuralPHP Framework
	 * Marco de trabajo para aplicaciones web.
	 * 
	 * @author Zyos (Carlos Parra) <Neural.Framework@gmail.com>
	 * @copyright 2006-2015 NeuralPHP Framework
	 * @license GNU General Public License as published by the Free Software Foundation; either version 2 of the License.  
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
	
	 /**
	  * Constante APP (NO ELIMINAR)
	  * 
	  * Es requerido indicar la aplicacion correspondiente
	  * para tenerla disponible para toda la aplicacion en
	  * cada una de sus cargas o peticiones
	  */
	define('APP', '{$this->nombre}');
	
	 /**
	  * Constante APPBD
	  * 
	  * Es requerido indicar la conexion correspondiente
	  * para tenerla disponible para toda la aplicacion en
	  * cada una de sus cargas o peticiones
	  */
	define('APPBD', '{$this->nombre}');
EOT;
		}
		
		/**
		 * Nuevo::archivoConfiguracionPlantilla()
		 * 
		 * Genera el contenido necesario para el
		 * proceso del archivo de configuracion
		 * 
		 * @return string
		 */
		private function archivoConfiguracionPlantilla() {
			return <<<EOT
<!DOCTYPE HTML>
	<html>
		<head>
			<title>.:: Excepcion Encontrada ::.</title>
			<link rel="stylesheet" href="{{ RUTA_RESERVADO|e }}/css/bootstrap.css">
			<link rel="stylesheet" href="{{ RUTA_RESERVADO|e }}/css/font-awesome.css">
			<style>
				body {
					padding: 25px;
				}
			</style>
		</head>
		<body>
			<h1>Se ha presentado una Excepción</h1>
			<p><strong>Codigo:</strong> {{ CODIGO|e }}</p>
			<p><strong>Mensaje:</strong> {{ MENSAJE|e }}</p>
		</body>
	</html>
EOT;
		}
	}
