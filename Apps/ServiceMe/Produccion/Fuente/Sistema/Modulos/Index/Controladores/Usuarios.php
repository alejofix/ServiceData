<?php

			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => '', 
				'PASSWORD' => sha1(''), 
				'NOMBRE_INICIAL' => '',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => '',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 1, 
				'FECHA_NACIMIENTO' => '2015-01-02', 
				'FECHA_EXPEDICION' =>  '2015-01-02', 
				//'FIJO' => '0', 
				//'MOVIL' => '0', 
				'GENERO' => 'X', 
				'CORREO' => '@', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));

			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'XIMLOZANO', 
				'PASSWORD' => sha1('1015417037'), 
				'NOMBRE_INICIAL' => 'XIMENA',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'LOZANO',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 1015417037, 
				'FECHA_NACIMIENTO' => '1990-04-06', 
				'FECHA_EXPEDICION' =>  '2008-04-15', 
				//'FIJO' => '0', 
				'MOVIL' => '3143467760', 
				'GENERO' => 'F', 
				'CORREO' => 'XIMENA.LOZANO@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'COTALVAROV', 
				'PASSWORD' => sha1('80863565'), 
				'NOMBRE_INICIAL' => 'CARLOS',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'OTALVARO',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 80863565, 
				'FECHA_NACIMIENTO' => '1985-03-15', 
				'FECHA_EXPEDICION' =>  '2003-03-19', 
				//'FIJO' => '0', 
				'MOVIL' => '3002113142', 
				'GENERO' => 'M', 
				'CORREO' => 'CARLOS.OTALVARO@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'LEROBLES1', 
				'PASSWORD' => sha1('73183702'), 
				'NOMBRE_INICIAL' => 'LIBARDO',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'ROBLES',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 73183702, 
				'FECHA_NACIMIENTO' => '1981-07-15', 
				'FECHA_EXPEDICION' =>  '1999-11-09', 
				//'FIJO' => '0', 
				'MOVIL' => '3185073103', 
				'GENERO' => 'M', 
				'CORREO' => 'LIBARDO.ROBLES@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'AJIMENJEZZ', 
				'PASSWORD' => sha1('1102796315'), 
				'NOMBRE_INICIAL' => 'ADRIANA',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'JIMENEZ',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 1102796315, 
				'FECHA_NACIMIENTO' => '1984-12-24', 
				'FECHA_EXPEDICION' =>  '2004-03-03', 
				//'FIJO' => '0', 
				'MOVIL' => '3116787101', 
				'GENERO' => 'F', 
				'CORREO' => 'ADRIANA.JIMENEZ@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'SMVARGAS', 
				'PASSWORD' => sha1('1072639923'), 
				'NOMBRE_INICIAL' => 'SANDRA',
				'NOMBRE_FINAL' => 'MILENA',  
				'APELLIDO_INICIAL' => 'VARGAS',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 1072639923, 
				'FECHA_NACIMIENTO' => '1986-03-25', 
				'FECHA_EXPEDICION' =>  '2004-04-22', 
				//'FIJO' => '0', 
				'MOVIL' => '3222508129', 
				'GENERO' => 'F', 
				'CORREO' => 'SANDRA.VARGAS.P@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'CRIVESGA', 
				'PASSWORD' => sha1('1013633288'), 
				'NOMBRE_INICIAL' => 'CRISTIAN',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'VESGA',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 1013633288, 
				'FECHA_NACIMIENTO' => '2015-01-02', 
				'FECHA_EXPEDICION' =>  '2015-01-02', 
				//'FIJO' => '0', 
				'MOVIL' => '3213358868', 
				'GENERO' => 'M', 
				'CORREO' => 'CRISTIAN.VESGA@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'APMARTINEZ', 
				'PASSWORD' => sha1('53132888'), 
				'NOMBRE_INICIAL' => 'ANDREA',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'MARTINEZ',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 53132888, 
				'FECHA_NACIMIENTO' => '1985-02-16', 
				'FECHA_EXPEDICION' =>  '2003-03-11', 
				//'FIJO' => '0', 
				'MOVIL' => '3014399580', 
				'GENERO' => 'F', 
				'CORREO' => 'ANDREA.MARTINEZ@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 4, 'ESTADO' => 1, 'PERMISO' => 5,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'JHOLLORI', 
				'PASSWORD' => sha1('1030589182'), 
				'NOMBRE_INICIAL' => 'JHONATAN',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'LLORI',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 1030589182, 
				'FECHA_NACIMIENTO' => '1991-03-20', 
				'FECHA_EXPEDICION' =>  '2009-03-31', 
				//'FIJO' => '0', 
				'MOVIL' => '3213856866', 
				'GENERO' => 'M', 
				'CORREO' => 'JHONATAN.LLORI@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'CRISCASTIL', 
				'PASSWORD' => sha1('1016024236'), 
				'NOMBRE_INICIAL' => 'CRISTIAN',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'CASTILLO',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 1016024236, 
				'FECHA_NACIMIENTO' => '1990-02-15', 
				'FECHA_EXPEDICION' =>  '2008-02-15', 
				//'FIJO' => '0', 
				'MOVIL' => '3212647184', 
				'GENERO' => 'M', 
				'CORREO' => 'CRISTIAN.CASTILLO@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'HVECINO', 
				'PASSWORD' => sha1('80156062'), 
				'NOMBRE_INICIAL' => 'HECTOR',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'VECINO',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 80156062, 
				'FECHA_NACIMIENTO' => '1981-06-14', 
				'FECHA_EXPEDICION' =>  '1999-09-10', 
				//'FIJO' => '0', 
				'MOVIL' => '3133035039', 
				'GENERO' => 'M', 
				'CORREO' => 'HECTOR.VECINO@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'YFPENAC', 
				'PASSWORD' => sha1('80186833'), 
				'NOMBRE_INICIAL' => 'YEISON',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'PEÑA',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 80186833, 
				'FECHA_NACIMIENTO' => '1983-07-08', 
				'FECHA_EXPEDICION' =>  '2001-07-10', 
				//'FIJO' => '0', 
				'MOVIL' => '3114479681', 
				'GENERO' => 'M', 
				'CORREO' => 'YEISON.PENA@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));
			$this->conexion->insert('TBL_USUARIOS', array(
				'USUARIO' => 'IVGARCIA', 
				'PASSWORD' => sha1('80747997'), 
				'NOMBRE_INICIAL' => 'IVAN',
				//'NOMBRE_FINAL' => '',  
				'APELLIDO_INICIAL' => 'GENARO',
				//'APELLIDO_FINAL' => '', 
				'DOCUMENTO' => 80747997, 
				'FECHA_NACIMIENTO' => '2015-01-02', 
				'FECHA_EXPEDICION' =>  '2015-01-02', 
				//'FIJO' => '0', 
				'MOVIL' => '3115115334', 
				'GENERO' => 'M', 
				'CORREO' => 'IVAN.GARCIA@CLARO.COM.CO', 
				'EMPRESA' => 1,'CARGO' => 3, 'ESTADO' => 1, 'PERMISO' => 2,
			));