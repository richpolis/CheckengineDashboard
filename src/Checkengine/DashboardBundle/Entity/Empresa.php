<?php

namespace Checkengine\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use JMS\Serializer\Annotation as Serializer;

/**
 * Empresa
 *
 * @ORM\Table(name="empresas")
 * @ORM\Entity(repositoryClass="Checkengine\DashboardBundle\Repository\EmpresaRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @Serializer\ExclusionPolicy("all")
 */
class Empresa
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
     * @Assert\NotBlank(message="Ingresa el nombre de la empresa o razon social")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $nombre;
    
    /**
     * @var text
     *
     * @ORM\Column(name="rubro", type="text",nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $rubro;
	
	
    /**
     * @var string
     *
     * @ORM\Column(name="sucursal", type="string", length=255,nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $sucursal;
	
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
     * @ORM\Column(name="direccion", type="text",nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="rut", type="string", length=255,nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $rut;

    /**
     * @var integer
     *
     * @ORM\Column(name="region", type="string",nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $region;

    /**
     * @var integer
     *
     * @ORM\Column(name="comuna", type="string",nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $comuna;

    /**
     * @var integer
     * @todo Tipos de empresa asociadas a esta empresa. 
     *
     * @ORM\ManyToMany(targetEntity="Checkengine\DashboardBundle\Entity\TipoEmpresa")
     * @ORM\JoinTable(name="empresa_tipos")
     * @ORM\OrderBy({"nombre" = "ASC"})
     * 
     * @Serializer\Expose
     * @Serializer\Type("ArrayCollection<Checkengine\DashboardBundle\Entity\TipoEmpresa>")
     * @Serializer\MaxDepth(1)
     * @Serializer\Groups({"details"})
     */
    private $tipos;

    /**
     * @var integer
     * @todo Tipos de empresa asociadas a esta empresa. 
     *
     * @ORM\ManyToMany(targetEntity="Checkengine\DashboardBundle\Entity\Especialidad")
     * @ORM\JoinTable(name="empresa_especialidades")
     * @ORM\OrderBy({"nombre" = "ASC"})
     * 
     * @Serializer\Expose
     * @Serializer\Type("ArrayCollection<Checkengine\DashboardBundle\Entity\Especialidad>")
     * @Serializer\MaxDepth(1)
     * @Serializer\Groups({"details"})
     */
    private $especialidades;

    /**
     * @var string
     *
     * @ORM\Column(name="horarios", type="string", length=255,nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $horarios;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255,nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_longitud", type="string", length=255,nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $ubicacionLongitud;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_latitud", type="string", length=255,nullable=true)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $ubicacionLatitud;

    /**
     * @var integer
     * @todo Comentarios de la empresa. 
     *
     * @ORM\ManyToMany(targetEntity="Checkengine\DashboardBundle\Entity\Comentario")
     * @ORM\JoinTable(name="empresa_comentarios")
     * @ORM\OrderBy({"createdAt" = "ASC"})
     */
    private $comentarios;

    /**
     * @var integer
     * @todo Servicios de la empresa. 
     *
     * @ORM\ManyToMany(targetEntity="Checkengine\DashboardBundle\Entity\Servicio")
     * @ORM\JoinTable(name="empresa_servicios")
     * @ORM\OrderBy({"nombre" = "ASC"})
     * 
     * @Serializer\Expose
     * @Serializer\Type("ArrayCollection<Checkengine\DashboardBundle\Entity\Servicio>")
     * @Serializer\MaxDepth(1)
     * @Serializer\Groups({"details"})
     */
    private $servicios;

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
        return '/uploads/empresas';
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
    
    public function getNombreCompleto(){
        return sprintf("%s - %s",$this->getNombre(),$this->getSucursal());
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
     * Constructor
     */
    public function __construct()
    {
        $this->tipos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->especialidades = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comentarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->servicios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isActive = true;
    }
    
    public function __toString() {
        return $this->getNombreCompleto();
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
     * Set ubicacionLatitud
     *
     * @param string $ubicacionLatitud
     * @return Empresa
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
     * @return Empresa
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Empresa
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
     * @return Empresa
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
     * Set usuario
     *
     * @param \Checkengine\DashboardBundle\Entity\Usuario $usuario
     * @return Empresa
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
     * Add tipos
     *
     * @param \Checkengine\DashboardBundle\Entity\TipoEmpresa $tipos
     * @return Empresa
     */
    public function addTipo(\Checkengine\DashboardBundle\Entity\TipoEmpresa $tipos)
    {
        $this->tipos[] = $tipos;

        return $this;
    }

    /**
     * Remove tipos
     *
     * @param \Checkengine\DashboardBundle\Entity\TipoEmpresa $tipos
     */
    public function removeTipo(\Checkengine\DashboardBundle\Entity\TipoEmpresa $tipos)
    {
        $this->tipos->removeElement($tipos);
    }

    /**
     * Get tipos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTipos()
    {
        return $this->tipos;
    }

    /**
     * Add especialidades
     *
     * @param \Checkengine\DashboardBundle\Entity\Especialidad $especialidades
     * @return Empresa
     */
    public function addEspecialidade(\Checkengine\DashboardBundle\Entity\Especialidad $especialidades)
    {
        $this->especialidades[] = $especialidades;

        return $this;
    }

    /**
     * Remove especialidades
     *
     * @param \Checkengine\DashboardBundle\Entity\Especialidad $especialidades
     */
    public function removeEspecialidade(\Checkengine\DashboardBundle\Entity\Especialidad $especialidades)
    {
        $this->especialidades->removeElement($especialidades);
    }

    /**
     * Get especialidades
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEspecialidades()
    {
        return $this->especialidades;
    }

    /**
     * Add comentarios
     *
     * @param \Checkengine\DashboardBundle\Entity\Comentario $comentarios
     * @return Empresa
     */
    public function addComentario(\Checkengine\DashboardBundle\Entity\Comentario $comentarios)
    {
        $this->comentarios[] = $comentarios;

        return $this;
    }

    /**
     * Remove comentarios
     *
     * @param \Checkengine\DashboardBundle\Entity\Comentario $comentarios
     */
    public function removeComentario(\Checkengine\DashboardBundle\Entity\Comentario $comentarios)
    {
        $this->comentarios->removeElement($comentarios);
    }

    /**
     * Get comentarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Add servicios
     *
     * @param \Checkengine\DashboardBundle\Entity\Servicio $servicios
     * @return Empresa
     */
    public function addServicio(\Checkengine\DashboardBundle\Entity\Servicio $servicios)
    {
        $this->servicios[] = $servicios;

        return $this;
    }

    /**
     * Remove servicios
     *
     * @param \Checkengine\DashboardBundle\Entity\Servicio $servicios
     */
    public function removeServicio(\Checkengine\DashboardBundle\Entity\Servicio $servicios)
    {
        $this->servicios->removeElement($servicios);
    }

    /**
     * Get servicios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServicios()
    {
        return $this->servicios;
    }

    /**
     * Set rubro
     *
     * @param string $rubro
     * @return Empresa
     */
    public function setRubro($rubro)
    {
        $this->rubro = $rubro;

        return $this;
    }

    /**
     * Get rubro
     *
     * @return string 
     */
    public function getRubro()
    {
        return $this->rubro;
    }
}
