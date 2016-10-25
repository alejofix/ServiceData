<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblFormulariosSecMotivoTipo
 *
 * @Table(name="tbl_formularios_sec_motivo_tipo", indexes={@Index(name="IDX_43855FD7D6A52665", columns={"ESTADO"}), @Index(name="IDX_43855FD7DB56E66", columns={"SERVICIO"})})
 * @Entity
 */
class TblFormulariosSecMotivoTipo
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
     * @var \Entidades\ServiceMe\TblGeneralEstados
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblGeneralEstados")
     * @JoinColumns({
     *   @JoinColumn(name="ESTADO", referencedColumnName="ID")
     * })
     */
    private $estado;

    /**
     * @var \Entidades\ServiceMe\TblGeneralServicios
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblGeneralServicios")
     * @JoinColumns({
     *   @JoinColumn(name="SERVICIO", referencedColumnName="ID")
     * })
     */
    private $servicio;


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
     * @return TblFormulariosSecMotivoTipo
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
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblFormulariosSecMotivoTipo
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
     * Set servicio
     *
     * @param \Entidades\ServiceMe\TblGeneralServicios $servicio
     *
     * @return TblFormulariosSecMotivoTipo
     */
    public function setServicio(\Entidades\ServiceMe\TblGeneralServicios $servicio = null)
    {
        $this->servicio = $servicio;
    
        return $this;
    }

    /**
     * Get servicio
     *
     * @return \Entidades\ServiceMe\TblGeneralServicios
     */
    public function getServicio()
    {
        return $this->servicio;
    }
}

