<?php
	
	namespace Mvc;
	use \Neural\Excepcion;
	
	class Consola {
		
		/**
		 * Contenedor de los parametros requeridos
		 */
		private $parametros = array();
		
		/**
		 * Consola::asignarParametro()
		 * 
		 * Asigna el nombre del parametro que
		 * recibira a traves de la consola para el
		 * procesamiento
		 * 
		 * @param bool $nombre
		 * @param mixed $tipo
		 * @param mixed $descripcion
		 * @return void
		 */
		protected function asignarParametro($nombre = false, $tipo = null, $descripcion = null) {
			if(is_string($nombre) == true):
				$this->parametros[] = array('parametro' => $nombre, 'tipo' => $tipo, 'descripcion' => $descripcion);
			else:
				throw new \RuntimeException('Debe ingresar el nombre del parametro');
			endif;
		}
	}