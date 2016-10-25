<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoSecMejorasAdjuntos
 *
 * @Table(name="tbl_mejoramiento_sec_mejoras_adjuntos", indexes={@Index(name="IDX_5EFE251E497D1D22", columns={"OBJETIVO"}), @Index(name="IDX_5EFE251ED6A52665", columns={"ESTADO"})})
 * @Entity
 */
class TblMejoramientoSecMejorasAdjuntos
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
     * @Column(name="ARCHIVO", type="string", length=255, nullable=false)
     */
    private $archivo;

    /**
     * @var string
     *
     * @Column(name="DOCUMENTO", type="string", length=255, nullable=false)
     */
    private $documento;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA", type="datetime", nullable=false)
     */
    private $fecha;
    
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
     * Set archivo
     *
     * @param string $archivo
     *
     * @return TblMejoramientoSecMejorasAdjuntos
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;
    
        return $this;
    }

    /**
     * Get archivo
     *
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return TblMejoramientoSecMejorasAdjuntos
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TblMejoramientoSecMejorasAdjuntos
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
     * @param \Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos $objetivo
     *
     * @return TblMejoramientoSecMejorasAdjuntos
     */
    public function setMejora(\Entidades\ServiceMe\TblMejoramientoPriMejoras $mejora = null)
    {
        $this->mejora = $mejora;
    
        return $this;
    }

    /**
     * Get objetivo
     *
     * @return \Entidades\ServiceMe\TblMejoramientoPriMejoras
     */
    public function getMejora()
    {
        return $this->mejora;
    }

    /**
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblMejoramientoSecMejorasAdjuntos
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

