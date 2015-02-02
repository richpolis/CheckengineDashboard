<?php

namespace Checkengine\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;

/**
 * Vehiculo
 *
 * @ORM\Table(name="vehiculos")
 * @ORM\Entity(repositoryClass="Checkengine\DashboardBundle\Repository\VehiculoRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @Serializer\ExclusionPolicy("all")
 * 
 */
class Vehiculo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=255)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=255)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $modelo;

    /**
     * @var integer
     *
     * @ORM\Column(name="año", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $año;

    /**
     * @var integer
     *
     * @ORM\Column(name="puertas", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $puertas;

    /**
     * @var integer
     *
     * @ORM\Column(name="cilindros", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $cilindros;

    /**
     * @var integer
     *
     * @ORM\Column(name="kms", type="bigint")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $kms;

    /**
     * @var integer
     *
     * @ORM\Column(name="combustible", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $combustible;

    /**
     * @var integer
     *
     * @ORM\Column(name="transmision", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $transmision;

    /**
     * @var integer
     *
     * @ORM\Column(name="seguro", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $seguro;

    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="Checkengine\DashboardBundle\Entity\Usuario", inversedBy="vehiculos")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * 
     * @Serializer\Expose
     * @Serializer\Type("Checkengine\DashboardBundle\Entity\Usuario")
     */
    private $usuario;
    

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
     * Set tipo
     *
     * @param integer $tipo
     * @return Vehiculo
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
     * Set marca
     *
     * @param string $marca
     * @return Vehiculo
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Vehiculo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set año
     *
     * @param integer $año
     * @return Vehiculo
     */
    public function setAño($año)
    {
        $this->año = $año;

        return $this;
    }

    /**
     * Get año
     *
     * @return integer 
     */
    public function getAño()
    {
        return $this->año;
    }

    /**
     * Set puertas
     *
     * @param integer $puertas
     * @return Vehiculo
     */
    public function setPuertas($puertas)
    {
        $this->puertas = $puertas;

        return $this;
    }

    /**
     * Get puertas
     *
     * @return integer 
     */
    public function getPuertas()
    {
        return $this->puertas;
    }

    /**
     * Set cilindros
     *
     * @param integer $cilindros
     * @return Vehiculo
     */
    public function setCilindros($cilindros)
    {
        $this->cilindros = $cilindros;

        return $this;
    }

    /**
     * Get cilindros
     *
     * @return integer 
     */
    public function getCilindros()
    {
        return $this->cilindros;
    }

    /**
     * Set kms
     *
     * @param integer $kms
     * @return Vehiculo
     */
    public function setKms($kms)
    {
        $this->kms = $kms;

        return $this;
    }

    /**
     * Get kms
     *
     * @return integer 
     */
    public function getKms()
    {
        return $this->kms;
    }

    /**
     * Set combustible
     *
     * @param integer $combustible
     * @return Vehiculo
     */
    public function setCombustible($combustible)
    {
        $this->combustible = $combustible;

        return $this;
    }

    /**
     * Get combustible
     *
     * @return integer 
     */
    public function getCombustible()
    {
        return $this->combustible;
    }

    /**
     * Set transmision
     *
     * @param integer $transmision
     * @return Vehiculo
     */
    public function setTransmision($transmision)
    {
        $this->transmision = $transmision;

        return $this;
    }

    /**
     * Get transmision
     *
     * @return integer 
     */
    public function getTransmision()
    {
        return $this->transmision;
    }

    /**
     * Set seguro
     *
     * @param integer $seguro
     * @return Vehiculo
     */
    public function setSeguro($seguro)
    {
        $this->seguro = $seguro;

        return $this;
    }

    /**
     * Get seguro
     *
     * @return integer 
     */
    public function getSeguro()
    {
        return $this->seguro;
    }

    /**
     * Set usuario
     *
     * @param \Checkengine\DashboardBundle\Entity\Usuario $usuario
     * @return Vehiculo
     */
    public function setUsuario(\Checkengine\DashboardBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Checkengine\DashboardBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
