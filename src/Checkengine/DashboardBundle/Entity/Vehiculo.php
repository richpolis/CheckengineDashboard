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
     * @ORM\Column(name="year", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $year;

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
     * @ORM\Column(name="combustible", type="string", length=255)
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $combustible;

    /**
     * @var integer
     *
     * @ORM\Column(name="transmision", type="string", length=255)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $transmision;

    /**
     * @var integer
     *
     * @ORM\Column(name="seguro", type="boolean")
     * 
     * @Serializer\Expose
     * @Serializer\Type("boolean")
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * 
     * @Serializer\Expose
     * @Serializer\Type("DateTime")
     */
    private $createdAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     * 
     * @Serializer\Expose
     * @Serializer\Type("DateTime")
     */
    private $updatedAt;
    
    const TIPO_CARRO = 1;
    const TIPO_MOTO = 2;
    const TIPO_CAMION = 3;


    static public $sTipo = array(
        self::TIPO_CARRO => 'Carro',
        self::TIPO_MOTO => 'Moto',
        self::TIPO_CAMION => 'Camion'
    );

    static function getPreferedTipo(){
        return array(self::TIPO_CARRO);
    }
    
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("stringTipo")
     */
    public function getStringTipo(){
        return self::$sTipo[$this->getTipo()];
    }

    static function getArrayTipo(){
        return self::$sTipo;
    }
    
    public function __toString() {
        return sprintf("%s %s %i",$this->marca,$this->modelo,$this->year);
    }
    
    public function __construct() {
        $this->tipo = self::TIPO_CARRO;
    }
	
	/*
     * Timestable
     */
    
    /**
     ** @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt())
        {
          $this->createdAt = new \DateTime();
        }
        if(!$this->getUpdatedAt())
        {
          $this->updatedAt = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updatedAt = new \DateTime();
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
     * Set year
     *
     * @param integer $year
     * @return Vehiculo
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Vehiculo
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Vehiculo
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
