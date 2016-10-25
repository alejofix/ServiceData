<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoSecMejorasNotas
 *
 * @Table(name="tbl_mejoramiento_sec_mejoras_notas", indexes={@Index(name="IDX_A172E8F4497D1D22", columns={"OBJETIVO"}), @Index(name="IDX_A172E8F41D204E47", columns={"USUARIO"})})
 * @Entity
 */
class TblMejoramientoSecMejorasNotas
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
     * @Column(name="NOTA", type="text", nullable=false)
     */
    private $nota;

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
     * @var \Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos", inversedBy="notas")
     * @JoinColumns({
     *   @JoinColumn(name="OBJETIVO", referencedColumnName="ID")
     * })
     */
    private $objetivo;


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
     * Set nota
     *
     * @param string $nota
     *
     * @return TblMejoramientoSecMejorasNotas
     */
    public function setNota($nota)
    {
        $this->nota = $nota;
    
        return $this;
    }

    /**
     * Get nota
     *
     * @return string
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TblMejoramientoSecMejorasNotas
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
     * @return TblMejoramientoSecMejorasNotas
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
     * @param \Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos $objetivo
     *
     * @return TblMejoramientoSecMejorasNotas
     */
    public function setObjetivo(\Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos $objetivo = null)
    {
        $this->objetivo = $objetivo;
    
        return $this;
    }

    /**
     * Get objetivo
     *
     * @return \Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }
}

