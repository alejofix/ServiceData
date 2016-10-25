<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblUsuariosSecRadiografia
 *
 * @Table(name="tbl_usuarios_sec_radiografia")
 * @Entity
 */
class TblUsuariosSecRadiografia
{
    /**
     * @var integer
     *
     * @Column(name="ID", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA_INGRESO", type="date", nullable=true)
     */
    private $fechaIngreso;

    /**
     * @var string
     *
     * @Column(name="TIPO_IDENTIFICACION", type="string", length=100, nullable=true)
     */
    private $tipoIdentificacion;

    /**
     * @var string
     *
     * @Column(name="NUMERO_DOCUMENTO", type="string", length=100, nullable=true)
     */
    private $numeroDocumento;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA_EXPEDICION", type="date", nullable=true)
     */
    private $fechaExpedicion;

    /**
     * @var string
     *
     * @Column(name="CIUDAD_EXPEDICION", type="string", length=100, nullable=true)
     */
    private $ciudadExpedicion;

    /**
     * @var string
     *
     * @Column(name="NOMBRE_INICIAL", type="string", length=100, nullable=true)
     */
    private $nombreInicial;

    /**
     * @var string
     *
     * @Column(name="NOMBRE_FINAL", type="string", length=100, nullable=true)
     */
    private $nombreFinal;

    /**
     * @var string
     *
     * @Column(name="APELLIDO_INICIAL", type="string", length=100, nullable=true)
     */
    private $apellidoInicial;

    /**
     * @var string
     *
     * @Column(name="APELLIDO_FINAL", type="string", length=100, nullable=true)
     */
    private $apellidoFinal;

    /**
     * @var string
     *
     * @Column(name="ALIADO", type="string", length=100, nullable=true)
     */
    private $aliado;

    /**
     * @var string
     *
     * @Column(name="CANAL", type="string", length=100, nullable=true)
     */
    private $canal;

    /**
     * @var string
     *
     * @Column(name="OPERACION", type="string", length=100, nullable=true)
     */
    private $operacion;

    /**
     * @var string
     *
     * @Column(name="TIPO_LINEA", type="string", length=100, nullable=true)
     */
    private $tipoLinea;

    /**
     * @var string
     *
     * @Column(name="GENERO", type="string", length=100, nullable=true)
     */
    private $genero;

    /**
     * @var string
     *
     * @Column(name="FAMILIAR_CLARO", type="string", length=100, nullable=true)
     */
    private $familiarClaro;

    /**
     * @var string
     *
     * @Column(name="CARGO_FAMILIAR", type="string", length=100, nullable=true)
     */
    private $cargoFamiliar;

    /**
     * @var string
     *
     * @Column(name="GRUPO", type="string", length=100, nullable=true)
     */
    private $grupo;

    /**
     * @var string
     *
     * @Column(name="CARGO_COLABORADOR", type="string", length=100, nullable=true)
     */
    private $cargoColaborador;

    /**
     * @var string
     *
     * @Column(name="ESTADO", type="string", length=100, nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @Column(name="MOVIL", type="string", length=100, nullable=true)
     */
    private $movil;

    /**
     * @var string
     *
     * @Column(name="FIJO", type="string", length=100, nullable=true)
     */
    private $fijo;

    /**
     * @var string
     *
     * @Column(name="CAPACITADOR", type="string", length=100, nullable=true)
     */
    private $capacitador;

    /**
     * @var string
     *
     * @Column(name="CORREO_CAPACITADOR", type="string", length=100, nullable=true)
     */
    private $correoCapacitador;

    /**
     * @var string
     *
     * @Column(name="CORREO_PERSONAL", type="string", length=100, nullable=true)
     */
    private $correoPersonal;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA_MODIFICACION", type="date", nullable=true)
     */
    private $fechaModificacion;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA_NACIMIENTO", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @Column(name="OFICINA", type="string", length=100, nullable=true)
     */
    private $oficina;

    /**
     * @var string
     *
     * @Column(name="OFICINA_DIMENSIONAMIENTO", type="string", length=100, nullable=true)
     */
    private $oficinaDimensionamiento;

    /**
     * @var string
     *
     * @Column(name="EPS", type="string", length=100, nullable=true)
     */
    private $eps;

    /**
     * @var string
     *
     * @Column(name="ARP", type="string", length=100, nullable=true)
     */
    private $arp;

    /**
     * @var string
     *
     * @Column(name="AFC", type="string", length=100, nullable=true)
     */
    private $afc;

    /**
     * @var integer
     *
     * @Column(name="TELEFONO_FIJO", type="bigint", nullable=true)
     */
    private $telefonoFijo;

    /**
     * @var integer
     *
     * @Column(name="TELEFONO_MOVIL", type="bigint", nullable=true)
     */
    private $telefonoMovil;

    /**
     * @var integer
     *
     * @Column(name="LOGIN", type="integer", nullable=true)
     */
    private $login;

    /**
     * @var integer
     *
     * @Column(name="SKILL1", type="integer", nullable=true)
     */
    private $skill1;

    /**
     * @var integer
     *
     * @Column(name="SKILL2", type="integer", nullable=true)
     */
    private $skill2;

    /**
     * @var integer
     *
     * @Column(name="SKILL3", type="integer", nullable=true)
     */
    private $skill3;

    /**
     * @var string
     *
     * @Column(name="CONTRATO", type="string", length=100, nullable=true)
     */
    private $contrato;

    /**
     * @var string
     *
     * @Column(name="ESTADO_CIVIL", type="string", length=100, nullable=true)
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @Column(name="DIRECCION", type="string", length=100, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @Column(name="ESTUDIOS", type="string", length=100, nullable=true)
     */
    private $estudios;

    /**
     * @var string
     *
     * @Column(name="HOBBIE", type="string", length=100, nullable=true)
     */
    private $hobbie;

    /**
     * @var integer
     *
     * @Column(name="N_HIJOS", type="integer", nullable=true)
     */
    private $nHijos;

    /**
     * @var string
     *
     * @Column(name="NIVEL_ESTUDIOS", type="string", length=100, nullable=true)
     */
    private $nivelEstudios;

    /**
     * @var string
     *
     * @Column(name="TALLA", type="string", length=100, nullable=true)
     */
    private $talla;

    /**
     * @var string
     *
     * @Column(name="NACIONALIDAD", type="string", length=100, nullable=true)
     */
    private $nacionalidad;

    /**
     * @var integer
     *
     * @Column(name="PERSONAS_CARGO", type="integer", nullable=true)
     */
    private $personasCargo;

    /**
     * @var string
     *
     * @Column(name="PERFIL_AGENDAMIETNO", type="string", length=100, nullable=true)
     */
    private $perfilAgendamietno;

    /**
     * @var string
     *
     * @Column(name="PERFIL_GERENCIA", type="string", length=100, nullable=true)
     */
    private $perfilGerencia;

    /**
     * @var string
     *
     * @Column(name="PERFIL_RR", type="string", length=100, nullable=true)
     */
    private $perfilRr;

    /**
     * @var string
     *
     * @Column(name="USUARIO_GERENCIA", type="string", length=100, nullable=true)
     */
    private $usuarioGerencia;

    /**
     * @var string
     *
     * @Column(name="USUARIO_AGENDAMIENTO", type="string", length=100, nullable=true)
     */
    private $usuarioAgendamiento;

    /**
     * @var string
     *
     * @Column(name="USUARIO_RR", type="string", length=100, nullable=true)
     */
    private $usuarioRr;

    /**
     * @var string
     *
     * @Column(name="USUARIO_COM", type="string", length=100, nullable=true)
     */
    private $usuarioCom;

    /**
     * @var string
     *
     * @Column(name="USUARIO_DIAGNOSTICADOR", type="string", length=100, nullable=true)
     */
    private $usuarioDiagnosticador;

    /**
     * @var string
     *
     * @Column(name="USUARIO_CHECKNOTEC", type="string", length=100, nullable=true)
     */
    private $usuarioChecknotec;

    /**
     * @var string
     *
     * @Column(name="USUARIO_INTRAWAY", type="string", length=100, nullable=true)
     */
    private $usuarioIntraway;

    /**
     * @var string
     *
     * @Column(name="JEFE_INMEDIATO", type="string", length=100, nullable=true)
     */
    private $jefeInmediato;

    /**
     * @var string
     *
     * @Column(name="JEFE_INMEDIATO_TELMEX", type="string", length=100, nullable=true)
     */
    private $jefeInmediatoTelmex;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;
    
        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set tipoIdentificacion
     *
     * @param string $tipoIdentificacion
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setTipoIdentificacion($tipoIdentificacion)
    {
        $this->tipoIdentificacion = $tipoIdentificacion;
    
        return $this;
    }

    /**
     * Get tipoIdentificacion
     *
     * @return string
     */
    public function getTipoIdentificacion()
    {
        return $this->tipoIdentificacion;
    }

    /**
     * Set numeroDocumento
     *
     * @param string $numeroDocumento
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;
    
        return $this;
    }

    /**
     * Get numeroDocumento
     *
     * @return string
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Set fechaExpedicion
     *
     * @param \DateTime $fechaExpedicion
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setFechaExpedicion($fechaExpedicion)
    {
        $this->fechaExpedicion = $fechaExpedicion;
    
        return $this;
    }

    /**
     * Get fechaExpedicion
     *
     * @return \DateTime
     */
    public function getFechaExpedicion()
    {
        return $this->fechaExpedicion;
    }

    /**
     * Set ciudadExpedicion
     *
     * @param string $ciudadExpedicion
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setCiudadExpedicion($ciudadExpedicion)
    {
        $this->ciudadExpedicion = $ciudadExpedicion;
    
        return $this;
    }

    /**
     * Get ciudadExpedicion
     *
     * @return string
     */
    public function getCiudadExpedicion()
    {
        return $this->ciudadExpedicion;
    }

    /**
     * Set nombreInicial
     *
     * @param string $nombreInicial
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setNombreInicial($nombreInicial)
    {
        $this->nombreInicial = $nombreInicial;
    
        return $this;
    }

    /**
     * Get nombreInicial
     *
     * @return string
     */
    public function getNombreInicial()
    {
        return $this->nombreInicial;
    }

    /**
     * Set nombreFinal
     *
     * @param string $nombreFinal
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setNombreFinal($nombreFinal)
    {
        $this->nombreFinal = $nombreFinal;
    
        return $this;
    }

    /**
     * Get nombreFinal
     *
     * @return string
     */
    public function getNombreFinal()
    {
        return $this->nombreFinal;
    }

    /**
     * Set apellidoInicial
     *
     * @param string $apellidoInicial
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setApellidoInicial($apellidoInicial)
    {
        $this->apellidoInicial = $apellidoInicial;
    
        return $this;
    }

    /**
     * Get apellidoInicial
     *
     * @return string
     */
    public function getApellidoInicial()
    {
        return $this->apellidoInicial;
    }

    /**
     * Set apellidoFinal
     *
     * @param string $apellidoFinal
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setApellidoFinal($apellidoFinal)
    {
        $this->apellidoFinal = $apellidoFinal;
    
        return $this;
    }

    /**
     * Get apellidoFinal
     *
     * @return string
     */
    public function getApellidoFinal()
    {
        return $this->apellidoFinal;
    }

    /**
     * Set aliado
     *
     * @param string $aliado
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setAliado($aliado)
    {
        $this->aliado = $aliado;
    
        return $this;
    }

    /**
     * Get aliado
     *
     * @return string
     */
    public function getAliado()
    {
        return $this->aliado;
    }

    /**
     * Set canal
     *
     * @param string $canal
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setCanal($canal)
    {
        $this->canal = $canal;
    
        return $this;
    }

    /**
     * Get canal
     *
     * @return string
     */
    public function getCanal()
    {
        return $this->canal;
    }

    /**
     * Set operacion
     *
     * @param string $operacion
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setOperacion($operacion)
    {
        $this->operacion = $operacion;
    
        return $this;
    }

    /**
     * Get operacion
     *
     * @return string
     */
    public function getOperacion()
    {
        return $this->operacion;
    }

    /**
     * Set tipoLinea
     *
     * @param string $tipoLinea
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setTipoLinea($tipoLinea)
    {
        $this->tipoLinea = $tipoLinea;
    
        return $this;
    }

    /**
     * Get tipoLinea
     *
     * @return string
     */
    public function getTipoLinea()
    {
        return $this->tipoLinea;
    }

    /**
     * Set genero
     *
     * @param string $genero
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;
    
        return $this;
    }

    /**
     * Get genero
     *
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set familiarClaro
     *
     * @param string $familiarClaro
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setFamiliarClaro($familiarClaro)
    {
        $this->familiarClaro = $familiarClaro;
    
        return $this;
    }

    /**
     * Get familiarClaro
     *
     * @return string
     */
    public function getFamiliarClaro()
    {
        return $this->familiarClaro;
    }

    /**
     * Set cargoFamiliar
     *
     * @param string $cargoFamiliar
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setCargoFamiliar($cargoFamiliar)
    {
        $this->cargoFamiliar = $cargoFamiliar;
    
        return $this;
    }

    /**
     * Get cargoFamiliar
     *
     * @return string
     */
    public function getCargoFamiliar()
    {
        return $this->cargoFamiliar;
    }

    /**
     * Set grupo
     *
     * @param string $grupo
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;
    
        return $this;
    }

    /**
     * Get grupo
     *
     * @return string
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set cargoColaborador
     *
     * @param string $cargoColaborador
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setCargoColaborador($cargoColaborador)
    {
        $this->cargoColaborador = $cargoColaborador;
    
        return $this;
    }

    /**
     * Get cargoColaborador
     *
     * @return string
     */
    public function getCargoColaborador()
    {
        return $this->cargoColaborador;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set movil
     *
     * @param string $movil
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setMovil($movil)
    {
        $this->movil = $movil;
    
        return $this;
    }

    /**
     * Get movil
     *
     * @return string
     */
    public function getMovil()
    {
        return $this->movil;
    }

    /**
     * Set fijo
     *
     * @param string $fijo
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setFijo($fijo)
    {
        $this->fijo = $fijo;
    
        return $this;
    }

    /**
     * Get fijo
     *
     * @return string
     */
    public function getFijo()
    {
        return $this->fijo;
    }

    /**
     * Set capacitador
     *
     * @param string $capacitador
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setCapacitador($capacitador)
    {
        $this->capacitador = $capacitador;
    
        return $this;
    }

    /**
     * Get capacitador
     *
     * @return string
     */
    public function getCapacitador()
    {
        return $this->capacitador;
    }

    /**
     * Set correoCapacitador
     *
     * @param string $correoCapacitador
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setCorreoCapacitador($correoCapacitador)
    {
        $this->correoCapacitador = $correoCapacitador;
    
        return $this;
    }

    /**
     * Get correoCapacitador
     *
     * @return string
     */
    public function getCorreoCapacitador()
    {
        return $this->correoCapacitador;
    }

    /**
     * Set correoPersonal
     *
     * @param string $correoPersonal
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setCorreoPersonal($correoPersonal)
    {
        $this->correoPersonal = $correoPersonal;
    
        return $this;
    }

    /**
     * Get correoPersonal
     *
     * @return string
     */
    public function getCorreoPersonal()
    {
        return $this->correoPersonal;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    
        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    
        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set oficina
     *
     * @param string $oficina
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setOficina($oficina)
    {
        $this->oficina = $oficina;
    
        return $this;
    }

    /**
     * Get oficina
     *
     * @return string
     */
    public function getOficina()
    {
        return $this->oficina;
    }

    /**
     * Set oficinaDimensionamiento
     *
     * @param string $oficinaDimensionamiento
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setOficinaDimensionamiento($oficinaDimensionamiento)
    {
        $this->oficinaDimensionamiento = $oficinaDimensionamiento;
    
        return $this;
    }

    /**
     * Get oficinaDimensionamiento
     *
     * @return string
     */
    public function getOficinaDimensionamiento()
    {
        return $this->oficinaDimensionamiento;
    }

    /**
     * Set eps
     *
     * @param string $eps
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setEps($eps)
    {
        $this->eps = $eps;
    
        return $this;
    }

    /**
     * Get eps
     *
     * @return string
     */
    public function getEps()
    {
        return $this->eps;
    }

    /**
     * Set arp
     *
     * @param string $arp
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setArp($arp)
    {
        $this->arp = $arp;
    
        return $this;
    }

    /**
     * Get arp
     *
     * @return string
     */
    public function getArp()
    {
        return $this->arp;
    }

    /**
     * Set afc
     *
     * @param string $afc
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setAfc($afc)
    {
        $this->afc = $afc;
    
        return $this;
    }

    /**
     * Get afc
     *
     * @return string
     */
    public function getAfc()
    {
        return $this->afc;
    }

    /**
     * Set telefonoFijo
     *
     * @param integer $telefonoFijo
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setTelefonoFijo($telefonoFijo)
    {
        $this->telefonoFijo = $telefonoFijo;
    
        return $this;
    }

    /**
     * Get telefonoFijo
     *
     * @return integer
     */
    public function getTelefonoFijo()
    {
        return $this->telefonoFijo;
    }

    /**
     * Set telefonoMovil
     *
     * @param integer $telefonoMovil
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setTelefonoMovil($telefonoMovil)
    {
        $this->telefonoMovil = $telefonoMovil;
    
        return $this;
    }

    /**
     * Get telefonoMovil
     *
     * @return integer
     */
    public function getTelefonoMovil()
    {
        return $this->telefonoMovil;
    }

    /**
     * Set login
     *
     * @param integer $login
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return integer
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set skill1
     *
     * @param integer $skill1
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setSkill1($skill1)
    {
        $this->skill1 = $skill1;
    
        return $this;
    }

    /**
     * Get skill1
     *
     * @return integer
     */
    public function getSkill1()
    {
        return $this->skill1;
    }

    /**
     * Set skill2
     *
     * @param integer $skill2
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setSkill2($skill2)
    {
        $this->skill2 = $skill2;
    
        return $this;
    }

    /**
     * Get skill2
     *
     * @return integer
     */
    public function getSkill2()
    {
        return $this->skill2;
    }

    /**
     * Set skill3
     *
     * @param integer $skill3
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setSkill3($skill3)
    {
        $this->skill3 = $skill3;
    
        return $this;
    }

    /**
     * Get skill3
     *
     * @return integer
     */
    public function getSkill3()
    {
        return $this->skill3;
    }

    /**
     * Set contrato
     *
     * @param string $contrato
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setContrato($contrato)
    {
        $this->contrato = $contrato;
    
        return $this;
    }

    /**
     * Get contrato
     *
     * @return string
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * Set estadoCivil
     *
     * @param string $estadoCivil
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;
    
        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return string
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set estudios
     *
     * @param string $estudios
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setEstudios($estudios)
    {
        $this->estudios = $estudios;
    
        return $this;
    }

    /**
     * Get estudios
     *
     * @return string
     */
    public function getEstudios()
    {
        return $this->estudios;
    }

    /**
     * Set hobbie
     *
     * @param string $hobbie
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setHobbie($hobbie)
    {
        $this->hobbie = $hobbie;
    
        return $this;
    }

    /**
     * Get hobbie
     *
     * @return string
     */
    public function getHobbie()
    {
        return $this->hobbie;
    }

    /**
     * Set nHijos
     *
     * @param integer $nHijos
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setNHijos($nHijos)
    {
        $this->nHijos = $nHijos;
    
        return $this;
    }

    /**
     * Get nHijos
     *
     * @return integer
     */
    public function getNHijos()
    {
        return $this->nHijos;
    }

    /**
     * Set nivelEstudios
     *
     * @param string $nivelEstudios
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setNivelEstudios($nivelEstudios)
    {
        $this->nivelEstudios = $nivelEstudios;
    
        return $this;
    }

    /**
     * Get nivelEstudios
     *
     * @return string
     */
    public function getNivelEstudios()
    {
        return $this->nivelEstudios;
    }

    /**
     * Set talla
     *
     * @param string $talla
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setTalla($talla)
    {
        $this->talla = $talla;
    
        return $this;
    }

    /**
     * Get talla
     *
     * @return string
     */
    public function getTalla()
    {
        return $this->talla;
    }

    /**
     * Set nacionalidad
     *
     * @param string $nacionalidad
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;
    
        return $this;
    }

    /**
     * Get nacionalidad
     *
     * @return string
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set personasCargo
     *
     * @param integer $personasCargo
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setPersonasCargo($personasCargo)
    {
        $this->personasCargo = $personasCargo;
    
        return $this;
    }

    /**
     * Get personasCargo
     *
     * @return integer
     */
    public function getPersonasCargo()
    {
        return $this->personasCargo;
    }

    /**
     * Set perfilAgendamietno
     *
     * @param string $perfilAgendamietno
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setPerfilAgendamietno($perfilAgendamietno)
    {
        $this->perfilAgendamietno = $perfilAgendamietno;
    
        return $this;
    }

    /**
     * Get perfilAgendamietno
     *
     * @return string
     */
    public function getPerfilAgendamietno()
    {
        return $this->perfilAgendamietno;
    }

    /**
     * Set perfilGerencia
     *
     * @param string $perfilGerencia
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setPerfilGerencia($perfilGerencia)
    {
        $this->perfilGerencia = $perfilGerencia;
    
        return $this;
    }

    /**
     * Get perfilGerencia
     *
     * @return string
     */
    public function getPerfilGerencia()
    {
        return $this->perfilGerencia;
    }

    /**
     * Set perfilRr
     *
     * @param string $perfilRr
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setPerfilRr($perfilRr)
    {
        $this->perfilRr = $perfilRr;
    
        return $this;
    }

    /**
     * Get perfilRr
     *
     * @return string
     */
    public function getPerfilRr()
    {
        return $this->perfilRr;
    }

    /**
     * Set usuarioGerencia
     *
     * @param string $usuarioGerencia
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setUsuarioGerencia($usuarioGerencia)
    {
        $this->usuarioGerencia = $usuarioGerencia;
    
        return $this;
    }

    /**
     * Get usuarioGerencia
     *
     * @return string
     */
    public function getUsuarioGerencia()
    {
        return $this->usuarioGerencia;
    }

    /**
     * Set usuarioAgendamiento
     *
     * @param string $usuarioAgendamiento
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setUsuarioAgendamiento($usuarioAgendamiento)
    {
        $this->usuarioAgendamiento = $usuarioAgendamiento;
    
        return $this;
    }

    /**
     * Get usuarioAgendamiento
     *
     * @return string
     */
    public function getUsuarioAgendamiento()
    {
        return $this->usuarioAgendamiento;
    }

    /**
     * Set usuarioRr
     *
     * @param string $usuarioRr
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setUsuarioRr($usuarioRr)
    {
        $this->usuarioRr = $usuarioRr;
    
        return $this;
    }

    /**
     * Get usuarioRr
     *
     * @return string
     */
    public function getUsuarioRr()
    {
        return $this->usuarioRr;
    }

    /**
     * Set usuarioCom
     *
     * @param string $usuarioCom
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setUsuarioCom($usuarioCom)
    {
        $this->usuarioCom = $usuarioCom;
    
        return $this;
    }

    /**
     * Get usuarioCom
     *
     * @return string
     */
    public function getUsuarioCom()
    {
        return $this->usuarioCom;
    }

    /**
     * Set usuarioDiagnosticador
     *
     * @param string $usuarioDiagnosticador
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setUsuarioDiagnosticador($usuarioDiagnosticador)
    {
        $this->usuarioDiagnosticador = $usuarioDiagnosticador;
    
        return $this;
    }

    /**
     * Get usuarioDiagnosticador
     *
     * @return string
     */
    public function getUsuarioDiagnosticador()
    {
        return $this->usuarioDiagnosticador;
    }

    /**
     * Set usuarioChecknotec
     *
     * @param string $usuarioChecknotec
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setUsuarioChecknotec($usuarioChecknotec)
    {
        $this->usuarioChecknotec = $usuarioChecknotec;
    
        return $this;
    }

    /**
     * Get usuarioChecknotec
     *
     * @return string
     */
    public function getUsuarioChecknotec()
    {
        return $this->usuarioChecknotec;
    }

    /**
     * Set usuarioIntraway
     *
     * @param string $usuarioIntraway
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setUsuarioIntraway($usuarioIntraway)
    {
        $this->usuarioIntraway = $usuarioIntraway;
    
        return $this;
    }

    /**
     * Get usuarioIntraway
     *
     * @return string
     */
    public function getUsuarioIntraway()
    {
        return $this->usuarioIntraway;
    }

    /**
     * Set jefeInmediato
     *
     * @param string $jefeInmediato
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setJefeInmediato($jefeInmediato)
    {
        $this->jefeInmediato = $jefeInmediato;
    
        return $this;
    }

    /**
     * Get jefeInmediato
     *
     * @return string
     */
    public function getJefeInmediato()
    {
        return $this->jefeInmediato;
    }

    /**
     * Set jefeInmediatoTelmex
     *
     * @param string $jefeInmediatoTelmex
     *
     * @return TblUsuariosSecRadiografia
     */
    public function setJefeInmediatoTelmex($jefeInmediatoTelmex)
    {
        $this->jefeInmediatoTelmex = $jefeInmediatoTelmex;
    
        return $this;
    }

    /**
     * Get jefeInmediatoTelmex
     *
     * @return string
     */
    public function getJefeInmediatoTelmex()
    {
        return $this->jefeInmediatoTelmex;
    }
}

