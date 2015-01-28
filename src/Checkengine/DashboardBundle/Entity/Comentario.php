<?php

namespace Checkengine\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comentario
 *
 * @ORM\Table(name="comentarios")
 * @ORM\Entity(repositoryClass="Checkengine\DashboardBundle\Repository\ComentarioRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Comentario
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
     * @var \Checkengine\DashboardBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="Checkengine\DashboardBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text")
     * @Assert\NotBlank(message="Ingresa tu comentario")
     */
    private $comentario;

    /**
     * @var integer
     *
     * @ORM\Column(name="calificacion", type="integer")
     */
    private $calificacion;
	
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
	
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

    
}
