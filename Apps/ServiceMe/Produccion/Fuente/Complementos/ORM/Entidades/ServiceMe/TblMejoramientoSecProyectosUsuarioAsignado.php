<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoSecProyectosUsuarioAsignado
 *
 * @Table(name="tbl_mejoramiento_sec_proyectos_usuario_asignado", indexes={@Index(name="IDX_E3A487DB497D1D22", columns={"OBJETIVO"}), @Index(name="IDX_E3A487DB1D204E47", columns={"USUARIO"}), @Index(name="IDX_E3A487DBD6A52665", columns={"ESTADO"})})
 * @Entity
 */
class TblMejoramientoSecProyectosUsuarioAsignado
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
     * @var \Entidades\ServiceMe\TblUsuarios
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblUsuarios")
     * @JoinColumns({
     *   @JoinColumn(name="USUARIO", referencedColumnName="ID")
     * })
     */
    private $usuario;

    /**
     * @var \Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos")
     * @JoinColumns({
     *   @JoinColumn(name="OBJETIVO", referencedColumnName="ID")
     * })
     */
    private $objetivo;

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
     * Set usuario
     *
     * @param \Entidades\ServiceMe\TblUsuarios $usuario
     *
     * @return TblMejoramientoSecProyectosUsuarioAsignado
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
     * Set objetivo
     *
     * @param \Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos $objetivo
     *
     * @return TblMejoramientoSecProyectosUsuarioAsignado
     */
    public function setObjetivo(\Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos $objetivo = null)
    {
        $this->objetivo = $objetivo;
    
        return $this;
    }

    /**
     * Get objetivo
     *
     * @return \Entidades\ServiceMe\TblMejoramientoSecProyectosObjetivos
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblMejoramientoSecProyectosUsuarioAsignado
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

