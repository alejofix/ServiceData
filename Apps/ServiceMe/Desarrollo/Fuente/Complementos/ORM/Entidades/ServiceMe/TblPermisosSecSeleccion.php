<?php

namespace Entidades\ServiceMe;

use Doctrine\ORM\Mapping as ORM;

/**
 * TblPermisosSecSeleccion
 *
 * @Table(name="tbl_permisos_sec_seleccion", indexes={@Index(name="IDX_A705E8EDC23F5584", columns={"PERMISO"}), @Index(name="IDX_A705E8ED1C0908B0", columns={"MODULO"}), @Index(name="IDX_A705E8EDF62113D5", columns={"BASE"})})
 * @Entity
 */
class TblPermisosSecSeleccion
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
     * @var \Entidades\ServiceMe\TblPermisosSecModulos
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblPermisosSecModulos")
     * @JoinColumns({
     *   @JoinColumn(name="MODULO", referencedColumnName="ID")
     * })
     */
    private $modulo;

    /**
     * @var \Entidades\ServiceMe\TblPermisos
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblPermisos")
     * @JoinColumns({
     *   @JoinColumn(name="PERMISO", referencedColumnName="ID")
     * })
     */
    private $permiso;

    /**
     * @var \Entidades\ServiceMe\TblPermisosSecBase
     *
     * @ManyToOne(targetEntity="Entidades\ServiceMe\TblPermisosSecBase")
     * @JoinColumns({
     *   @JoinColumn(name="BASE", referencedColumnName="ID")
     * })
     */
    private $base;


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
     * Set modulo
     *
     * @param \Entidades\ServiceMe\TblPermisosSecModulos $modulo
     *
     * @return TblPermisosSecSeleccion
     */
    public function setModulo(\Entidades\ServiceMe\TblPermisosSecModulos $modulo = null)
    {
        $this->modulo = $modulo;
    
        return $this;
    }

    /**
     * Get modulo
     *
     * @return \Entidades\ServiceMe\TblPermisosSecModulos
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * Set permiso
     *
     * @param \Entidades\ServiceMe\TblPermisos $permiso
     *
     * @return TblPermisosSecSeleccion
     */
    public function setPermiso(\Entidades\ServiceMe\TblPermisos $permiso = null)
    {
        $this->permiso = $permiso;
    
        return $this;
    }

    /**
     * Get permiso
     *
     * @return \Entidades\ServiceMe\TblPermisos
     */
    public function getPermiso()
    {
        return $this->permiso;
    }

    /**
     * Set base
     *
     * @param \Entidades\ServiceMe\TblPermisosSecBase $base
     *
     * @return TblPermisosSecSeleccion
     */
    public function setBase(\Entidades\ServiceMe\TblPermisosSecBase $base = null)
    {
        $this->base = $base;
    
        return $this;
    }

    /**
     * Get base
     *
     * @return \Entidades\ServiceMe\TblPermisosSecBase
     */
    public function getBase()
    {
        return $this->base;
    }
}

