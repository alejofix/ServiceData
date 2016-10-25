<?php
	
	namespace Utilidades\Formularios;
	use \NeuralPHP\Reflexion\Init AS Comentarios;
	
	class Constructor {
		
		private $comentarios;
		public $contenedor = array();
		private $formInicio;
		private $formFin;
		
		function __construct($namespace = null) {
			$this->comentarios = new \NeuralPHP\Reflexion\Init($namespace);
			$this->comentarios->registrarAnotaciones(implode(DIRECTORY_SEPARATOR, array(ROOT_SISTEMA, 'Controlador', 'Formulario', 'Reflexion')));
			$this->comentarios->registrarAnotaciones(implode(DIRECTORY_SEPARATOR, array(ROOT_SISTEMA, 'Controlador', 'Formulario', 'Reflexion', 'Html')));
			$this->comentarios->registrarAnotaciones(implode(DIRECTORY_SEPARATOR, array(ROOT_SISTEMA, 'Controlador', 'Formulario', 'Reflexion', 'Proceso')));
			$this->constructCampo();
			$this->constructForm();
		}
		
		private function constructForm() {
			$array = $this->comentarios->clase();
			
			if(array_key_exists('complemento', $array) == true):
				
				if(array_key_exists('url', $array['complemento']) == true AND $array['complemento']['url'] != null):
					$form[] = sprintf('action="%s"', ($array['formulario']['ajax'] == false) ? $array['complemento']['url'] : 'javascript:;');
				endif;
				
				if(array_key_exists('class', $array['complemento']) == true AND $array['complemento']['class'] != null):
					$form[] = sprintf('class="%s"', $array['complemento']['class']);
				endif;
				
				if($array['complemento']['archivos'] == true):
					$form[] = 'enctype="multipart/form-data"';
				endif;
				
			endif;
			
			$form[] = sprintf('id="%s"', $array['idForm']['id']);
			$form[] = sprintf('method="%s"', mb_strtoupper($array['formulario']['metodo']));
			
			$this->formInicio = sprintf('<form %s>', implode(' ', $form));
			
			if($array['seguridad']['seguridad'] == true):
				$formFin[] = sprintf('<input type="hidden" name="token" value="%s" />', $array['seguridad']['token']);
			endif;
			
			$formFin[] = '</form>';
			$this->formFin = implode("\n", $formFin);
			
		}
		
		/**
		 * Constructor::constructCampo()
		 * 
		 * genera la validacion de los campos del formulario
		 * @return void
		 */
		private function constructCampo() {
			$array = $this->comentarios->propiedades();
			
			foreach ($array AS $campo => $param):
				if(array_key_exists('input', $param) == true):
					$this->constructInput($campo, $param['input']);
				elseif(array_key_exists('select', $param) == true):
					$this->constructSelect($campo, $param['select']);
				elseif(array_key_exists('textarea', $param) == true):
					$this->constructTextArea($campo, $param['textarea']);
				endif;
			endforeach;
		}
		
		private function constructTextArea($name, $param) {
			$this->contenedor[$name]['tipo'] = 'textarea';
			$this->contenedor[$name]['label'] = $param['label'];
			$this->contenedor[$name]['name'] = $name;
			
			//$input[] = sprintf('name="%s"', $name);
			if($param['array'] == true):
				
				$nombre = '['.implode('][', $param['campo']).']';
				$input[] = sprintf('name="%s%s"', $name, $nombre);
			else:
				$input[] = sprintf('name="%s"', $name);
			endif;
			
			if($param['id'] != null):
				$input[] = sprintf('id="%s"', $param['id']);
			endif;
			
			if($param['class'] != null):
				$input[] = sprintf('class="%s"', $param['class']);
			endif;
			
			if($param['placeholder'] != null):
				$input[] = sprintf('placeholder="%s"', $param['placeholder']);
			endif;
			
			if($param['required'] != null):
				$input[] = 'required=""';
			endif;
			
			if($param['autofocus'] != null):
				$input[] = 'autofocus=""';
			endif;
			
			$this->contenedor[$name]['campo'] = sprintf('<textarea %s></textarea>', implode(' ', $input));
		}
		
		private function constructInput($name, $param) {
			$this->contenedor[$name]['tipo'] = 'input';
			$this->contenedor[$name]['label'] = $param['label'];
			$this->contenedor[$name]['name'] = $name;
			
			$input[] = sprintf('type="%s"', $param['type']);
			
			if($param['array'] == true):
				$nombre = '['.implode('][', $param['campo']).']';
				$input[] = sprintf('name="%s%s"', $name, $nombre);
			else:
				$input[] = sprintf('name="%s"', $name);
			endif;
			
			if($param['id'] != null):
				$input[] = sprintf('id="%s"', $param['id']);
			endif;
			
			if($param['class'] != null):
				$input[] = sprintf('class="%s"', $param['class']);
			endif;
			
			if($param['placeholder'] != null):
				$input[] = sprintf('placeholder="%s"', $param['placeholder']);
			endif;
			
			if($param['required'] != null):
				$input[] = 'required=""';
			endif;
			
			if($param['autofocus'] != null):
				$input[] = 'autofocus=""';
			endif;
			
			$this->contenedor[$name]['campo'] = sprintf('<input %s />', implode(' ', $input));
		}
		
		private function constructSelect($name, $param) {
			$this->contenedor[$name]['tipo'] = 'select';
			$this->contenedor[$name]['label'] = $param['label'];
			$this->contenedor[$name]['name'] = $name;
			
			//$input[] = sprintf('name="%s"', $name);
			if($param['array'] == true):
				$nombre = '['.implode('][', $param['campo']).']';
				$input[] = sprintf('name="%s%s"', $name, $nombre);
			else:
				$input[] = sprintf('name="%s"', $name);
			endif;
			
			if($param['id'] != null):
				$input[] = sprintf('id="%s"', $param['id']);
			endif;
			
			if($param['class'] != null):
				$input[] = sprintf('class="%s"', $param['class']);
			endif;
			
			if($param['required'] != null):
				$input[] = 'required=""';
			endif;
			
			if($param['autofocus'] != null):
				$input[] = 'autofocus=""';
			endif;
			
			$this->contenedor[$name]['campo'] = $input;
		}
		
		public function select($param = array(), $consulta = null, $CValor = null, $CTexto = array(), $concatenador = ' ') {
			
			if($consulta != null AND is_array($consulta) == true AND is_string($CValor) == true):
				
				$select[] = sprintf('<select %s>', implode(' ', $param['campo']));
				$select[] = '<option value="">Escoja una Opción</option><optgroup>';
				
				foreach ($consulta AS $campo):
					$select[] = sprintf('<option value="%s">%s</option>'."\n", call_user_func(array($campo, $CValor)), $this->selectTextos($campo, $concatenador, $CTexto));
				endforeach;
				$select[] = '</optgroup></select>';
				
				return implode("\n", $select);
				
			elseif($consulta != null AND is_array($consulta) == true):
				
				$select[] = sprintf('<select %s>', implode(' ', $param['campo']));
				$select[] = '<option value="">Escoja una Opción</option><optgroup>';
				
				foreach ($consulta AS $llave => $valor):
					$select[] = sprintf('<option value="%s">%s</option>'."\n", $llave, $valor);
				endforeach;
				$select[] = '</optgroup></select>';
				
				return implode("\n", $select);
			else:
				return sprintf('<select %s><option value="">Escoja una Opción</option></select>', implode(' ', $param['campo']));
			endif;
		}
		
		private function selectTextos($campo, $concatenador, $array = array()) {
			
			foreach ($array AS $texto):
				$lista[] = call_user_func(array($campo, $texto));
			endforeach;
			
			return implode($concatenador, $lista);
		}
		
		public function inicio() {
			return $this->formInicio;
		}
		
		public function fin() {
			return $this->formFin;
		}
		
		public function submit($onclick = '', $texto = '', $class = '', $id = '', $entypo = '') {
			return sprintf('<button onclick="%s" type="submit" class="%s" id="%s">%s%s</button>&nbsp;&nbsp;&nbsp;', $onclick, $class, $id, $texto, $entypo);
		}
		
		public function reload($onclick = '', $texto = '', $class = '', $id = '', $entypo = '') {
			return sprintf('<button onclick="%s" type="reset" class="%s" id="%s">%s%s</button>&nbsp;&nbsp;&nbsp;', $onclick, $class, $id, $texto, $entypo);
		}
		
		public function prueba() {
			return $this->contenedor;
		}
	}