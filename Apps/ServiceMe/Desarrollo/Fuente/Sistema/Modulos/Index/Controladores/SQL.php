<?php

	namespace Controlador\Modulo\Index;
	
	use \Mvc\Controlador;
	use \Neural\Excepcion;
	
	class SQL extends Controlador {
		
		private $esquema;
		private $conexion;
		private $plataforma;
		private $opcForeign;
		
		public function __construct() {
			parent::__construct();
			ini_set('max_execution_time', 900);
			$bd = new \Neural\BD\Conexion('ServiceMe', APP);
			$this->conexion = $bd->doctrineDBAL();
			$this->esquema = new \Doctrine\DBAL\Schema\Schema();
			$this->plataforma = $this->conexion->getDatabasePlatform();
			$this->opcForeign = array('onDelete' => 'no action', 'onUpdate' => 'no action');
		}
		
		public function Index() {
			$this->tablas();
			
			$dump = $this->esquema->toDropSql($this->plataforma);
			$SQL = $this->esquema->toSql($this->plataforma);
			
			echo '<code><pre>';
		//	print_r($dump);
			print_r($SQL);
			$this->conexion->executeQuery('DROP DATABASE servicesql');
			$this->conexion->executeQuery('CREATE DATABASE servicesql');
			$this->conexion->executeQuery('USE servicesql');
			
			foreach ($SQL AS $create):
				$this->conexion->executeQuery($create);
			endforeach;
			
			
			// insert TaBLas_GENERALes
			$this->conexion->insert('TBL_GENERAL_ESTADOS', array('NOMBRE' => 'ACTIVO'));
			$this->conexion->insert('TBL_GENERAL_ESTADOS', array('NOMBRE' => 'INACTIVO'));
			$this->conexion->insert('TBL_GENERAL_ESTADOS', array('NOMBRE' => 'PENDIENTE'));
			$this->conexion->insert('TBL_GENERAL_ESTADOS', array('NOMBRE' => 'FINALIZADO'));
			$this->conexion->insert('TBL_GENERAL_ESTADOS', array('NOMBRE' => 'GUARDADO'));
			$this->conexion->insert('TBL_GENERAL_ESTADOS', array('NOMBRE' => 'ELIMINADO'));
			$this->conexion->insert('TBL_GENERAL_ESTADOS', array('NOMBRE' => 'ESCALADO'));
			$this->conexion->insert('TBL_GENERAL_ESTADOS', array('NOMBRE' => 'APROBADO'));
			$this->conexion->insert('TBL_GENERAL_ESTADOS', array('NOMBRE' => 'NO APROBADO'));
			
			$this->conexion->insert('TBL_GENERAL_CARGO', array('NOMBRE' => 'DESAROLLADOR'));
			$this->conexion->insert('TBL_GENERAL_CARGO', array('NOMBRE' => 'ADMINISTRADOR'));
			$this->conexion->insert('TBL_GENERAL_CARGO', array('NOMBRE' => 'ANALISTA'));
			$this->conexion->insert('TBL_GENERAL_CARGO', array('NOMBRE' => 'LIDER'));
			$this->conexion->insert('TBL_GENERAL_CARGO', array('NOMBRE' => 'EXPERTO'));
			$this->conexion->insert('TBL_GENERAL_CARGO', array('NOMBRE' => 'ASESOR'));
						
			$this->conexion->insert('TBL_GENERAL_EMPRESAS', array('NOMBRE' => 'CLARO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_GENERAL_EMPRESAS', array('NOMBRE' => 'MDY', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_GENERAL_EMPRESAS', array('NOMBRE' => 'ATENTO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_GENERAL_EMPRESAS', array('NOMBRE' => 'INTERACTIVO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_GENERAL_EMPRESAS', array('NOMBRE' => 'OUTSOURCING', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_GENERAL_EMPRESAS', array('NOMBRE' => 'INTERCONTACT', 'ESTADO' => 1,));
			
			$this->conexion->insert('TBL_GENERAL_SERVICIOS', array('PRODUCTO' => 'TRIPLEPLAY'));
			$this->conexion->insert('TBL_GENERAL_SERVICIOS', array('PRODUCTO' => 'INTERNET'));
			$this->conexion->insert('TBL_GENERAL_SERVICIOS', array('PRODUCTO' => 'TELEFONÍA'));
			$this->conexion->insert('TBL_GENERAL_SERVICIOS', array('PRODUCTO' => 'TELEVISIÓN'));
			
			// insert TaBLas_PERMISOs
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'ROOT','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'ANALISTA MEJORAMIENTO','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'ANALISTA SERVICE DESK','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'ANALISTA TORRE','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'ADMINISTRADOR','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'LIDER INHOUSE','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'EXPERTO PISO','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'LIDER ALIADO','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'INVITADO COMUNICACION','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'APOYO SERVICE DESK','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'APOYO MEJORAMIENTO','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS', array('NOMBRE' => 'ASEGURAMIENTO','ESTADO' => 1,));
			
			$this->conexion->insert('TBL_PERMISOS_SEC_MODULOS', array('NOMBRE' => 'Central','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS_SEC_MODULOS', array('NOMBRE' => 'Usuarios','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS_SEC_MODULOS', array('NOMBRE' => 'Proyectos','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS_SEC_MODULOS', array('NOMBRE' => 'HFC','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS_SEC_MODULOS', array('NOMBRE' => 'Matrices','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS_SEC_MODULOS', array('NOMBRE' => 'Plataforma','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS_SEC_MODULOS', array('NOMBRE' => 'Mejoras','ESTADO' => 1,));
			$this->conexion->insert('TBL_PERMISOS_SEC_MODULOS', array('NOMBRE' => 'Comunicacion','ESTADO' => 1,));
			
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '1', 'ESCRITURA' => '1', 'ELIMINAR' => '1', 'ACTUALIZAR' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '1', 'ESCRITURA' => '1', 'ELIMINAR' => '0', 'ACTUALIZAR' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '1', 'ESCRITURA' => '1', 'ELIMINAR' => '0', 'ACTUALIZAR' => '0',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '1', 'ESCRITURA' => '0', 'ELIMINAR' => '1', 'ACTUALIZAR' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '1', 'ESCRITURA' => '0', 'ELIMINAR' => '0', 'ACTUALIZAR' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '1', 'ESCRITURA' => '0', 'ELIMINAR' => '0', 'ACTUALIZAR' => '0',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '0', 'ESCRITURA' => '1', 'ELIMINAR' => '1', 'ACTUALIZAR' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '0', 'ESCRITURA' => '1', 'ELIMINAR' => '0', 'ACTUALIZAR' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '0', 'ESCRITURA' => '1', 'ELIMINAR' => '0', 'ACTUALIZAR' => '0',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '0', 'ESCRITURA' => '0', 'ELIMINAR' => '1', 'ACTUALIZAR' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '0', 'ESCRITURA' => '0', 'ELIMINAR' => '0', 'ACTUALIZAR' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_BASE', array('LECTURA' => '0', 'ESCRITURA' => '0', 'ELIMINAR' => '0', 'ACTUALIZAR' => '0',));
			
			//'Central'
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '1','MODULO' => '1', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '2','MODULO' => '1', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '3','MODULO' => '1', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '4','MODULO' => '1', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '5','MODULO' => '1', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '6','MODULO' => '1', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '7','MODULO' => '1', 'BASE' => '3',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '8','MODULO' => '1', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '9','MODULO' => '1', 'BASE' => '3',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '10','MODULO' => '1', 'BASE' => '3',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '11','MODULO' => '1', 'BASE' => '3',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '12','MODULO' => '1', 'BASE' => '3',));
			
			//'Usuarios'
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '1','MODULO' => '2', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '2','MODULO' => '2', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '3','MODULO' => '2', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '4','MODULO' => '2', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '5','MODULO' => '2', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '6','MODULO' => '2', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '7','MODULO' => '2', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '8','MODULO' => '2', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '9','MODULO' => '2', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '10','MODULO' => '2', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '11','MODULO' => '2', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '12','MODULO' => '2', 'BASE' => '12',));
			
			//'Proyectos'
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '1','MODULO' => '3', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '2','MODULO' => '3', 'BASE' => '3',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '3','MODULO' => '3', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '4','MODULO' => '3', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '5','MODULO' => '3', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '6','MODULO' => '3', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '7','MODULO' => '3', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '8','MODULO' => '3', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '9','MODULO' => '3', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '10','MODULO' => '3', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '11','MODULO' => '3', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '12','MODULO' => '3', 'BASE' => '12',));
			
			//'HFC''Matrices''Plataforma'
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '1','MODULO' => '4', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '2','MODULO' => '4', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '3','MODULO' => '4', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '4','MODULO' => '4', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '5','MODULO' => '4', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '6','MODULO' => '4', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '7','MODULO' => '4', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '8','MODULO' => '4', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '9','MODULO' => '4', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '10','MODULO' => '4', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '11','MODULO' => '4', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '12','MODULO' => '4', 'BASE' => '6',));
			
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '1','MODULO' => '5', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '2','MODULO' => '5', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '3','MODULO' => '5', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '4','MODULO' => '5', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '5','MODULO' => '5', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '6','MODULO' => '5', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '7','MODULO' => '5', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '8','MODULO' => '5', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '9','MODULO' => '5', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '10','MODULO' => '5', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '11','MODULO' => '5', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '12','MODULO' => '5', 'BASE' => '6',));
			
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '1','MODULO' => '6', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '2','MODULO' => '6', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '3','MODULO' => '6', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '4','MODULO' => '6', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '5','MODULO' => '6', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '6','MODULO' => '6', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '7','MODULO' => '6', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '8','MODULO' => '6', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '9','MODULO' => '6', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '10','MODULO' => '6', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '11','MODULO' => '6', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '12','MODULO' => '6', 'BASE' => '6',));
			
			//'Mejoras'
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '1','MODULO' => '7', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '2','MODULO' => '7', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '3','MODULO' => '7', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '4','MODULO' => '7', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '5','MODULO' => '7', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '6','MODULO' => '7', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '7','MODULO' => '7', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '8','MODULO' => '7', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '9','MODULO' => '7', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '10','MODULO' => '7', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '11','MODULO' => '7', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '12','MODULO' => '7', 'BASE' => '1',));
			
			//'Comunicacion'
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '1','MODULO' => '8', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '2','MODULO' => '8', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '3','MODULO' => '8', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '4','MODULO' => '8', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '5','MODULO' => '8', 'BASE' => '1',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '6','MODULO' => '8', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '7','MODULO' => '8', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '8','MODULO' => '8', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '9','MODULO' => '8', 'BASE' => '12',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '10','MODULO' => '8', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '11','MODULO' => '8', 'BASE' => '6',));
			$this->conexion->insert('TBL_PERMISOS_SEC_SELECCION', array('PERMISO' => '12','MODULO' => '8', 'BASE' => '6',));
			
			// insert TaBLas_Usuario ROOT
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'FIX', 
				'PASSWORD' => sha1('cocacola0'), 
				'NOMBRE_INICIAL' => 'ALEJO', 
				'APELLIDO_INICIAL' => 'FIX', 
				'DOCUMENTO' => 79696444, 
				'FECHA_NACIMIENTO' => '2015-01-02', 
				'FECHA_EXPEDICION' =>  '2015-01-02', 
				'FIJO' => '8008881', 
				'MOVIL' => '3005514948', 
				'GENERO' => 'M', 
				'CORREO' => 'SERVICE_ME@CLARO.NET.CO', 
				'EMPRESA' => 1,'CARGO' => 1, 'ESTADO' => 1, 'PERMISO' => 1,
			));
			
			// insert TaBLas_Mejoramiento_PROYECTOS
			$this->conexion->insert('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_PROYECTOS', array('NOMBRE' => 'NUEVO PROYECTO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_PROYECTOS', array('NOMBRE' => 'ASIGNACION ANALISTA', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_PROYECTOS', array('NOMBRE' => 'ADJUNTO ARCHIVO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_PROYECTOS', array('NOMBRE' => 'EDITO PROYECTO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_PROYECTOS', array('NOMBRE' => 'FINALIZO PROYECTO', 'ESTADO' => 1,));
			// insert TaBLas_Mejoramiento_MEJORAS
			$this->conexion->insert('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_MEJORAS', array('NOMBRE' => 'NUEVA MEJORA', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_MEJORAS', array('NOMBRE' => 'NUEVO OBJETIVO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_MEJORAS', array('NOMBRE' => 'NOTA GESTION', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_MEJORAS', array('NOMBRE' => 'CAMBIO ESTADO', 'ESTADO' => 1,));
			// intsert TBL_SERVICECO ALTOIMPACTO_TIPO
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_TIPO', array('NOMBRE' => 'HFC', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_TIPO', array('NOMBRE' => 'INTERNET', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_TIPO', array('NOMBRE' => 'OTROS', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_TIPO', array('NOMBRE' => 'TELEFONIA', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_TIPO', array('NOMBRE' => 'TELEVISION', 'ESTADO' => 1,));
			// intsert TBL_SERVICECO ALTOIMPACTO_DETALLE
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'ALARMA OPTICA', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'CAUSA EXOGENO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'DESENGANCHE MASIVO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'ESTANDAR', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'FALLA INTERNET', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'FALLA TELEFONIA', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'FALLA TELEVISION', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'FLUIDO ELECTRICO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'HURTO', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'PLATAFORMA INTERNET', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'PLATAFORMA TELEFONÍA', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'PLATAFORMA TELEVISIÓN', 'ESTADO' => 1,));
			$this->conexion->insert('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE', array('NOMBRE' => 'RUPTURA DE FIBRA', 'ESTADO' => 1,));
			
		}
		
		private function tablas() {
		// creación TaBLas_GENERALes  	
			$this->estados = $this->esquema->createTable('TBL_GENERAL_ESTADOS');
			$this->estados->addColumn('ID', 'bigint', $this->opciones('ID del estado', true, null, true, 20));
			$this->estados->addColumn('NOMBRE', 'string', $this->opciones('Nombre del Estado', true, null, null, 255, true));
			$this->estados->setPrimaryKey(array('ID'));

			$this->empresas = $this->esquema->createTable('TBL_GENERAL_EMPRESAS');
			$this->empresas->addColumn('ID', 'bigint', $this->opciones('ID de la Empresa', true, null, true, 20));
			$this->empresas->addColumn('NOMBRE', 'string', $this->opciones('Nombre de la Empresa', true, null, null, 255, true));
			$this->empresas->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->empresas->setPrimaryKey(array('ID'));
			$this->empresas->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);

			$this->cargo = $this->esquema->createTable('TBL_GENERAL_CARGO');
			$this->cargo->addColumn('ID', 'bigint', $this->opciones('ID del Cargo', true, null, true, 20));
			$this->cargo->addColumn('NOMBRE', 'string', $this->opciones('Nombre del Cargo', true, null, null, 255, true));
			$this->cargo->setPrimaryKey(array('ID'));
			
			$this->servicios = $this->esquema->createTable('TBL_GENERAL_SERVICIOS');
			$this->servicios->addColumn('ID', 'bigint', $this->opciones('ID del Producto', true, null, true, 20));
			$this->servicios->addColumn('PRODUCTO', 'string', $this->opciones('Nombre del Producto', true, null, null, 255, true));
			$this->servicios->setPrimaryKey(array('ID'));
		
		// creación TaBLas_PERMISOS	
			$this->permisos = $this->esquema->createTable('TBL_PERMISOS');
			$this->permisos->addColumn('ID', 'bigint', $this->opciones('ID del Permiso', true, null, true, 20));	
			$this->permisos->addColumn('NOMBRE', 'string', $this->opciones('Nombre del Permiso', true, null, null, 255, true));
			$this->permisos->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->permisos->setPrimaryKey(array('ID'));
			$this->permisos->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);

			$this->permisosmodulo = $this->esquema->createTable('TBL_PERMISOS_SEC_MODULOS');
			$this->permisosmodulo->addColumn('ID', 'bigint', $this->opciones('ID del Modulo', true, null, true, 20));	
			$this->permisosmodulo->addColumn('NOMBRE', 'string', $this->opciones('Nombre del Modulo', true, null, null, 255, true));
			$this->permisosmodulo->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->permisosmodulo->setPrimaryKey(array('ID'));
			$this->permisosmodulo->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);

			$this->permisosbase = $this->esquema->createTable('TBL_PERMISOS_SEC_BASE');
			$this->permisosbase->addColumn('ID', 'bigint', $this->opciones('ID de Base', true, null, true, 20));
			$this->permisosbase->addColumn('LECTURA', 'integer', $this->opciones('Per Lectura', true, null, null, null));	
			$this->permisosbase->addColumn('ESCRITURA', 'integer', $this->opciones('Per Escritura', true, null, null, null));
			$this->permisosbase->addColumn('ELIMINAR', 'integer', $this->opciones('Per Eliminar', true, null, null, null));
			$this->permisosbase->addColumn('ACTUALIZAR', 'integer', $this->opciones('Per Actualizar', true, null, null, null));
			$this->permisosbase->setPrimaryKey(array('ID'));

			$this->permisosseleccion = $this->esquema->createTable('TBL_PERMISOS_SEC_SELECCION');
			$this->permisosseleccion->addColumn('ID', 'bigint', $this->opciones('ID de Seleccion', true, null, true, 20));
			$this->permisosseleccion->addColumn('PERMISO', 'bigint', $this->opciones('ID Permiso', true, null, null, 20));
			$this->permisosseleccion->addColumn('MODULO', 'bigint', $this->opciones('ID Modulo', true, null, null, 20));
			$this->permisosseleccion->addColumn('BASE', 'bigint', $this->opciones('ID Base', true, null, null, 20));
			$this->permisosseleccion->addForeignKeyConstraint($this->permisos, array('PERMISO'), array('ID'), $this->opcForeign);
			$this->permisosseleccion->addForeignKeyConstraint($this->permisosmodulo, array('MODULO'), array('ID'), $this->opcForeign);
			$this->permisosseleccion->addForeignKeyConstraint($this->permisosbase, array('BASE'), array('ID'), $this->opcForeign);
			$this->permisosseleccion->setPrimaryKey(array('ID'));
	
		// creación TaBLas_USUARIOS
			$this->usuarios = $this->esquema->createTable('TBL_USUARIOS');
			$this->usuarios->addColumn('ID', 'bigint', $this->opciones('ID del Usuario', true, null, true, 20));
			$this->usuarios->addColumn('USUARIO', 'string', $this->opciones('Usuario', true, null, null, 255, true));
			$this->usuarios->addColumn('PASSWORD', 'string', $this->opciones('Contrasena Usuario', true, null, null, 255));
			$this->usuarios->addColumn('NOMBRE_INICIAL', 'string', $this->opciones('Primer Nombre', true, null, null, 255));
			$this->usuarios->addColumn('NOMBRE_FINAL', 'string', $this->opciones('Segundo Nombre', false, null, null, 255));				
			$this->usuarios->addColumn('APELLIDO_INICIAL', 'string', $this->opciones('Primer Apellido', true, null, null, 255));
			$this->usuarios->addColumn('APELLIDO_FINAL', 'string', $this->opciones('Segundo Apellido', false, null, null, 255));				
			$this->usuarios->addColumn('DOCUMENTO', 'string', $this->opciones('Identificacion Usuario', true, null, null, 255));
			$this->usuarios->addColumn('FECHA_NACIMIENTO', 'date', $this->opciones('Fecha Nacimiento', true, null, null, null));
			$this->usuarios->addColumn('FECHA_EXPEDICION', 'date', $this->opciones('Expedicion Documento', true, null, null, null));
			$this->usuarios->addColumn('FIJO', 'string', $this->opciones('Telefono Fijo', false, null, null, 255));
			$this->usuarios->addColumn('MOVIL', 'string', $this->opciones('Telefono Celular', false, null, null, 255));
			$this->usuarios->addColumn('EPS', 'string', $this->opciones('EPS Usuario', false, null, null, 255));
			$this->usuarios->addColumn('ARP', 'string', $this->opciones('ARP Usuario', false, null, null, 255));
			$this->usuarios->addColumn('RR', 'string', $this->opciones('Usuario RR', false, null, null, 255));
			$this->usuarios->addColumn('GENERO', 'string', $this->opciones('Genero Sexo', true, null, null, 255));
			$this->usuarios->addColumn('CORREO', 'string', $this->opciones('Direccion Correo', false, null, null, 255));
			$this->usuarios->addColumn('EMPRESA', 'bigint', $this->opciones('ID Empresa', true, null, null, 20));
			$this->usuarios->addColumn('CARGO', 'bigint', $this->opciones('ID Cargo', true, null, null, 20));
			$this->usuarios->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->usuarios->addColumn('PERMISO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->usuarios->addForeignKeyConstraint($this->empresas, array('EMPRESA'), array('ID'), $this->opcForeign);
			$this->usuarios->addForeignKeyConstraint($this->cargo, array('CARGO'), array('ID'), $this->opcForeign);
			$this->usuarios->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->usuarios->addForeignKeyConstraint($this->permisos, array('PERMISO'), array('ID'), $this->opcForeign);
			$this->usuarios->setPrimaryKey(array('ID'));
			
			$this->usuariosholos = $this->esquema->createTable('TBL_USUARIOS_SEC_RADIOGRAFIA');
			$this->usuariosholos->addColumn('ID', 'bigint', $this->opciones('ID del Colaborador', true, null, true, 20));
			$this->usuariosholos->addColumn('FECHA_INGRESO', 'date', $this->opciones('Ingreso a Empresa', false, null, null, null));
			$this->usuariosholos->addColumn('TIPO_IDENTIFICACION', 'string', $this->opciones('Tipo Identificacion', false, null, null, 100));
			$this->usuariosholos->addColumn('NUMERO_DOCUMENTO', 'string', $this->opciones('No. Documento', false, null, null, 100));
			$this->usuariosholos->addColumn('FECHA_EXPEDICION', 'date', $this->opciones('Expedicion Documento', false, null, null, null));
			$this->usuariosholos->addColumn('CIUDAD_EXPEDICION', 'string', $this->opciones('Ciudad Documento', false, null, null, 100));
			$this->usuariosholos->addColumn('NOMBRE_INICIAL', 'string', $this->opciones('Primer Nombre', false, null, null, 100));
			$this->usuariosholos->addColumn('NOMBRE_FINAL', 'string', $this->opciones('Segundo Nombre', false, null, null, 100));
			$this->usuariosholos->addColumn('APELLIDO_INICIAL', 'string', $this->opciones('Primer Apellido', false, null, null, 100));
			$this->usuariosholos->addColumn('APELLIDO_FINAL', 'string', $this->opciones('Segundo Apellido', false, null, null, 100));
			$this->usuariosholos->addColumn('ALIADO', 'string', $this->opciones('Aliado', false, null, null, 100));
			$this->usuariosholos->addColumn('CANAL', 'string', $this->opciones('Canal', false, null, null, 100));
			$this->usuariosholos->addColumn('OPERACION', 'string', $this->opciones('Operacion', false, null, null, 100));
			$this->usuariosholos->addColumn('TIPO_LINEA', 'string', $this->opciones('Tipo Linea', false, null, null, 100));
			$this->usuariosholos->addColumn('GENERO', 'string', $this->opciones('Genero', false, null, null, 100));
			$this->usuariosholos->addColumn('FAMILIAR_CLARO', 'string', $this->opciones('Familiar Claro', false, null, null, 100));
			$this->usuariosholos->addColumn('CARGO_FAMILIAR', 'string', $this->opciones('Cargo Familiar', false, null, null, 100));
			$this->usuariosholos->addColumn('GRUPO', 'string', $this->opciones('Grupo Colaborador', false, null, null, 100));
			$this->usuariosholos->addColumn('CARGO_COLABORADOR', 'string', $this->opciones('Cargo Colaborador', false, null, null, 100));
			$this->usuariosholos->addColumn('ESTADO', 'string', $this->opciones('Estado', false, null, null, 100));
			$this->usuariosholos->addColumn('MOVIL', 'string', $this->opciones('Claro', false, null, null, 100));
			$this->usuariosholos->addColumn('FIJO', 'string', $this->opciones('Telmex', false, null, null, 100));
			$this->usuariosholos->addColumn('CAPACITADOR', 'string', $this->opciones('Capacitador', false, null, null, 100));
			$this->usuariosholos->addColumn('CORREO_CAPACITADOR', 'string', $this->opciones('Correo Capacitador', false, null, null, 100));
			$this->usuariosholos->addColumn('CORREO_PERSONAL', 'string', $this->opciones('Correo Colaborador', false, null, null, 100));
			$this->usuariosholos->addColumn('FECHA_MODIFICACION', 'date', $this->opciones('Modificacion Datos', false, null, null, null));
			$this->usuariosholos->addColumn('FECHA_NACIMIENTO', 'date', $this->opciones('Nacimiento Colaborador', false, null, null, null));
			$this->usuariosholos->addColumn('OFICINA', 'string', $this->opciones('Oficina', false, null, null, 100));
			$this->usuariosholos->addColumn('OFICINA_DIMENSIONAMIENTO', 'string', $this->opciones('Oficina Dimensionamiento', false, null, null, 100));
			$this->usuariosholos->addColumn('EPS', 'string', $this->opciones('EPS', false, null, null, 100));
			$this->usuariosholos->addColumn('ARP', 'string', $this->opciones('ARP', false, null, null, 100));
			$this->usuariosholos->addColumn('AFC', 'string', $this->opciones('AFC', false, null, null, 100));
			$this->usuariosholos->addColumn('TELEFONO_FIJO', 'bigint', $this->opciones('No Fijo', false, null, null, 20));			
			$this->usuariosholos->addColumn('TELEFONO_MOVIL', 'bigint', $this->opciones('No Movil', false, null, null, 20));
			$this->usuariosholos->addColumn('LOGIN', 'integer', $this->opciones('ID Login', false, null, null, null));
			$this->usuariosholos->addColumn('SKILL1', 'integer', $this->opciones('Skill Nivel1', false, null, null, null));
			$this->usuariosholos->addColumn('SKILL2', 'integer', $this->opciones('Skill Nivel2', false, null, null, null));
			$this->usuariosholos->addColumn('SKILL3', 'integer', $this->opciones('Skill Nivel3', false, null, null, null));
			$this->usuariosholos->addColumn('CONTRATO', 'string', $this->opciones('Contrato', false, null, null, 100));
			$this->usuariosholos->addColumn('ESTADO_CIVIL', 'string', $this->opciones('Estado Civil', false, null, null, 100));
			$this->usuariosholos->addColumn('DIRECCION', 'string', $this->opciones('Direccion Colaborador', false, null, null, 100));
			$this->usuariosholos->addColumn('ESTUDIOS', 'string', $this->opciones('Estudios', false, null, null, 100));
			$this->usuariosholos->addColumn('HOBBIE', 'string', $this->opciones('Hobbie', false, null, null, 100));
			$this->usuariosholos->addColumn('N_HIJOS', 'integer', $this->opciones('No Hijos', false, null, null, null));
			$this->usuariosholos->addColumn('NIVEL_ESTUDIOS', 'string', $this->opciones('Nivel de Estudios', false, null, null, 100));
			$this->usuariosholos->addColumn('TALLA', 'string', $this->opciones('Talla Colaborador', false, null, null, 100));
			$this->usuariosholos->addColumn('NACIONALIDAD', 'string', $this->opciones('Nacionalidad', false, null, null, 100));
			$this->usuariosholos->addColumn('PERSONAS_CARGO', 'integer', $this->opciones('Personas a Cargo', false, null, null, null));
			$this->usuariosholos->addColumn('PERFIL_AGENDAMIETNO', 'string', $this->opciones('Perfil Agendamiemnto', false, null, null, 100));
			$this->usuariosholos->addColumn('PERFIL_GERENCIA', 'string', $this->opciones('Perfil Gerencia', false, null, null, 100));
			$this->usuariosholos->addColumn('PERFIL_RR', 'string', $this->opciones('', false, null, null, 100));
			$this->usuariosholos->addColumn('USUARIO_GERENCIA', 'string', $this->opciones('Perfil RR', false, null, null, 100));
			$this->usuariosholos->addColumn('USUARIO_AGENDAMIENTO', 'string', $this->opciones('Usuario Agendamiento', false, null, null, 100));
			$this->usuariosholos->addColumn('USUARIO_RR', 'string', $this->opciones('Usuario RR', false, null, null, 100));
			$this->usuariosholos->addColumn('USUARIO_COM', 'string', $this->opciones('Usuario Com Vir', false, null, null, 100));
			$this->usuariosholos->addColumn('USUARIO_DIAGNOSTICADOR', 'string', $this->opciones('Usuario Diagnosticador', false, null, null, 100));
			$this->usuariosholos->addColumn('USUARIO_CHECKNOTEC', 'string', $this->opciones('Usuario Check No Tecnico', false, null, null, 100));
			$this->usuariosholos->addColumn('USUARIO_INTRAWAY', 'string', $this->opciones('Usuario Intraway', false, null, null, 100));
			$this->usuariosholos->addColumn('JEFE_INMEDIATO', 'string', $this->opciones('Nombre Jefe', false, null, null, 100));
			$this->usuariosholos->addColumn('JEFE_INMEDIATO_TELMEX', 'string', $this->opciones('Nombre Jefe Telmex', false, null, null, 100));
			$this->usuariosholos->setPrimaryKey(array('ID'));
		
		// creación TaBLas_PROYECTOS
			$this->proyectos = $this->esquema->createTable('TBL_MEJORAMIENTO_PRI_PROYECTOS');
			$this->proyectos->addColumn('ID', 'bigint', $this->opciones('ID del Proyecto', true, null, true, 20));
			$this->proyectos->addColumn('NOMBRE', 'string', $this->opciones('Nombre del Proyecto', true, null, null, 255));
			$this->proyectos->addColumn('FECHA', 'datetime', $this->opciones('Fecha Creacion', true, null, null, null));
			$this->proyectos->addColumn('FECHA_INICIO', 'datetime', $this->opciones('Inicio Proyecto', false, null, null, null));
			$this->proyectos->addColumn('FECHA_FIN', 'datetime', $this->opciones('Fin Proyecto', false, null, null, null));
			$this->proyectos->addColumn('DESCRIPCION', 'text', $this->opciones('Descripcion Basica', true, null, null, null));
			$this->proyectos->addColumn('TIPO', 'string', $this->opciones('Tipo Proyecto', true, null, null, 255));
			$this->proyectos->addColumn('HORAS', 'integer', $this->opciones('Horas', true, null, null, null));
			$this->proyectos->addColumn('USUARIO_APERTURA', 'bigint', $this->opciones('Usuario as Proyecto', true, null, null, 20));
			$this->proyectos->addColumn('USUARIO_CIERRE', 'bigint', $this->opciones('Usuario ds Proyecto', false, null, null, 20));
			$this->proyectos->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->proyectos->addForeignKeyConstraint($this->usuarios, array('USUARIO_APERTURA'), array('ID'), $this->opcForeign);
			$this->proyectos->addForeignKeyConstraint($this->usuarios, array('USUARIO_CIERRE'), array('ID'), $this->opcForeign);
			$this->proyectos->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->proyectos->setPrimaryKey(array('ID'));
			//
			$this->proyectosobjetivos = $this->esquema->createTable('TBL_MEJORAMIENTO_SEC_PROYECTOS_OBJETIVOS');
			$this->proyectosobjetivos->addColumn('ID', 'bigint', $this->opciones('ID del Proyecto', true, null, true, 20));
			$this->proyectosobjetivos->addColumn('PROYECTO', 'bigint', $this->opciones('ID Proyecto', true, null, null, 20));
			$this->proyectosobjetivos->addColumn('FECHA', 'datetime', $this->opciones('Fecha Objetivo', true, null, null, null));
			$this->proyectosobjetivos->addColumn('OBJETIVO', 'text', $this->opciones('Descripcion Objetivo', true, null, null, null));
			$this->proyectosobjetivos->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->proyectosobjetivos->addForeignKeyConstraint($this->proyectos, array('PROYECTO'), array('ID'), $this->opcForeign);
			$this->proyectosobjetivos->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->proyectosobjetivos->setPrimaryKey(array('ID'));
			//
			$this->proyectosasignado = $this->esquema->createTable('TBL_MEJORAMIENTO_SEC_PROYECTOS_USUARIO_ASIGNADO');
			$this->proyectosasignado->addColumn('ID', 'bigint', $this->opciones('ID Usuario Asigando', true, null, true, 20));
			$this->proyectosasignado->addColumn('OBJETIVO', 'bigint', $this->opciones('ID Objetivo', true, null, null, 20));
			$this->proyectosasignado->addColumn('USUARIO', 'bigint', $this->opciones('ID Usuario', true, null, null, 20));
			$this->proyectosasignado->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->proyectosasignado->addForeignKeyConstraint($this->proyectosobjetivos, array('OBJETIVO'), array('ID'), $this->opcForeign);
			$this->proyectosasignado->addForeignKeyConstraint($this->usuarios, array('USUARIO'), array('ID'), $this->opcForeign);
			$this->proyectosasignado->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->proyectosasignado->setPrimaryKey(array('ID'));
			//
			$this->proyectosfases = $this->esquema->createTable('TBL_MEJORAMIENTO_SEC_PROYECTOS_FASES');
			$this->proyectosfases->addColumn('ID', 'bigint', $this->opciones('ID de Fase', true, null, true, 20));
			$this->proyectosfases->addColumn('PROYECTO', 'bigint', $this->opciones('ID Proyecto', true, null, null, 20));
			$this->proyectosfases->addColumn('OBJETIVO', 'bigint', $this->opciones('ID Objetivos', true, null, null, 20));
			$this->proyectosfases->addColumn('USUARIO_ASIGNADO', 'bigint', $this->opciones('ID Usuario Asigando', true, null, null, 20));
			$this->proyectosfases->addColumn('FECHA_INICIO', 'datetime', $this->opciones('Inicio Fase', true, null, null, null));
			$this->proyectosfases->addColumn('FECHA_FIN', 'datetime', $this->opciones('Fin Fase', true, null, null, null));
			$this->proyectosfases->addColumn('COMENTARIO', 'text', $this->opciones('Comentario Fase', true, null, null, null));
			$this->proyectosfases->addColumn('HORAS', 'integer', $this->opciones('Horas Fase', true, null, null, null));
			$this->proyectosfases->addForeignKeyConstraint($this->proyectos, array('PROYECTO'), array('ID'), $this->opcForeign);
			$this->proyectosfases->addForeignKeyConstraint($this->proyectosobjetivos, array('OBJETIVO'), array('ID'), $this->opcForeign);
			$this->proyectosfases->addForeignKeyConstraint($this->proyectosasignado, array('USUARIO_ASIGNADO'), array('ID'), $this->opcForeign);
			$this->proyectosfases->setPrimaryKey(array('ID'));
			//
			$this->proyectosadjuntos = $this->esquema->createTable('TBL_MEJORAMIENTO_SEC_PROYECTOS_ADJUNTOS');
			$this->proyectosadjuntos->addColumn('ID', 'bigint', $this->opciones('ID Archivo', true, null, true, 20));
			$this->proyectosadjuntos->addColumn('ARCHIVO', 'string', $this->opciones('Nombre Original', true, null, null, 255));
			$this->proyectosadjuntos->addColumn('DOCUMENTO', 'string', $this->opciones('Nombre Codificado', true, null, null, 255));
			$this->proyectosadjuntos->addColumn('DESCRIPCION', 'text', $this->opciones('Descripcion del Documento', true, null, null, null));
			$this->proyectosadjuntos->addColumn('FASE', 'bigint', $this->opciones('ID Fase', true, null, null, 20));
			$this->proyectosadjuntos->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->proyectosadjuntos->addForeignKeyConstraint($this->proyectosfases, array('FASE'), array('ID'), $this->opcForeign);
			$this->proyectosadjuntos->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->proyectosadjuntos->setPrimaryKey(array('ID'));
			//
			$this->proyectosescenarios = $this->esquema->createTable('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_PROYECTOS');
			$this->proyectosescenarios->addColumn('ID', 'bigint', $this->opciones('ID Escenario', true, null, true, 20));
			$this->proyectosescenarios->addColumn('NOMBRE', 'string', $this->opciones('Nombre del Escenario LOG', true, null, null, 255));
			$this->proyectosescenarios->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->proyectosescenarios->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->proyectosescenarios->setPrimaryKey(array('ID'));
			//
			$this->proyectoslog = $this->esquema->createTable('TBL_MEJORAMIENTO_LOG_PROYECTOS');
			$this->proyectoslog->addColumn('ID', 'bigint', $this->opciones('ID del LOG', true, null, true, 20));
			$this->proyectoslog->addColumn('PROYECTO', 'bigint', $this->opciones('ID Proyecto', true, null, null, 20));
			$this->proyectoslog->addColumn('USUARIO', 'bigint', $this->opciones('ID Usuario', true, null, null, 20));
			$this->proyectoslog->addColumn('ESCENARIO', 'bigint', $this->opciones('ID Escenario', true, null, null, 20));
			$this->proyectoslog->addColumn('FECHA', 'datetime', $this->opciones('Fecha Log', true, null, null, null));
			$this->proyectoslog->addForeignKeyConstraint($this->proyectos, array('PROYECTO'), array('ID'), $this->opcForeign);
			$this->proyectoslog->addForeignKeyConstraint($this->usuarios, array('USUARIO'), array('ID'), $this->opcForeign);
			$this->proyectoslog->addForeignKeyConstraint($this->proyectosescenarios, array('ESCENARIO'), array('ID'), $this->opcForeign);
			$this->proyectoslog->setPrimaryKey(array('ID'));
			
		// creación TaBLas_FORMULARIOS
			//
			$this->formulariostipo = $this->esquema->createTable('TBL_FORMULARIOS_SEC_MOTIVO_TIPO');
			$this->formulariostipo->addColumn('ID', 'bigint', $this->opciones('ID Tipo', true, null, true, 20));
			$this->formulariostipo->addColumn('NOMBRE', 'string', $this->opciones('Nombre Tipo', true, null, null, 255));
			$this->formulariostipo->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->formulariostipo->addColumn('SERVICIO', 'bigint', $this->opciones('ID Servicio', true, null, null, 20));
			$this->formulariostipo->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->formulariostipo->addForeignKeyConstraint($this->servicios, array('SERVICIO'), array('ID'), $this->opcForeign);
			$this->formulariostipo->setPrimaryKey(array('ID'));
			//
			$this->formulariosrazon = $this->esquema->createTable('TBL_FORMULARIOS_SEC_MOTIVO_RAZON');
			$this->formulariosrazon->addColumn('ID', 'bigint', $this->opciones('ID Razon', true, null, true, 20));
			$this->formulariosrazon->addColumn('RAZON', 'string', $this->opciones('Razón', true, null, null, 255));
			$this->formulariosrazon->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->formulariosrazon->addColumn('TIPO', 'bigint', $this->opciones('ID Tipo', true, null, null, 20));
			$this->formulariosrazon->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->formulariosrazon->addForeignKeyConstraint($this->formulariostipo, array('TIPO'), array('ID'), $this->opcForeign);
			$this->formulariosrazon->setPrimaryKey(array('ID'));
			//
			$this->formularios = $this->esquema->createTable('TBL_FORMULARIOS_PRI_MOTIVO');
			$this->formularios->addColumn('ID', 'bigint', $this->opciones('ID Motivo', true, null, true, 20));
			$this->formularios->addColumn('TIPO', 'bigint', $this->opciones('ID Tipo', true, null, null, 20));
			$this->formularios->addColumn('CUENTA', 'bigint', $this->opciones('Cuenta Suscriptor', true, null, null, 20));
			$this->formularios->addColumn('RAZON', 'bigint', $this->opciones('ID Razon', true, null, null, 20));
			$this->formularios->addColumn('FECHA', 'datetime', $this->opciones('Fecha Formulario', true, null, null, null));
			$this->formularios->addColumn('REFERENCIA', 'string', $this->opciones('Referencia', false, null, null, 255));
			$this->formularios->addColumn('INFORMACION', 'text', $this->opciones('Referencia', false, null, null, null));
			$this->formularios->addForeignKeyConstraint($this->formulariostipo, array('TIPO'), array('ID'), $this->opcForeign);
			$this->formularios->addForeignKeyConstraint($this->formulariosrazon, array('RAZON'), array('ID'), $this->opcForeign);
			$this->formularios->setPrimaryKey(array('ID'));
			
		// creación TaBLas_mEJORAS
			$this->mejoras = $this->esquema->createTable('TBL_MEJORAMIENTO_PRI_MEJORAS');
			$this->mejoras->addColumn('ID', 'bigint', $this->opciones('ID Mejora', true, null, true, 20));
			$this->mejoras->addColumn('USUARIO', 'bigint', $this->opciones('ID Usuario', true, null, null, 20));
			$this->mejoras->addColumn('FECHA', 'datetime', $this->opciones('Fecha Solicitud', true, null, null, null));
			$this->mejoras->addColumn('HERRAMIENTA', 'string', $this->opciones('Herramienta Web', true, null, null, 255));
			$this->mejoras->addColumn('PRODUCTO', 'bigint', $this->opciones('ID Servicio', true, null, null, 20));
			$this->mejoras->addColumn('ARBOL', 'string', $this->opciones('Arbol Herramienta', true, null, null, 255));
			$this->mejoras->addColumn('TITULO', 'string', $this->opciones('Titulo Mejora', true, null, null, 255));
			$this->mejoras->addColumn('DESCRIPCION', 'text', $this->opciones('Descripcion Mejora', true, null, null, null));
			$this->mejoras->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->mejoras->addForeignKeyConstraint($this->usuarios, array('USUARIO'), array('ID'), $this->opcForeign);
			$this->mejoras->addForeignKeyConstraint($this->servicios, array('PRODUCTO'), array('ID'), $this->opcForeign);
			$this->mejoras->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->mejoras->setPrimaryKey(array('ID'));
			//
			$this->mejorasobjetivos = $this->esquema->createTable('TBL_MEJORAMIENTO_SEC_MEJORAS_OBJETIVOS');
			$this->mejorasobjetivos->addColumn('ID', 'bigint', $this->opciones('ID Objetivo', true, null, true, 20));
			$this->mejorasobjetivos->addColumn('MEJORA', 'bigint', $this->opciones('ID Mejora', true, null, null, 20));
			$this->mejorasobjetivos->addColumn('FECHA_OBJETIVO', 'datetime', $this->opciones('Fecha Inicial', true, null, null, null));
			$this->mejorasobjetivos->addColumn('OBJETIVO', 'text', $this->opciones('Objetivo de la Mejora', true, null, null, null));
			$this->mejorasobjetivos->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->mejorasobjetivos->addForeignKeyConstraint($this->mejoras, array('MEJORA'), array('ID'), $this->opcForeign);
			$this->mejorasobjetivos->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->mejorasobjetivos->setPrimaryKey(array('ID'));
			//
			$this->mejorasadjuntos = $this->esquema->createTable('TBL_MEJORAMIENTO_SEC_MEJORAS_ADJUNTOS');
			$this->mejorasadjuntos->addColumn('ID', 'bigint', $this->opciones('ID Archivo', true, null, true, 20));
			$this->mejorasadjuntos->addColumn('ARCHIVO', 'string', $this->opciones('Nombre Original', true, null, null, 255));
			$this->mejorasadjuntos->addColumn('DOCUMENTO', 'string', $this->opciones('Nombre Codificado', true, null, null, 255));
			$this->mejorasadjuntos->addColumn('FECHA', 'datetime', $this->opciones('Fecha Adjunto', true, null, null, null));
			$this->mejorasadjuntos->addColumn('MEJORA', 'bigint', $this->opciones('ID Mejora', true, null, null, 20));
			$this->mejorasadjuntos->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->mejorasadjuntos->addForeignKeyConstraint($this->mejoras, array('MEJORA'), array('ID'), $this->opcForeign);
			$this->mejorasadjuntos->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->mejorasadjuntos->setPrimaryKey(array('ID'));
			//
			$this->mejorasrutas = $this->esquema->createTable('TBL_MEJORAMIENTO_SEC_MEJORAS_RUTAS');
			$this->mejorasrutas->addColumn('ID', 'bigint', $this->opciones('ID Ruta', true, null, true, 20));
			$this->mejorasrutas->addColumn('DESCRIPCION', 'text', $this->opciones('Descripcion Ruta', true, null, null, null));
			$this->mejorasrutas->addColumn('PROCESO', 'string', $this->opciones('Seleccion Ruta', true, null, null, 255));
			$this->mejorasrutas->addColumn('MEJORA', 'bigint', $this->opciones('Mejora', true, null, null, 20));
			$this->mejorasrutas->addForeignKeyConstraint($this->mejoras, array('MEJORA'), array('ID'), $this->opcForeign);
			$this->mejorasrutas->setPrimaryKey(array('ID'));
			//
			$this->mejorasnotas = $this->esquema->createTable('TBL_MEJORAMIENTO_SEC_MEJORAS_NOTAS');
			$this->mejorasnotas->addColumn('ID', 'bigint', $this->opciones('ID Nota', true, null, true, 20));
			$this->mejorasnotas->addColumn('OBJETIVO', 'bigint', $this->opciones('ID Objetivo', true, null, null, 20));
			$this->mejorasnotas->addColumn('USUARIO', 'bigint', $this->opciones('ID Usuario', true, null, null, 20));
			$this->mejorasnotas->addColumn('NOTA', 'text', $this->opciones('Nota a Gestion', true, null, null, null));
			$this->mejorasnotas->addColumn('FECHA', 'datetime', $this->opciones('Fecha Nota', true, null, null, null));
			$this->mejorasnotas->addForeignKeyConstraint($this->mejorasobjetivos, array('OBJETIVO'), array('ID'), $this->opcForeign);
			$this->mejorasnotas->addForeignKeyConstraint($this->usuarios, array('USUARIO'), array('ID'), $this->opcForeign);
			$this->mejorasnotas->setPrimaryKey(array('ID'));
			//
			$this->mejorasescenarios = $this->esquema->createTable('TBL_MEJORAMIENTO_SELECT_ESCENARIOS_MEJORAS');
			$this->mejorasescenarios->addColumn('ID', 'bigint', $this->opciones('ID Mejora', true, null, true, 20));
			$this->mejorasescenarios->addColumn('NOMBRE', 'string', $this->opciones('Nombre de Mejora LOG', true, null, null, 255));
			$this->mejorasescenarios->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->mejorasescenarios->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->mejorasescenarios->setPrimaryKey(array('ID'));
			//
			$this->mejoraslog = $this->esquema->createTable('TBL_MEJORAMIENTO_LOG_MEJORAS');
			$this->mejoraslog->addColumn('ID', 'bigint', $this->opciones('ID del LOG', true, null, true, 20));
			$this->mejoraslog->addColumn('MEJORA', 'bigint', $this->opciones('ID Mejora', true, null, null, 20));
			$this->mejoraslog->addColumn('USUARIO', 'bigint', $this->opciones('ID Usuario', true, null, null, 20));
			$this->mejoraslog->addColumn('ESCENARIO', 'bigint', $this->opciones('ID Escenario', true, null, null, 20));
			$this->mejoraslog->addColumn('FECHA', 'datetime', $this->opciones('Fecha Log', true, null, null, null));
			$this->mejoraslog->addForeignKeyConstraint($this->mejoras, array('MEJORA'), array('ID'), $this->opcForeign);
			$this->mejoraslog->addForeignKeyConstraint($this->usuarios, array('USUARIO'), array('ID'), $this->opcForeign);
			$this->mejoraslog->addForeignKeyConstraint($this->mejorasescenarios, array('ESCENARIO'), array('ID'), $this->opcForeign);
			$this->mejoraslog->setPrimaryKey(array('ID'));
			
		// creación TaBLas_ServiceCo Comunicacion
			$this->servicecotipo = $this->esquema->createTable('TBL_SERVICECO_SEC_ALTOIMPACTO_TIPO');
		 	$this->servicecotipo->addColumn('ID', 'bigint', $this->opciones('ID Tipo', true, null, true, 20));
			$this->servicecotipo->addColumn('NOMBRE', 'string', $this->opciones('Nombre Tipo', true, null, null, 255));
			$this->servicecotipo->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->servicecotipo->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
		 	$this->servicecotipo->setPrimaryKey(array('ID'));
		 	//
		 	$this->servicecodetalle = $this->esquema->createTable('TBL_SERVICECO_SEC_ALTOIMPACTO_DETALLE');
		 	$this->servicecodetalle->addColumn('ID', 'bigint', $this->opciones('ID Tipo', true, null, true, 20));
			$this->servicecodetalle->addColumn('NOMBRE', 'string', $this->opciones('Nombre Detalle', true, null, null, 255));
			$this->servicecodetalle->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->servicecodetalle->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
		 	$this->servicecodetalle->setPrimaryKey(array('ID'));
		 	//
			$this->serviceco = $this->esquema->createTable('TBL_SERVICECO_PRI_ALTOIMPACTO');
			$this->serviceco->addColumn('ID', 'bigint', $this->opciones('ID del Reporte', true, null, true, 20));
			$this->serviceco->addColumn('FECHA', 'datetime', $this->opciones('Fecha Reporte', true, null, null, null));
			$this->serviceco->addColumn('USUARIO', 'bigint', $this->opciones('ID Usuario', true, null, null, 20));
			$this->serviceco->addColumn('AVISO', 'string', $this->opciones('Aviso Reportado', true, null, null, 255));
			$this->serviceco->addColumn('TIPO', 'bigint', $this->opciones('ID Tipo', true, null, null, 20));
			$this->serviceco->addColumn('DETALLE', 'bigint', $this->opciones('ID Detalle', true, null, null, 20));
			$this->serviceco->addColumn('SINTOMA', 'string', $this->opciones('Sintoma Reporte', true, null, null, 255));
			$this->serviceco->addColumn('AFECTACION', 'string', $this->opciones('Afectacion Reporte', true, null, null, 255));
			$this->serviceco->addColumn('ESTADO', 'bigint', $this->opciones('ID Estado', true, null, null, 20));
			$this->serviceco->addForeignKeyConstraint($this->usuarios, array('USUARIO'), array('ID'), $this->opcForeign);
			$this->serviceco->addForeignKeyConstraint($this->estados, array('ESTADO'), array('ID'), $this->opcForeign);
			$this->serviceco->addForeignKeyConstraint($this->servicecotipo, array('TIPO'), array('ID'), $this->opcForeign);
			$this->serviceco->addForeignKeyConstraint($this->servicecodetalle, array('DETALLE'), array('ID'), $this->opcForeign);
			$this->serviceco->setPrimaryKey(array('ID'));
			//
			$this->servicecolog = $this->esquema->createTable('TBL_SERVICECO_LOG_ALTOIMPACTO');
			$this->servicecolog->addColumn('ID', 'bigint', $this->opciones('ID del LOG', true, null, true, 20));
			$this->servicecolog->addColumn('FECHA', 'datetime', $this->opciones('Fecha Log', true, null, null, null));
			$this->servicecolog->addColumn('USUARIO', 'bigint', $this->opciones('ID Usuario', true, null, null, 20));
			$this->servicecolog->addColumn('PROCEDIMIENTO', 'string', $this->opciones('Tipo Procedimiento', true, null, null, 255));
			$this->servicecolog->addColumn('AVISO', 'string', $this->opciones('Aviso Reportado', true, null, null, 255));
			$this->servicecolog->addColumn('DESCRIPCION', 'text', $this->opciones('Descripcion Log', true, null, null, null));
			$this->servicecolog->addForeignKeyConstraint($this->usuarios, array('USUARIO'), array('ID'), $this->opcForeign);
			$this->servicecolog->setPrimaryKey(array('ID'));
			//
			
		}		
		
		/**
		 * SQL::opciones()
		 * 
		 * listado de opciones
		 * @param mixed $comment
		 * @param bool $notnull
		 * @param mixed $default
		 * @param mixed $autoincrement
		 * @param mixed $length
		 * @param mixed $unique
		 * @return void
		 */
		private function opciones($comment, $notnull = true, $default = null, $autoincrement = null, $length = null, $unique = null) {
			$param['comment'] = $comment;
			$param['notnull'] = $notnull;
			$param['default'] = $default;
			$param['length'] = $length;
			
			if(is_bool($autoincrement) == true):
				$param['autoincrement'] = $autoincrement;
			endif;
			
			if(is_bool($unique) == true):
				$param['customSchemaOptions'] = array('unique' => $unique);
			endif;
			
			return $param;
		}
	}	