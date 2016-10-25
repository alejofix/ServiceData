<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblGeneralEstados
 *
 * @Table(name="tbl_general_estados", uniqueConstraints={@UniqueConstraint(name="NOMBRE", columns={"NOMBRE"})})
 * @Entity
 */
class TblGeneralEstados
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
     * @return TblGeneralEstados
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
}

