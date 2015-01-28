<?php

namespace Checkengine\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oferta
 *
 * @ORM\Table(name="ofertas")
 * @ORM\Entity(repositoryClass="Checkengine\DashboardBundle\Repository\OfertaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Oferta
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;
	
	/**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     */
    private $tipo;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="tipo_oferta", type="integer")
     */
    private $tipoOferta;
	
	/**
     * @var string
     *
     * @ORM\Column(name="oferta", type="string", length=255)
     */
    private $oferta;

    /**
     * @var string
     *
     * @ORM\Column(name="banner", type="string", length=255)
     */
    private $banner;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="inicia", type="date")
     */
    private $inicia;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="termina", type="date")
     */
    private $termina;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_pago", type="integer")
     */
    private $tipoPago;

	/** relaciones **/	
    /**
     * @var integer
     *
     * @ORM\Column(name="sucursales", type="integer")
     */
    private $sucursales;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="marcas", type="integer")
     */
    private $marcas;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="modelos", type="integer")
     */
    private $modelos;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="comentarios", type="integer")
     */
    private $comentarios;

    /**
     * @var integer
     *
     * @ORM\Column(name="clicks", type="integer")
     */
    private $clicks;
	
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
     * Set sucursales
     *
     * @param integer $sucursales
     * @return Oferta
     */
    public function setSucursales($sucursales)
    {
        $this->sucursales = $sucursales;

        return $this;
    }

    /**
     * Get sucursales
     *
     * @return integer 
     */
    public function getSucursales()
    {
        return $this->sucursales;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Oferta
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
     * Set tipo
     *
     * @param integer $tipo
     * @return Oferta
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
     * Set banner
     *
     * @param string $banner
     * @return Oferta
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner
     *
     * @return string 
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * Set formaPago
     *
     * @param integer $formaPago
     * @return Oferta
     */
    public function setFormaPago($formaPago)
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return integer 
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }
}
