<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblFormulariosSecMotivoRazon
 *
 * @Table(name="tbl_formularios_sec_motivo_razon", indexes={@Index(name="IDX_1CF119ABD6A52665", columns={"ESTADO"}), @Index(name="IDX_1CF119AB46B8F0F3", columns={"TIPO"})})
 * @Entity
 */
class TblFormulariosSecMotivoRazon
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
     * @Column(name="RAZON", type="string", length=255, nullable=false)
     */
    private $razon;

    /**
     * @var \Entidades\ServiceMe\TblFormulariosSecMotivoTipo
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblFormulariosSecMotivoTipo")
     * @JoinColumns({
     *   @JoinColumn(name="TIPO", referencedColumnName="ID")
     * })
     */
    private $tipo;

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
     * Set razon
     *
     * @param string $razon
     *
     * @return TblFormulariosSecMotivoRazon
     */
    public function setRazon($razon)
    {
        $this->razon = $razon;
    
        return $this;
    }

    /**
     * Get razon
     *
     * @return string
     */
    public function getRazon()
    {
        return $this->razon;
    }

    /**
     * Set tipo
     *
     * @param \Entidades\ServiceMe\TblFormulariosSecMotivoTipo $tipo
     *
     * @return TblFormulariosSecMotivoRazon
     */
    public function setTipo(\Entidades\ServiceMe\TblFormulariosSecMotivoTipo $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Entidades\ServiceMe\TblFormulariosSecMotivoTipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblFormulariosSecMotivoRazon
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

