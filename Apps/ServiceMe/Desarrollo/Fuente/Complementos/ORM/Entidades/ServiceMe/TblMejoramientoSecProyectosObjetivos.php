<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoSecProyectosObjetivos
 *
 * @Table(name="tbl_mejoramiento_sec_proyectos_objetivos", indexes={@Index(name="IDX_524B3E82A9E19EF5", columns={"PROYECTO"}), @Index(name="IDX_524B3E82D6A52665", columns={"ESTADO"})})
 * @Entity
 */
class TblMejoramientoSecProyectosObjetivos
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
     * @Column(name="FECHA", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @Column(name="OBJETIVO", type="text", nullable=false)
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TblMejoramientoSecProyectosObjetivos
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
     * Set objetivo
     *
     * @param string $objetivo
     *
     * @return TblMejoramientoSecProyectosObjetivos
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;
    
        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string
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
     * @return TblMejoramientoSecProyectosObjetivos
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
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblMejoramientoSecProyectosObjetivos
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

