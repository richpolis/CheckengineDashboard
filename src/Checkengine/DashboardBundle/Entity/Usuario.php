<?php

namespace Checkengine\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Checkengine\DashboardBundle\Entity\UsuarioRepository")
 */
class Usuario
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
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=255)
     */
    private $celular;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date")
     */
    private $fechaNacimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="genero", type="integer")
     */
    private $genero;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_auto", type="integer")
     */
    private $tipoAuto;

    /**
     * @var string
     *
     * @ORM\Column(name="patente", type="string", length=255)
     */
    private $patente;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_longitud", type="string", length=255)
     */
    private $ubicacionLongitud;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_latitud", type="string", length=255)
     */
    private $ubicacionLatitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="favoritos", type="integer")
     */
    private $favoritos;

    /**
     * @var integer
     *
     * @ORM\Column(name="amigos", type="integer")
     */
    private $amigos;

    /**
     * @var integer
     *
     * @ORM\Column(name="no_ofertas", type="integer")
     */
    private $noOfertas;


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
     * @return Usuario
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
     * Set apellidos
     *
     * @param string $apellidos
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set celular
     *
     * @param string $celular
     * @return Usuario
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Usuario
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set genero
     *
     * @param integer $genero
     * @return Usuario
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return integer 
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set tipoAuto
     *
     * @param integer $tipoAuto
     * @return Usuario
     */
    public function setTipoAuto($tipoAuto)
    {
        $this->tipoAuto = $tipoAuto;

        return $this;
    }

    /**
     * Get tipoAuto
     *
     * @return integer 
     */
    public function getTipoAuto()
    {
        return $this->tipoAuto;
    }

    /**
     * Set patente
     *
     * @param string $patente
     * @return Usuario
     */
    public function setPatente($patente)
    {
        $this->patente = $patente;

        return $this;
    }

    /**
     * Get patente
     *
     * @return string 
     */
    public function getPatente()
    {
        return $this->patente;
    }

    /**
     * Set ubicacionLongitud
     *
     * @param string $ubicacionLongitud
     * @return Usuario
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
     * Set ubicacionLatitud
     *
     * @param string $ubicacionLatitud
     * @return Usuario
     */
    public function setUbicacionLatitud($ubicacionLatitud)
    {
        $this->ubicacionLatitud = $ubicacionLatitud;

        return $this;
    }

    /**
     * Get ubicacionLatitud
     *
     * @return string 
     */
    public function getUbicacionLatitud()
    {
        return $this->ubicacionLatitud;
    }

    /**
     * Set favoritos
     *
     * @param integer $favoritos
     * @return Usuario
     */
    public function setFavoritos($favoritos)
    {
        $this->favoritos = $favoritos;

        return $this;
    }

    /**
     * Get favoritos
     *
     * @return integer 
     */
    public function getFavoritos()
    {
        return $this->favoritos;
    }

    /**
     * Set amigos
     *
     * @param integer $amigos
     * @return Usuario
     */
    public function setAmigos($amigos)
    {
        $this->amigos = $amigos;

        return $this;
    }

    /**
     * Get amigos
     *
     * @return integer 
     */
    public function getAmigos()
    {
        return $this->amigos;
    }

    /**
     * Set noOfertas
     *
     * @param integer $noOfertas
     * @return Usuario
     */
    public function setNoOfertas($noOfertas)
    {
        $this->noOfertas = $noOfertas;

        return $this;
    }

    /**
     * Get noOfertas
     *
     * @return integer 
     */
    public function getNoOfertas()
    {
        return $this->noOfertas;
    }
}
