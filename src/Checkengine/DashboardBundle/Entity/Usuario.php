<?php

namespace Checkengine\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use JMS\Serializer\Annotation as Serializer;

/**
 * Usuario
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="Checkengine\DashboardBundle\Repository\UsuarioRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("email")
 * 
 * @Serializer\ExclusionPolicy("all")
 */
class Usuario implements UserInterface, \Serializable 
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     * @Assert\NotBlank(message="Ingresa un nombre")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $apellidos;
    
    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=255, nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $region;
    
    /**
     * @var string
     *
     * @ORM\Column(name="comuna", type="string", length=255, nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $comuna;
	
    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank(message = "Por favor ingresa tu email")
     * @Assert\Email()
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
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
     * @ORM\Column(name="celular", type="string", length=255, nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $celular;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("DateTime<'Y-m-d'>")
     */
    private $fechaNacimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="genero", type="integer", nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $genero;

    /**
     * @var Vehiculo
     *
     * @ORM\OneToMany(targetEntity="Checkengine\DashboardBundle\Entity\Vehiculo", mappedBy="usuario")
     * 
     * @Serializer\Expose
     * @Serializer\Type("ArrayCollection<Checkengine\DashboardBundle\Entity\Vehiculo>")
     * @Serializer\MaxDepth(1)
     */
    private $vehiculos;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_longitud", type="string", length=255, nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $ubicacionLongitud;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_latitud", type="string", length=255, nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $ubicacionLatitud;

    /**
     * @var integer
     * @todo Favoritos del usuario.
     *
     * @ORM\ManyToMany(targetEntity="Checkengine\DashboardBundle\Entity\Empresa")
     * @ORM\JoinTable(name="usuario_favoritos")
     * @ORM\OrderBy({"nombre" = "ASC"})
     * 
     * @Serializer\Expose
     * @Serializer\Type("ArrayCollection<Checkengine\DashboardBundle\Entity\Empresa>")
     * @Serializer\MaxDepth(1)
     */
    private $favoritos;

    /**
     * @var integer
     * @todo Amigos del usuario. 
     *
     * @ORM\ManyToMany(targetEntity="Checkengine\DashboardBundle\Entity\Usuario")
     * @ORM\JoinTable(name="usuario_amigos")
     * @ORM\OrderBy({"nombre" = "ASC"})
     * 
     * @Serializer\Expose
     * @Serializer\Type("ArrayCollection<Checkengine\DashboardBundle\Entity\Usuario>")
     * @Serializer\MaxDepth(1)
     */
    private $amigos;

    /**
     * @var integer
     * @todo No recibir ofertas del usuario.
     *
     * @ORM\ManyToMany(targetEntity="Checkengine\DashboardBundle\Entity\Empresa")
     * @ORM\JoinTable(name="no_ofertas")
     * @ORM\OrderBy({"nombre" = "ASC"})
     * 
     * @Serializer\Expose
     * @Serializer\Type("ArrayCollection<Checkengine\DashboardBundle\Entity\Empresa>")
     * @Serializer\MaxDepth(1)
     */
    private $noOfertas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean")
     * 
     * @Serializer\Expose
     * @Serializer\Type("boolean")
     */
    private $isActive;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="grupo", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $grupo;
    
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
    
    /** 
     * @ORM\Column(name="facebook_id", type="string", length=255, nullable=true) 
     */
    protected $facebook_id;
 
    /** 
     * @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) 
     */
    protected $facebook_access_token;
    
    /**
     * @var string
     *
     * @ORM\Column(name="token_celular", type="string", length=255, nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $tokenCelular;
    
    /**
     * @var string
     *
     * @ORM\Column(name="marca_celular", type="string", length=255, nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $marcaCelular;
	
    const GRUPO_USUARIOS    = 1;
    const GRUPO_CLIENTES    = 2;
    const GRUPO_ADMIN       = 3;

    static public $sGrupo=array(
        self::GRUPO_USUARIOS    => 'Usuarios',
        self::GRUPO_CLIENTES    => 'Clientes',
        self::GRUPO_ADMIN       => 'Administradores'
    );

    static function getPreferedTipoGrupo(){
        return array(self::GRUPO_USUARIOS);
    }
    
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("stringGrupo")
     */
    public function getStringTipoGrupo(){
        $arreglo = self::$sGrupo;
        return $arreglo[$this->getGrupo()];
    }

    static function getArrayTipoGrupo(){
        $sTipoGrupo=array(
            self::GRUPO_USUARIOS => 'Usuarios',
            self::GRUPO_CLIENTES => 'Clientes'
        );
        return $sTipoGrupo;
    }
    
    const GENERO_MASCULINO    = 1;
    const GENERO_FEMENINO     = 2;
    
    static public $sGenero=array(
        self::GENERO_MASCULINO  => 'Masculino',
        self::GENERO_FEMENINO   => 'Femenino'
    );

    static function getPreferedGenero(){
        return array(self::GENERO_MASCULINO);
    }
    
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("stringGenero")
     */
    public function getStringGenero(){
        $arreglo = $this->getArrayGenero();
        return $arreglo[$this->getGenero()];
    }

    static function getArrayGenero(){
        return self::$sGenero;
    }

    public function __toString() {
        return $this->getNombreCompleto();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        // may not be needed, see section on salt below
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->isActive = true;
        $this->grupo = self::GRUPO_CLIENTES;
        $this->genero = self::GENERO_MASCULINO;
    }
    
	
    /**
     * @see UserInterface::getUsername
     */
    public function getUsername() {
        return $this->email;
    }


    /**
     * @see UserInterface::getRoles
     */
    public function getRoles() {

        if ($this->getGrupo() == self::GRUPO_USUARIOS) {
            return array('ROLE_USUARIO', 'ROLE_API');
        } elseif ($this->getGrupo() == self::GRUPO_CLIENTES) {
            return array('ROLE_CLIENTE', 'ROLE_API');
        } elseif ($this->getGrupo() == self::GRUPO_ADMIN) {
            return array('ROLE_ADMIN', 'ROLE_API');
        } else {
            return array('ROLE_SUPER_ADMIN', 'ROLE_API');
        }
    }

    /**
     * @see UserInterface::eraseCredentials
     */
    public function eraseCredentials() {
        
    }

    /**
     * Serializes the content of the current User object
     * @return string
     */
    public function serialize() {
        return \json_encode(
                array($this->nombre, 
                    $this->apellidos, 
                    $this->celular, 
                    $this->email, 
                    $this->isActive, 
                    $this->id)
        );
    }

    /**
     * @param $serialized
     */
    public function unserialize($serialized) {
        list($this->nombre, 
                $this->apellido, 
                $this->celular, 
                $this->email ,
                $this->isActive, 
                $this->id) = \json_decode($serialized);
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
    
    /*** uploads ***/
    
    /**
     * @Assert\File(maxSize="2M",maxSizeMessage="El archivo es demasiado grande. El tamaño máximo permitido es {{ limit }}")
     */
    public $file;
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->imagen)) {
            // store the old name to delete after the update
            $this->temp = $this->imagen;
            $this->imagen = null;
        } else {
            $this->imagen = 'initial';
        }
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
    public function preUpload()
    {
      if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->imagen = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
    * @ORM\PostPersist
    * @ORM\PostUpdate
    */
    public function upload()
    {
      if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->imagen);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            if(file_exists($this->getUploadRootDir().'/'.$this->temp)){
                unlink($this->getUploadRootDir().'/'.$this->temp);
            }
            // clear the temp image path
            $this->temp = null;
        }
        
        $this->crearThumbnail();
        
        $this->file = null;
    }
    
    /*
     * Crea el thumbnail y lo guarda en un carpeta dentro del webPath thumbnails
     * 
     * @return void
     */
    public function crearThumbnail($width=100,$height=100,$path=""){
        $imagine    = new \Imagine\Gd\Imagine();
        $collage    = $imagine->create(new \Imagine\Image\Box(100, 100));
        $mode       = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        $image      = $imagine->open($this->getAbsolutePath());
        $sizeImage  = $image->getSize();
        if(strlen($path)==0){
            $path = $this->getAbosluteThumbnailPath();
        }
        if($height == null){
            $height = $sizeImage->getHeight();
            if($height>100){
                $height = 100;
            }
        }
        if($width == null){
            $width = $sizeImage->getWidth();
            if($width>100){
                $width = 100;
            }
        }
        $size   =new \Imagine\Image\Box($width,$height);
        $image->thumbnail($size,$mode)->save($path);
        $image  = $imagine->open($path);
        $size = $image->getSize();
        if((100 - $size->getWidth())>1){
            $width = ceil((100 - $size->getWidth())/2);
        }else{
            $width = 0;
        }
        if((100 - $size->getHeight())>1){
            $height = ceil((100 - $size->getHeight())/2);
        }else{
            $height =0;
        }    
        $centrado = new \Imagine\Image\Point($width, $height);
        $collage->paste($image,$centrado);
        $collage->save($path);        
    }

    /**
    * @ORM\PostRemove
    */
    public function removeUpload()
    {
      if ($file = $this->getAbsolutePath()) {
        if(file_exists($file)){
            unlink($file);
        }
      }
      if($thumbnail=$this->getAbosluteThumbnailPath()){
         if(file_exists($thumbnail)){
            unlink($thumbnail);
        }
      }
    }
    
    protected function getUploadDir()
    {
        return '/uploads/usuarios';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web'.$this->getUploadDir();
    }
    
    public function getWebPath()
    {
        return null === $this->imagen ? null : $this->getUploadDir().'/'.$this->imagen;
    }
    
    public function getThumbnailWebPath()
    {
        if(!file_exists($this->getAbosluteThumbnailPath())){
            if(file_exists($this->getAbsolutePath())){
                $this->crearThumbnail();
            }
        }
        return null === $this->imagen ? null : $this->getUploadDir().'/thumbnails/'.$this->imagen;
        
    }
    
    public function getAbsolutePath()
    {
        return null === $this->imagen ? null : $this->getUploadRootDir().'/'.$this->imagen;
    }
    
    public function getAbosluteThumbnailPath(){
        return null === $this->imagen ? null : $this->getUploadRootDir().'/thumbnails/'.$this->imagen;
    }
	
    public function getNombreCompleto() 
    {
        return sprintf("%s %s", $this->nombre, $this->apellidos);
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

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
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
     * Set imagen
     *
     * @param string $imagen
     * @return Usuario
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Usuario
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set grupo
     *
     * @param integer $grupo
     * @return Usuario
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return integer 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Usuario
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
     * @return Usuario
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

    /**
     * Set facebook_id
     *
     * @param string $facebookId
     * @return Usuario
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebook_access_token
     *
     * @param string $facebookAccessToken
     * @return Usuario
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebook_access_token
     *
     * @return string 
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Add vehiculos
     *
     * @param \Checkengine\DashboardBundle\Entity\Vehiculo $vehiculos
     * @return Usuario
     */
    public function addVehiculo(\Checkengine\DashboardBundle\Entity\Vehiculo $vehiculos)
    {
        $this->vehiculos[] = $vehiculos;

        return $this;
    }

    /**
     * Remove vehiculos
     *
     * @param \Checkengine\DashboardBundle\Entity\Vehiculo $vehiculos
     */
    public function removeVehiculo(\Checkengine\DashboardBundle\Entity\Vehiculo $vehiculos)
    {
        $this->vehiculos->removeElement($vehiculos);
    }

    /**
     * Get vehiculos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehiculos()
    {
        return $this->vehiculos;
    }

    /**
     * Set tokenCelular
     *
     * @param string $tokenCelular
     * @return Usuario
     */
    public function setTokenCelular($tokenCelular)
    {
        $this->tokenCelular = $tokenCelular;

        return $this;
    }

    /**
     * Get tokenCelular
     *
     * @return string 
     */
    public function getTokenCelular()
    {
        return $this->tokenCelular;
    }

    /**
     * Set marcaCelular
     *
     * @param string $marcaCelular
     * @return Usuario
     */
    public function setMarcaCelular($marcaCelular)
    {
        $this->marcaCelular = $marcaCelular;

        return $this;
    }

    /**
     * Get marcaCelular
     *
     * @return string 
     */
    public function getMarcaCelular()
    {
        return $this->marcaCelular;
    }

    /**
     * Add favoritos
     *
     * @param \Checkengine\DashboardBundle\Entity\Empresa $favoritos
     * @return Usuario
     */
    public function addFavorito(\Checkengine\DashboardBundle\Entity\Empresa $favoritos)
    {
        $this->favoritos[] = $favoritos;

        return $this;
    }

    /**
     * Remove favoritos
     *
     * @param \Checkengine\DashboardBundle\Entity\Empresa $favoritos
     */
    public function removeFavorito(\Checkengine\DashboardBundle\Entity\Empresa $favoritos)
    {
        $this->favoritos->removeElement($favoritos);
    }

    /**
     * Get favoritos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavoritos()
    {
        return $this->favoritos;
    }

    /**
     * Add amigos
     *
     * @param \Checkengine\DashboardBundle\Entity\Usuario $amigos
     * @return Usuario
     */
    public function addAmigo(\Checkengine\DashboardBundle\Entity\Usuario $amigos)
    {
        $this->amigos[] = $amigos;

        return $this;
    }

    /**
     * Remove amigos
     *
     * @param \Checkengine\DashboardBundle\Entity\Usuario $amigos
     */
    public function removeAmigo(\Checkengine\DashboardBundle\Entity\Usuario $amigos)
    {
        $this->amigos->removeElement($amigos);
    }

    /**
     * Get amigos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAmigos()
    {
        return $this->amigos;
    }

    /**
     * Add noOfertas
     *
     * @param \Checkengine\DashboardBundle\Entity\Empresa $noOfertas
     * @return Usuario
     */
    public function addNoOferta(\Checkengine\DashboardBundle\Entity\Empresa $noOfertas)
    {
        $this->noOfertas[] = $noOfertas;

        return $this;
    }

    /**
     * Remove noOfertas
     *
     * @param \Checkengine\DashboardBundle\Entity\Empresa $noOfertas
     */
    public function removeNoOferta(\Checkengine\DashboardBundle\Entity\Empresa $noOfertas)
    {
        $this->noOfertas->removeElement($noOfertas);
    }

    /**
     * Get noOfertas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNoOfertas()
    {
        return $this->noOfertas;
    }

    /**
     * Set region
     *
     * @param string $region
     * @return Usuario
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set comuna
     *
     * @param string $comuna
     * @return Usuario
     */
    public function setComuna($comuna)
    {
        $this->comuna = $comuna;

        return $this;
    }

    /**
     * Get comuna
     *
     * @return string 
     */
    public function getComuna()
    {
        return $this->comuna;
    }
}
