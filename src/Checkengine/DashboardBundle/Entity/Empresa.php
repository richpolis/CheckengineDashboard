<?php

namespace Checkengine\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Checkengine\DashboardBundle\Entity\EmpresaRepository")
 */
class Empresa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="rut", type="string", length=255)
     */
    private $rut;

    /**
     * @var integer
     *
     * @ORM\Column(name="region", type="integer")
     */
    private $region;

    /**
     * @var integer
     *
     * @ORM\Column(name="comuna", type="integer")
     */
    private $comuna;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="especialidad", type="integer")
     */
    private $especialidad;

    /**
     * @var string
     *
     * @ORM\Column(name="horarios", type="string", length=255)
     */
    private $horarios;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_longitud", type="string", length=255)
     */
    private $ubicacionLongitud;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_latitutd", type="string", length=255)
     */
    private $ubicacionLatitutd;

    /**
     * @var integer
     *
     * @ORM\Column(name="comentarios", type="integer")
     */
    private $comentarios;

    /**
     * @var integer
     *
     * @ORM\Column(name="servicios", type="integer")
     */
    private $servicios;

    /**
     * @var string
     *
     * @ORM\Column(name="sucursal", type="string", length=255)
     */
    private $sucursal;


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
     * @return Empresa
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
     * Set direccion
     *
     * @param string $direccion
     * @return Empresa
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set rut
     *
     * @param string $rut
     * @return Empresa
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return string 
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set region
     *
     * @param integer $region
     * @return Empresa
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return integer 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set comuna
     *
     * @param integer $comuna
     * @return Empresa
     */
    public function setComuna($comuna)
    {
        $this->comuna = $comuna;

        return $this;
    }

    /**
     * Get comuna
     *
     * @return integer 
     */
    public function getComuna()
    {
        return $this->comuna;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     * @return Empresa
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set especialidad
     *
     * @param integer $especialidad
     * @return Empresa
     */
    public function setEspecialidad($especialidad)
    {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get especialidad
     *
     * @return integer 
     */
    public function getEspecialidad()
    {
        return $this->especialidad;
    }

    /**
     * Set horarios
     *
     * @param string $horarios
     * @return Empresa
     */
    public function setHorarios($horarios)
    {
        $this->horarios = $horarios;

        return $this;
    }

    /**
     * Get horarios
     *
     * @return string 
     */
    public function getHorarios()
    {
        return $this->horarios;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Empresa
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set ubicacionLongitud
     *
     * @param string $ubicacionLongitud
     * @return Empresa
     */
    public function setUbicacionLongitud($ubicacionLongitud)
    {
        $this->ubicacionLongitud = $ubicacionLongitud;

        return $this;
    }

    /**
     * Get ubicacionLongitud
     *
     * @return string 
     */
    public function getUbicacionLongitud()
    {
        return $this->ubicacionLongitud;
    }

    /**
     * Set ubicacionLatitutd
     *
     * @param string $ubicacionLatitutd
     * @return Empresa
     */
    public function setUbicacionLatitutd($ubicacionLatitutd)
    {
        $this->ubicacionLatitutd = $ubicacionLatitutd;

        return $this;
    }

    /**
     * Get ubicacionLatitutd
     *
     * @return string 
     */
    public function getUbicacionLatitutd()
    {
        return $this->ubicacionLatitutd;
    }

    /**
     * Set comentarios
     *
     * @param integer $comentarios
     * @return Empresa
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return integer 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set servicios
     *
     * @param integer $servicios
     * @return Empresa
     */
    public function setServicios($servicios)
    {
        $this->servicios = $servicios;

        return $this;
    }

    /**
     * Get servicios
     *
     * @return integer 
     */
    public function getServicios()
    {
        return $this->servicios;
    }

    /**
     * Set sucursal
     *
     * @param string $sucursal
     * @return Empresa
     */
    public function setSucursal($sucursal)
    {
        $this->sucursal = $sucursal;

        return $this;
    }

    /**
     * Get sucursal
     *
     * @return string 
     */
    public function getSucursal()
    {
        return $this->sucursal;
    }
}
