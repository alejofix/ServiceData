<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblFormulariosPriMotivo
 *
 * @Table(name="tbl_formularios_pri_motivo", indexes={@Index(name="IDX_DF42612346B8F0F3", columns={"TIPO"}), @Index(name="IDX_DF42612320F7C0D5", columns={"RAZON"})})
 * @Entity
 */
class TblFormulariosPriMotivo
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
     * @var integer
     *
     * @Column(name="CUENTA", type="bigint", nullable=false)
     */
    private $cuenta;

    /**
     * @var \DateTime
     *
     * @Column(name="FECHA", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @Column(name="REFERENCIA", type="string", length=255, nullable=true)
     */
    private $referencia;

    /**
     * @var string
     *
     * @Column(name="INFORMACION", type="text", nullable=true)
     */
    private $informacion;

    /**
     * @var \Entidades\ServiceMe\TblFormulariosSecMotivoRazon
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblFormulariosSecMotivoRazon")
     * @JoinColumns({
     *   @JoinColumn(name="RAZON", referencedColumnName="ID")
     * })
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cuenta
     *
     * @param integer $cuenta
     *
     * @return TblFormulariosPriMotivo
     */
    public function setCuenta($cuenta)
    {
        $this->cuenta = $cuenta;
    
        return $this;
    }

    /**
     * Get cuenta
     *
     * @return integer
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TblFormulariosPriMotivo
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
     * Set referencia
     *
     * @param string $referencia
     *
     * @return TblFormulariosPriMotivo
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
    
        return $this;
    }

    /**
     * Get referencia
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set informacion
     *
     * @param string $informacion
     *
     * @return TblFormulariosPriMotivo
     */
    public function setInformacion($informacion)
    {
        $this->informacion = $informacion;
    
        return $this;
    }

    /**
     * Get informacion
     *
     * @return string
     */
    public function getInformacion()
    {
        return $this->informacion;
    }

    /**
     * Set razon
     *
     * @param \Entidades\ServiceMe\TblFormulariosSecMotivoRazon $razon
     *
     * @return TblFormulariosPriMotivo
     */
    public function setRazon(\Entidades\ServiceMe\TblFormulariosSecMotivoRazon $razon = null)
    {
        $this->razon = $razon;
    
        return $this;
    }

    /**
     * Get razon
     *
     * @return \Entidades\ServiceMe\TblFormulariosSecMotivoRazon
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
     * @return TblFormulariosPriMotivo
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
}

