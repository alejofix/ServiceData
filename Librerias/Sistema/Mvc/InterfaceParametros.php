<?php
	
	namespace Mvc;
	
	interface InterfaceParametros {
		
		/**
		 * InterfaceParametros::asignarContenedor()
		 * 
		 * Asigna el valor al contenedor de datos
		 * para los procesos de consola y retorna
		 * el valor asignado en su momento, si el
		 * valor existe este sera sobre-escrito
		 * 
		 * @param string $nombre
		 * @param mixed $valor
		 * @return mixed
		 */
		public function asignarContenedor($nombre = false, $valor = false);
		
		/**
		 * InterfaceParametros::eliminarContenedor()
		 * 
		 * Elimina uno de los valores asignados al
		 * al contenedor y retornara true si se ha
		 * eliminado y si no fue posible eliminarlo
		 * o no existe el nombre asociativo del
		 * array retornara false
		 * 
		 * @param string $nombre
		 * @return bool
		 */
		public function eliminarContenedor($nombre = false);
		
		/**
		 * InterfaceParametros::existenciaContenedor()
		 * 
		 * Valida si existe el nombre asocitivo sen
		 * encuentra dentro del array de datos
		 * retornando true su existencia
		 * 
		 * @param string $nombre
		 * @return bool
		 */
		public function existenciaContenedor($nombre = false);
		
		/**
		 * InterfaceParametros::existenciaParametro()
		 * 
		 * Valida si existe el nombre asocitivo sen
		 * encuentra dentro del array de datos
		 * retornando true su existencia
		 * 
		 * @param string $nombre
		 * @return bool
		 */
		public function existenciaParametro($nombre = false);
		
		/**
		 * InterfaceParametros::obtenerContenedor()
		 * 
		 * Retorna el valor de la llave asociativa
		 * del array de datos retorna false si no
		 * se encuentra la llave asociativa
		 * 
		 * @param string $nombre
		 * @return mixed
		 */
		public function obtenerContenedor($nombre = false);
		
		/**
		 * InterfaceParametros::obtenerParametro()
		 * 
		 * Retorna el valor de la llave asociativa
		 * del array de datos retorna false si no
		 * se encuentra la llave asociativa
		 * 
		 * @param string $nombre
		 * @return mixed
		 */
		public function obtenerParametro($nombre = false);
		
		/**
		 * InterfaceParametros::obtenerContenedores()
		 * 
		 * Retorna el array de datos solicitados
		 * @param string $nombre
		 * @return array
		 */
		public function obtenerContenedores();
		
		/**
		 * InterfaceParametros::obtenerParametros()
		 * 
		 * Retorna el array de datos solicitados
		 * @param string $nombre
		 * @return array
		 */
		public function obtenerParametros();
	}