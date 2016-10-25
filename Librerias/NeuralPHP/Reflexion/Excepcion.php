<?php
	
	namespace NeuralPHP\Reflexion;
	
	class Excepcion extends \Exception {
		
		/**
		 * Excepcion::__construct()
		 * 
		 * Genera las parametros necesarios para
		 * genera la excepcion teniendo en cuenta
		 * extendiendo a excepcion 
		 * 
		 * @param string $mensaje 
		 * @param integer $codigo 
		 * @return void
		 */
		function __construct($mensaje, $codigo = 0) {
			parent::__construct($mensaje, $codigo, null);
		}
	}