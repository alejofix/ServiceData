<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoLogMejoras
 *
 * @Table(name="tbl_mejoramiento_log_mejoras", indexes={@Index(name="IDX_61017FB3942E535C", columns={"MEJORA"}), @Index(name="IDX_61017FB31D204E47", columns={"USUARIO"}), @Index(name="IDX_61017FB3EF58D91B", columns={"ESCENARIO"})})
 * @Entity
 */
class TblMejoramientoLogMejoras
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
     * @var \Entidades\ServiceMe\TblUsuarios
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblUsuarios")
     * @JoinColumns({
     *   @JoinColumn(name="USUARIO", referencedColumnName="ID")
     * })
     */
    private $usuario;

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
     * @var \Entidades\ServiceMe\TblMejoramientoSelectEscenariosMejoras
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoSelectEscenariosMejoras")
     * @JoinColumns({
     *   @JoinColumn(name="ESCENARIO", referencedColumnName="ID")
     * })
     */
    private $escenario;


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
     * @return TblMejoramientoLogMejoras
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
     * Set usuario
     *
     * @param \Entidades\ServiceMe\TblUsuarios $usuario
     *
     * @return TblMejoramientoLogMejoras
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

    /**
     * Set mejora
     *
     * @param \Entidades\ServiceMe\TblMejoramientoPriMejoras $mejora
     *
     * @return TblMejoramientoLogMejoras
     */
    public function setMejora(\Entidades\ServiceMe\TblMejoramientoPriMejoras $mejora = null)
    {
        $this->mejora = $mejora;
    
        return $this;
    }

    /**
     * Get mejora
     *
     * @return \Entidades\ServiceMe\TblMejoramientoPriMejoras
     */
    public function getMejora()
    {
        return $this->mejora;
    }

    /**
     * Set escenario
     *
     * @param \Entidades\ServiceMe\TblMejoramientoSelectEscenariosMejoras $escenario
     *
     * @return TblMejoramientoLogMejoras
     */
    public function setEscenario(\Entidades\ServiceMe\TblMejoramientoSelectEscenariosMejoras $escenario = null)
    {
        $this->escenario = $escenario;
    
        return $this;
    }

    /**
     * Get escenario
     *
     * @return \Entidades\ServiceMe\TblMejoramientoSelectEscenariosMejoras
     */
    public function getEscenario()
    {
        return $this->escenario;
    }
}

