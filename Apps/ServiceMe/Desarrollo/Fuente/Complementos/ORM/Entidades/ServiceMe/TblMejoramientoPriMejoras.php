<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblMejoramientoPriMejoras
 *
 * @Table(name="tbl_mejoramiento_pri_mejoras", indexes={@Index(name="IDX_DF7FF8751D204E47", columns={"USUARIO"}), @Index(name="IDX_DF7FF87561889A59", columns={"PRODUCTO"}), @Index(name="IDX_DF7FF875D6A52665", columns={"ESTADO"})})
 * @Entity
 */
class TblMejoramientoPriMejoras
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
     * @Column(name="HERRAMIENTA", type="string", length=255, nullable=false)
     */
    private $herramienta;

    /**
     * @var string
     *
     * @Column(name="ARBOL", type="string", length=255, nullable=false)
     */
    private $arbol;

    /**
     * @var string
     *
     * @Column(name="TITULO", type="string", length=255, nullable=false)
     */
    private $titulo;

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
     * @var \Entidades\ServiceMe\TblGeneralServicios
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblGeneralServicios")
     * @JoinColumns({
     *   @JoinColumn(name="PRODUCTO", referencedColumnName="ID")
     * })
     */
    private $producto;

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
	 * @OneToMany(targetEntity="Entidades\ServiceMe\TblMejoramientoSecMejorasObjetivos", mappedBy="mejora")
	 */
	private $objetivos;
	
	public function getObjetivos() {
		return $this->objetivos;
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return TblMejoramientoPriMejoras
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
     * Set herramienta
     *
     * @param string $herramienta
     *
     * @return TblMejoramientoPriMejoras
     */
    public function setHerramienta($herramienta)
    {
        $this->herramienta = $herramienta;
    
        return $this;
    }

    /**
     * Get herramienta
     *
     * @return string
     */
    public function getHerramienta()
    {
        return $this->herramienta;
    }

    /**
     * Set arbol
     *
     * @param string $arbol
     *
     * @return TblMejoramientoPriMejoras
     */
    public function setArbol($arbol)
    {
        $this->arbol = $arbol;
    
        return $this;
    }

    /**
     * Get arbol
     *
     * @return string
     */
    public function getArbol()
    {
        return $this->arbol;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return TblMejoramientoPriMejoras
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TblMejoramientoPriMejoras
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
     * @return TblMejoramientoPriMejoras
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
     * Set producto
     *
     * @param \Entidades\ServiceMe\TblGeneralServicios $producto
     *
     * @return TblMejoramientoPriMejoras
     */
    public function setProducto(\Entidades\ServiceMe\TblGeneralServicios $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \Entidades\ServiceMe\TblGeneralServicios
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set estado
     *
     * @param \Entidades\ServiceMe\TblGeneralEstados $estado
     *
     * @return TblMejoramientoPriMejoras
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

