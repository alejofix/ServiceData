<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoLogProyectos
 *
 * @Table(name="tbl_mejoramiento_log_proyectos", indexes={@Index(name="IDX_1AC87705A9E19EF5", columns={"PROYECTO"}), @Index(name="IDX_1AC877051D204E47", columns={"USUARIO"}), @Index(name="IDX_1AC87705EF58D91B", columns={"ESCENARIO"})})
 * @Entity
 */
class TblMejoramientoLogProyectos
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
     * @var \Entidades\ServiceMe\TblMejoramientoPriProyectos
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoPriProyectos")
     * @JoinColumns({
     *   @JoinColumn(name="PROYECTO", referencedColumnName="ID")
     * })
     */
    private $proyecto;

    /**
     * @var \Entidades\ServiceMe\TblMejoramientoSelectEscenariosProyectos
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoSelectEscenariosProyectos")
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
     * @return TblMejoramientoLogProyectos
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
     * @return TblMejoramientoLogProyectos
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
     * Set proyecto
     *
     * @param \Entidades\ServiceMe\TblMejoramientoPriProyectos $proyecto
     *
     * @return TblMejoramientoLogProyectos
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
     * Set escenario
     *
     * @param \Entidades\ServiceMe\TblMejoramientoSelectEscenariosProyectos $escenario
     *
     * @return TblMejoramientoLogProyectos
     */
    public function setEscenario(\Entidades\ServiceMe\TblMejoramientoSelectEscenariosProyectos $escenario = null)
    {
        $this->escenario = $escenario;
    
        return $this;
    }

    /**
     * Get escenario
     *
     * @return \Entidades\ServiceMe\TblMejoramientoSelectEscenariosProyectos
     */
    public function getEscenario()
    {
        return $this->escenario;
    }
}

