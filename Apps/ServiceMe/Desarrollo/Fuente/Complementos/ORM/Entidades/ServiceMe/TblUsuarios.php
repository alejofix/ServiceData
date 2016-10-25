<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblUsuarios
 *
 * @Table(name="tbl_usuarios", uniqueConstraints={@UniqueConstraint(name="USUARIO", columns={"USUARIO"})}, indexes={@Index(name="IDX_4E06AA6C8792A44A", columns={"EMPRESA"}), @Index(name="IDX_4E06AA6CCCBA95C1", columns={"CARGO"}), @Index(name="IDX_4E06AA6CD6A52665", columns={"ESTADO"}), @Index(name="IDX_4E06AA6CC23F5584", columns={"PERMISO"})})
 * @Entity
 */
class TblUsuarios
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
     * @var string
     *
     * @Column(name="USUARIO", type="string", length=255, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @Column(name="PASSWORD", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @Column(name="NOMBRE_INICIAL", type="string", length=255, nullable=false)
     */
    private $nombreInicial;

    /**
     * @var string
     *
     * @Column(name="NOMBRE_FINAL", type="string", length=255, nullable=true)
     */
    private $nombreFinal;

    /**
     * @var string
     *
     * @Column(name="APELLIDO_INICIAL", type="string", length=255, nullable=false)
     */
    private $apellidoInicial;

    /**
     * @var string
     *
     * @Column(name="APELLIDO_FINAL", type="string", length=255, nullable=true)
     */
    private $apellidoFinal;

    /**
     * @var string
     *
     * @Column(name="DOCUMENTO", type="string", length=255, nullable=false)
     */
    private $documento;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA_NACIMIENTO", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA_EXPEDICION", type="date", nullable=false)
     */
    private $fechaExpedicion;

    /**
     * @var string
     *
     * @Column(name="FIJO", type="string", length=255, nullable=true)
     */
    private $fijo;

    /**
     * @var string
     *
     * @Column(name="MOVIL", type="string", length=255, nullable=true)
     */
    private $movil;

    /**
     * @var string
     *
     * @Column(name="EPS", type="string", length=255, nullable=true)
     */
    private $eps;

    /**
     * @var string
     *
     * @Column(name="ARP", type="string", length=255, nullable=true)
     */
    private $arp;

    /**
     * @var string
     *
     * @Column(name="RR", type="string", length=255, nullable=true)
     */
    private $rr;

    /**
     * @var string
     *
     * @Column(name="GENERO", type="string", length=255, nullable=false)
     */
    private $genero;

    /**
     * @var string
     *
     * @Column(name="CORREO", type="string", length=255, nullable=true)
     */
    private $correo;

    /**
     * @var \Entidades\ServiceMe\TblGeneralEmpresas
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblGeneralEmpresas")
     * @JoinColumns({
     *   @JoinColumn(name="EMPRESA", referencedColumnName="ID")
     * })
     */
    private $empresa;

    /**
     * @var \Entidades\ServiceMe\TblPermisos
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblPermisos")
     * @JoinColumns({
     *   @JoinColumn(name="PERMISO", referencedColumnName="ID")
     * })
     */
    private $permiso;

    /**
     * @var \Entidades\ServiceMe\TblGeneralCargo
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblGeneralCargo")
     * @JoinColumns({
     *   @JoinColumn(name="CARGO", referencedColumnName="ID")
     * })
     */
    private $cargo;

    /**
     * @var \Entidades\ServiceMe\TblGeneralEstados
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblGeneralEstados")
     * @JoinColumns({
     *   @JoinColumn(name="ESTADO", referencedColumnName="ID")
     * })
     */
    private $estado;


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
     * Set usuario
     *
     * @param string $usuario
     *
     * @return TblUsuarios
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return TblUsuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nombreInicial
     *
     * @param string $nombreInicial
     *
     * @return TblUsuarios
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
     * @return TblUsuarios
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
     * @return TblUsuarios
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
     * @return TblUsuarios
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
     * Set documento
     *
     * @param string $documento
     *
     * @return TblUsuarios
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    
        return $this;
    }

    /**
     * Get documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return TblUsuarios
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
     * Set fechaExpedicion
     *
     * @param \DateTime $fechaExpedicion
     *
     * @return TblUsuarios
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
     * Set fijo
     *
     * @param string $fijo
     *
     * @return TblUsuarios
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
     * Set movil
     *
     * @param string $movil
     *
     * @return TblUsuarios
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
     * Set eps
     *
     * @param string $eps
     *
     * @return TblUsuarios
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
     * @return TblUsuarios
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
     * Set rr
     *
     * @param string $rr
     *
     * @return TblUsuarios
     */
    public function setRr($rr)
    {
        $this->rr = $rr;
    
        return $this;
    }

    /**
     * Get rr
     *
     * @return string
     */
    public function getRr()
    {
        return $this->rr;
    }

    /**
     * Set genero
     *
     * @param string $genero
     *
     * @return TblUsuarios
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
     * Set correo
     *
     * @param string $correo
     *
     * @return TblUsuarios
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    
        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set empresa
     *
     * @param \Entidades\ServiceMe\TblGeneralEmpresas $empresa
     *
     * @return TblUsuarios
     */
    public function setEmpresa(\Entidades\ServiceMe\TblGeneralEmpresas $empresa = null)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return \Entidades\ServiceMe\TblGeneralEmpresas
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set permiso
     *
     * @param \Entidades\ServiceMe\TblPermisos $permiso
     *
     * @return TblUsuarios
     */
    public function setPermiso(\Entidades\ServiceMe\TblPermisos $permiso = null)
    {
        $this->permiso = $permiso;
    
        return $this;
    }

    /**
     * Get permiso
     *
     * @return \Entidades\ServiceMe\TblPermisos
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * Set cargo
     *
     * @param \Entidades\ServiceMe\TblGeneralCargo $cargo
     *
     * @return TblUsuarios
     */
    public function setCargo(\Entidades\ServiceMe\TblGeneralCargo $cargo = null)
    {
        $this->cargo = $cargo;
    
        return $this;
    }

    /**
     * Get cargo
     *
     * @return \Entidades\ServiceMe\TblGeneralCargo
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblUsuarios
     */
    public function setEstado(\Entidades\ServiceMe\TblGeneralEstados $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \Entidades\ServiceMe\TblGeneralEstados
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

