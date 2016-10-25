<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblPermisosSecBase
 *
 * @Table(name="tbl_permisos_sec_base")
 * @Entity
 */
class TblPermisosSecBase
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
     * @var integer
     *
     * @Column(name="LECTURA", type="integer", nullable=false)
     */
    private $lectura;

    /**
     * @var integer
     *
     * @Column(name="ESCRITURA", type="integer", nullable=false)
     */
    private $escritura;

    /**
     * @var integer
     *
     * @Column(name="ELIMINAR", type="integer", nullable=false)
     */
    private $eliminar;

    /**
     * @var integer
     *
     * @Column(name="ACTUALIZAR", type="integer", nullable=false)
     */
    private $actualizar;


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
     * Set lectura
     *
     * @param integer $lectura
     *
     * @return TblPermisosSecBase
     */
    public function setLectura($lectura)
    {
        $this->lectura = $lectura;
    
        return $this;
    }

    /**
     * Get lectura
     *
     * @return integer
     */
    public function getLectura()
    {
        return $this->lectura;
    }

    /**
     * Set escritura
     *
     * @param integer $escritura
     *
     * @return TblPermisosSecBase
     */
    public function setEscritura($escritura)
    {
        $this->escritura = $escritura;
    
        return $this;
    }

    /**
     * Get escritura
     *
     * @return integer
     */
    public function getEscritura()
    {
        return $this->escritura;
    }

    /**
     * Set eliminar
     *
     * @param integer $eliminar
     *
     * @return TblPermisosSecBase
     */
    public function setEliminar($eliminar)
    {
        $this->eliminar = $eliminar;
    
        return $this;
    }

    /**
     * Get eliminar
     *
     * @return integer
     */
    public function getEliminar()
    {
        return $this->eliminar;
    }

    /**
     * Set actualizar
     *
     * @param integer $actualizar
     *
     * @return TblPermisosSecBase
     */
    public function setActualizar($actualizar)
    {
        $this->actualizar = $actualizar;
    
        return $this;
    }

    /**
     * Get actualizar
     *
     * @return integer
     */
    public function getActualizar()
    {
        return $this->actualizar;
    }
}

