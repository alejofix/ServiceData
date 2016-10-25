<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoSecMejorasRutas
 *
 * @Table(name="tbl_mejoramiento_sec_mejoras_rutas", indexes={@Index(name="IDX_3BC6258C497D1D22", columns={"OBJETIVO"})})
 * @Entity
 */
class TblMejoramientoSecMejorasRutas
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
     * @Column(name="DESCRIPCION", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @Column(name="PROCESO", type="string", length=255, nullable=false)
     */
    private $proceso;
	
    /**
     * @var \Entidades\ServiceMe\TblMejoramientoPriMejoras
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoPriMejoras")
     * @JoinColumns({
     *   @JoinColumn(name="MEJORA", referencedColumnName="ID")
     * })
     */
    private $mejora;


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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TblMejoramientoSecMejorasRutas
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
     * Set proceso
     *
     * @param string $proceso
     *
     * @return TblMejoramientoSecMejorasRutas
     */
    public function setProceso($proceso)
    {
        $this->proceso = $proceso;
    
        return $this;
    }

    /**
     * Get proceso
     *
     * @return string
     */
    public function getProceso()
    {
        return $this->proceso;
    }

    /**
     * Set objetivo
     *
     * @param \Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos $objetivo
     *
     * @return TblMejoramientoSecMejorasRutas
     */
    public function setMejora(\Entidades\ServiceMe\TblMejoramientoPriMejoras $objetivo = null)
    {
        $this->mejora = $objetivo;
    
        return $this;
    }

    /**
     * Get objetivo
     *
     * @return \Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos
     */
    public function getMejora()
    {
        return $this->mejora;
    }
}

