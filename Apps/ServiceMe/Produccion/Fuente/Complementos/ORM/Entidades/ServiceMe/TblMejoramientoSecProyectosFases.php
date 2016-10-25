<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoSecProyectosFases
 *
 * @Table(name="tbl_mejoramiento_sec_proyectos_fases", indexes={@Index(name="IDX_21B0A070A9E19EF5", columns={"PROYECTO"}), @Index(name="IDX_21B0A070497D1D22", columns={"OBJETIVO"}), @Index(name="IDX_21B0A070F098FC9C", columns={"USUARIO_ASIGNADO"})})
 * @Entity
 */
class TblMejoramientoSecProyectosFases
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
     * @Column(name="FECHA_INICIO", type="datetime", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA_FIN", type="datetime", nullable=false)
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @Column(name="COMENTARIO", type="text", nullable=false)
     */
    private $comentario;

    /**
     * @var integer
     *
     * @Column(name="HORAS", type="integer", nullable=false)
     */
    private $horas;

    /**
     * @var \Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos")
     * @JoinColumns({
     *   @JoinColumn(name="OBJETIVO", referencedColumnName="ID")
     * })
     */
    private $objetivo;

    /**
     * @var \Entidades\ServiceMe\TblMejoramientoPriProyectos
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoPriProyectos")
     * @JoinColumns({
     *   @JoinColumn(name="PROYECTO", referencedColumnName="ID")
     * })
     */
    private $proyecto;

    /**
     * @var \Entidades\ServiceMe\TblMejoramientoSecProyectosUsuarioAsignado
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoSecProyectosUsuarioAsignado")
     * @JoinColumns({
     *   @JoinColumn(name="USUARIO_ASIGNADO", referencedColumnName="ID")
     * })
     */
    private $usuarioAsignado;


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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return TblMejoramientoSecProyectosFases
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
     * @return TblMejoramientoSecProyectosFases
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
     * Set comentario
     *
     * @param string $comentario
     *
     * @return TblMejoramientoSecProyectosFases
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    
        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set horas
     *
     * @param integer $horas
     *
     * @return TblMejoramientoSecProyectosFases
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
     * Set objetivo
     *
     * @param \Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos $objetivo
     *
     * @return TblMejoramientoSecProyectosFases
     */
    public function setObjetivo(\Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos $objetivo = null)
    {
        $this->objetivo = $objetivo;
    
        return $this;
    }

    /**
     * Get objetivo
     *
     * @return \Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set proyecto
     *
     * @param \Entidades\ServiceMe\TblMejoramientoPriProyectos $proyecto
     *
     * @return TblMejoramientoSecProyectosFases
     */
    public function setProyecto(\Entidades\ServiceMe\TblMejoramientoPriProyectos $proyecto = null)
    {
        $this->proyecto = $proyecto;
    
        return $this;
    }

    /**
     * Get proyecto
     *
     * @return \Entidades\ServiceMe\TblMejoramientoPriProyectos
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }

    /**
     * Set usuarioAsignado
     *
     * @param \Entidades\ServiceMe\TblMejoramientoSecProyectosUsuarioAsignado $usuarioAsignado
     *
     * @return TblMejoramientoSecProyectosFases
     */
    public function setUsuarioAsignado(\Entidades\ServiceMe\TblMejoramientoSecProyectosUsuarioAsignado $usuarioAsignado = null)
    {
        $this->usuarioAsignado = $usuarioAsignado;
    
        return $this;
    }

    /**
     * Get usuarioAsignado
     *
     * @return \Entidades\ServiceMe\TblMejoramientoSecProyectosUsuarioAsignado
     */
    public function getUsuarioAsignado()
    {
        return $this->usuarioAsignado;
    }
}

