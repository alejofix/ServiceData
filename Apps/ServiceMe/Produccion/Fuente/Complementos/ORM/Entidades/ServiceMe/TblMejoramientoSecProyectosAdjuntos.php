<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoSecProyectosAdjuntos
 *
 * @Table(name="tbl_mejoramiento_sec_proyectos_adjuntos", indexes={@Index(name="IDX_9E5706C379438482", columns={"FASE"}), @Index(name="IDX_9E5706C3D6A52665", columns={"ESTADO"})})
 * @Entity
 */
class TblMejoramientoSecProyectosAdjuntos
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
     * @var string
     *
     * @Column(name="DESCRIPCION", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var \Entidades\ServiceMe\TblMejoramientoSecProyectosFases
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoSecProyectosFases")
     * @JoinColumns({
     *   @JoinColumn(name="FASE", referencedColumnName="ID")
     * })
     */
    private $fase;

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
     * @return TblMejoramientoSecProyectosAdjuntos
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
     * @return TblMejoramientoSecProyectosAdjuntos
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TblMejoramientoSecProyectosAdjuntos
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
     * Set fase
     *
     * @param \Entidades\ServiceMe\TblMejoramientoSecProyectosFases $fase
     *
     * @return TblMejoramientoSecProyectosAdjuntos
     */
    public function setFase(\Entidades\ServiceMe\TblMejoramientoSecProyectosFases $fase = null)
    {
        $this->fase = $fase;
    
        return $this;
    }

    /**
     * Get fase
     *
     * @return \Entidades\ServiceMe\TblMejoramientoSecProyectosFases
     */
    public function getFase()
    {
        return $this->fase;
    }

    /**
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblMejoramientoSecProyectosAdjuntos
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

