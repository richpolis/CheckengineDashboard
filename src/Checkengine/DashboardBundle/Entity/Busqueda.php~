<?php

namespace Checkengine\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Busqueda
 *
 * @ORM\Table(name="busquedas")
 * @ORM\Entity(repositoryClass="Checkengine\DashboardBundle\Repository\BusquedaRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @Serializer\ExclusionPolicy("all")
 * 
 */
class Busqueda
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
     * @var \Checkengine\DashboardBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Checkengine\DashboardBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     * 
     * @Serializer\Expose
     * @Serializer\Type("Checkengine\DashboardBundle\Entity\Usuario")
     * @Serializer\Groups({"list", "details"})
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="busca", type="string", length=255)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $busca;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="clicks", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $clicks;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * 
     * @Serializer\Expose
     * @Serializer\Type("DateTime")
     */
    private $createdAt;
    
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set busca
     *
     * @param string $busca
     * @return Busqueda
     */
    public function setBusca($busca)
    {
        $this->busca = $busca;

        return $this;
    }

    /**
     * Get busca
     *
     * @return string 
     */
    public function getBusca()
    {
        return $this->busca;
    }

    /**
     * Set clicks
     *
     * @param integer $clicks
     * @return Busqueda
     */
    public function setClicks($clicks)
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * Get clicks
     *
     * @return integer 
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Busqueda
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
     * Set usuario
     *
     * @param \Checkengine\DashboardBundle\Entity\Usuario $usuario
     * @return Busqueda
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
