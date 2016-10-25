<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblServicecoLogAltoimpacto
 *
 * @Table(name="tbl_serviceco_log_altoimpacto", indexes={@Index(name="IDX_838AB29D1D204E47", columns={"USUARIO"})})
 * @Entity
 */
class TblServicecoLogAltoimpacto
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
     * @Column(name="PROCEDIMIENTO", type="string", length=255, nullable=false)
     */
    private $procedimiento;

    /**
     * @var string
     *
     * @Column(name="AVISO", type="string", length=255, nullable=false)
     */
    private $aviso;

    /**
     * @var string
     *
     * @Column(name="DESCRIPCION", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var \Entidades\ServiceMe\TblUsuarios
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblUsuarios")
     * @JoinColumns({
     *   @JoinColumn(name="USUARIO", referencedColumnName="ID")
     * })
     */
    private $usuario;


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
     * @return TblServicecoLogAltoimpacto
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
     * Set procedimiento
     *
     * @param string $procedimiento
     *
     * @return TblServicecoLogAltoimpacto
     */
    public function setProcedimiento($procedimiento)
    {
        $this->procedimiento = $procedimiento;
    
        return $this;
    }

    /**
     * Get procedimiento
     *
     * @return string
     */
    public function getProcedimiento()
    {
        return $this->procedimiento;
    }

    /**
     * Set aviso
     *
     * @param string $aviso
     *
     * @return TblServicecoLogAltoimpacto
     */
    public function setAviso($aviso)
    {
        $this->aviso = $aviso;
    
        return $this;
    }

    /**
     * Get aviso
     *
     * @return string
     */
    public function getAviso()
    {
        return $this->aviso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TblServicecoLogAltoimpacto
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
     * Set usuario
     *
     * @param \Entidades\ServiceMe\TblUsuarios $usuario
     *
     * @return TblServicecoLogAltoimpacto
     */
    public function setUsuario(\Entidades\ServiceMe\TblUsuarios $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Entidades\ServiceMe\TblUsuarios
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}

