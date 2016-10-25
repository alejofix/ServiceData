<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoSecMejorasObjetivos
 *
 * @Table(name="tbl_mejoramiento_sec_mejoras_objetivos", indexes={@Index(name="IDX_AAE939C8942E535C", columns={"MEJORA"}), @Index(name="IDX_AAE939C8D6A52665", columns={"ESTADO"})})
 * @Entity
 */
class TblMejoramientoSecMejorasObjetivos
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
     * @Column(name="FECHA_OBJETIVO", type="datetime", nullable=false)
     */
    private $fechaObjetivo;

    /**
     * @var string
     *
     * @Column(name="OBJETIVO", type="text", nullable=false)
     */
    private $objetivo;

    /**
     * @var \Entidades\ServiceMe\TblMejoramientoPriMejoras
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblMejoramientoPriMejoras", inversedBy="objetivos")
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
	 * @var Entidades\ServiceMe\TblMejoramientoSecMejorasNotas
	 * @OneToMany(targetEntity="Entidades\ServiceMe\TblMejoramientoSecMejorasNotas", mappedBy="objetivo")
	 */
	private $notas;
	
	public function getNotas() {
		return $this->notas;
	}
	
	public function setNotas(Entidades\ServiceMe\TblMejoramientoSecMejorasNotas $notas) {
		$this->notas = $notas;
		return $this;
	}
	
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
     * Set fechaObjetivo
     *
     * @param \DateTime $fechaObjetivo
     *
     * @return TblMejoramientoSecMejorasObjetivos
     */
    public function setFechaObjetivo($fechaObjetivo)
    {
        $this->fechaObjetivo = $fechaObjetivo;
    
        return $this;
    }

    /**
     * Get fechaObjetivo
     *
     * @return \DateTime
     */
    public function getFechaObjetivo()
    {
        return $this->fechaObjetivo;
    }

    /**
     * Set objetivo
     *
     * @param string $objetivo
     *
     * @return TblMejoramientoSecMejorasObjetivos
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;
    
        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set mejora
     *
     * @param \Entidades\ServiceMe\TblMejoramientoPriMejoras $mejora
     *
     * @return TblMejoramientoSecMejorasObjetivos
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
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblMejoramientoSecMejorasObjetivos
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

