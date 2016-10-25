<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoPriProyectos
 *
 * @Table(name="tbl_mejoramiento_pri_proyectos", indexes={@Index(name="IDX_F4B4AF30C1191A0F", columns={"USUARIO_APERTURA"}), @Index(name="IDX_F4B4AF30E5B5C6F", columns={"USUARIO_CIERRE"}), @Index(name="IDX_F4B4AF30D6A52665", columns={"ESTADO"})})
 * @Entity
 */
class TblMejoramientoPriProyectos
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
     * @Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA_INICIO", type="datetime", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA_FIN", type="datetime", nullable=true)
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @Column(name="DESCRIPCION", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @Column(name="TIPO", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @Column(name="HORAS", type="integer", nullable=false)
     */
    private $horas;

    /**
     * @var \Entidades\ServiceMe\TblUsuarios
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblUsuarios")
     * @JoinColumns({
     *   @JoinColumn(name="USUARIO_APERTURA", referencedColumnName="ID")
     * })
     */
    private $usuarioApertura;

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
     * @var \Entidades\ServiceMe\TblUsuarios
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblUsuarios")
     * @JoinColumns({
     *   @JoinColumn(name="USUARIO_CIERRE", referencedColumnName="ID")
     * })
     */
    private $usuarioCierre;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TblMejoramientoPriProyectos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TblMejoramientoPriProyectos
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return TblMejoramientoPriProyectos
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return TblMejoramientoPriProyectos
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    
        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TblMejoramientoPriProyectos
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return TblMejoramientoPriProyectos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set horas
     *
     * @param integer $horas
     *
     * @return TblMejoramientoPriProyectos
     */
    public function setHoras($horas)
    {
        $this->horas = $horas;
    
        return $this;
    }

    /**
     * Get horas
     *
     * @return integer
     */
    public function getHoras()
    {
        return $this->horas;
    }

    /**
     * Set usuarioApertura
     *
     * @param \Entidades\ServiceMe\TblUsuarios $usuarioApertura
     *
     * @return TblMejoramientoPriProyectos
     */
    public function setUsuarioApertura(\Entidades\ServiceMe\TblUsuarios $usuarioApertura = null)
    {
        $this->usuarioApertura = $usuarioApertura;
    
        return $this;
    }

    /**
     * Get usuarioApertura
     *
     * @return \Entidades\ServiceMe\TblUsuarios
     */
    public function getUsuarioApertura()
    {
        return $this->usuarioApertura;
    }

    /**
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblMejoramientoPriProyectos
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

    /**
     * Set usuarioCierre
     *
     * @param \Entidades\ServiceMe\TblUsuarios $usuarioCierre
     *
     * @return TblMejoramientoPriProyectos
     */
    public function setUsuarioCierre(\Entidades\ServiceMe\TblUsuarios $usuarioCierre = null)
    {
        $this->usuarioCierre = $usuarioCierre;
    
        return $this;
    }

    /**
     * Get usuarioCierre
     *
     * @return \Entidades\ServiceMe\TblUsuarios
     */
    public function getUsuarioCierre()
    {
        return $this->usuarioCierre;
    }
}

