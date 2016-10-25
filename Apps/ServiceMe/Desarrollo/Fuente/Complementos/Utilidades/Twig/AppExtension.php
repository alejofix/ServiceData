<?php
	
	namespace Utilidades\Twig;
	
	class AppExtension extends \Twig_Extension {
		
		private $permisos;
		private $usuario;
		
		function __construct($permisos, $usuario) {
			$this->permisos = $permisos;
			$this->usuario = $usuario;
		}
		
		public function getName() {
			return 'App Extension';
		}
		
		public function getGlobals() {
			return array(
				'app' => array(
					'sesion' => $this->permisos,
					'usuario' => $this->usuario
				)
			);
		}
		
		public function getFilters() {
			return array(
				new \Twig_SimpleFilter('print_r', array($this, 'filter_print_r')),
				new \Twig_SimpleFilter('sha1', array($this, 'filter_sha1'))
			);
		}
		
		public function filter_print_r($array) {
			return '<code><pre>'.print_r($array, true).'</pre></code>';
		}
		
		public function filter_sha1($texto) {
			return sha1($texto);
		}
	}