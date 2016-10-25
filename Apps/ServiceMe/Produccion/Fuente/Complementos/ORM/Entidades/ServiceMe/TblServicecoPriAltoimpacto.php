<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblServicecoPriAltoimpacto
 *
 * @Table(name="tbl_serviceco_pri_altoimpacto", indexes={@Index(name="IDX_A9B3C4B11D204E47", columns={"USUARIO"}), @Index(name="IDX_A9B3C4B1D6A52665", columns={"ESTADO"}), @Index(name="IDX_A9B3C4B146B8F0F3", columns={"TIPO"}), @Index(name="IDX_A9B3C4B1BF7C822A", columns={"DETALLE"})})
 * @Entity
 */
class TblServicecoPriAltoimpacto
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
     * @Column(name="AVISO", type="string", length=255, nullable=false)
     */
    private $aviso;

    /**
     * @var string
     *
     * @Column(name="SINTOMA", type="string", length=255, nullable=false)
     */
    private $sintoma;

    /**
     * @var string
     *
     * @Column(name="AFECTACION", type="string", length=255, nullable=false)
     */
    private $afectacion;

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
     * @var \Entidades\ServiceMe\TblServicecoSecAltoimpactoTipo
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblServicecoSecAltoimpactoTipo")
     * @JoinColumns({
     *   @JoinColumn(name="TIPO", referencedColumnName="ID")
     * })
     */
    private $tipo;

    /**
     * @var \Entidades\ServiceMe\TblServicecoSecAltoimpactoDetalle
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblServicecoSecAltoimpactoDetalle")
     * @JoinColumns({
     *   @JoinColumn(name="DETALLE", referencedColumnName="ID")
     * })
     */
    private $detalle;

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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TblServicecoPriAltoimpacto
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
     * Set aviso
     *
     * @param string $aviso
     *
     * @return TblServicecoPriAltoimpacto
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
     * Set sintoma
     *
     * @param string $sintoma
     *
     * @return TblServicecoPriAltoimpacto
     */
    public function setSintoma($sintoma)
    {
        $this->sintoma = $sintoma;
    
        return $this;
    }

    /**
     * Get sintoma
     *
     * @return string
     */
    public function getSintoma()
    {
        return $this->sintoma;
    }

    /**
     * Set afectacion
     *
     * @param string $afectacion
     *
     * @return TblServicecoPriAltoimpacto
     */
    public function setAfectacion($afectacion)
    {
        $this->afectacion = $afectacion;
    
        return $this;
    }

    /**
     * Get afectacion
     *
     * @return string
     */
    public function getAfectacion()
    {
        return $this->afectacion;
    }

    /**
     * Set usuario
     *
     * @param \Entidades\ServiceMe\TblUsuarios $usuario
     *
     * @return TblServicecoPriAltoimpacto
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
     * Set tipo
     *
     * @param \Entidades\ServiceMe\TblServicecoSecAltoimpactoTipo $tipo
     *
     * @return TblServicecoPriAltoimpacto
     */
    public function setTipo(\Entidades\ServiceMe\TblServicecoSecAltoimpactoTipo $tipo = null)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Entidades\ServiceMe\TblServicecoSecAltoimpactoTipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set detalle
     *
     * @param \Entidades\ServiceMe\TblServicecoSecAltoimpactoDetalle $detalle
     *
     * @return TblServicecoPriAltoimpacto
     */
    public function setDetalle(\Entidades\ServiceMe\TblServicecoSecAltoimpactoDetalle $detalle = null)
    {
        $this->detalle = $detalle;
    
        return $this;
    }

    /**
     * Get detalle
     *
     * @return \Entidades\ServiceMe\TblServicecoSecAltoimpactoDetalle
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblServicecoPriAltoimpacto
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

