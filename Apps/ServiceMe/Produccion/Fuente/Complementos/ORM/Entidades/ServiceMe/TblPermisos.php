<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblPermisos
 *
 * @Table(name="tbl_permisos", uniqueConstraints={@UniqueConstraint(name="NOMBRE", columns={"NOMBRE"})}, indexes={@Index(name="IDX_4CB4267DD6A52665", columns={"ESTADO"})})
 * @Entity
 */
class TblPermisos
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
     * @return TblPermisos
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
     * @return TblPermisos
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

