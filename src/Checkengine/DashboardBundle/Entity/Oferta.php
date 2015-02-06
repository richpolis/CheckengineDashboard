<?php

namespace Checkengine\DashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation as Serializer;

/**
 * Oferta
 *
 * @ORM\Table(name="ofertas")
 * @ORM\Entity(repositoryClass="Checkengine\DashboardBundle\Repository\OfertaRepository")
 * @ORM\HasLifecycleCallbacks()
 * 
 * @Serializer\ExclusionPolicy("all")
 */
class Oferta
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
     * @ORM\Column(name="titulo", type="string", length=255)
     * @Assert\NotBlank(message="Ingresa un titulo")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $titulo;
	
    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text")
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $descripcion;

    /**
     * @var integer (mensaje, banner u oferta)
     *
     * @ORM\Column(name="tipo", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $tipo;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_oferta", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $tipoOferta;
	
    /**
     * @var string
     *
     * @ORM\Column(name="oferta", type="string", length=255)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $oferta;

    /**
     * @var string
     *
     * @ORM\Column(name="banner", type="string", length=255)
     * 
     * @Serializer\Expose
     * @Serializer\Type("string")
     */
    private $banner;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="inicia", type="date")
     * 
     * @Serializer\Expose
     * @Serializer\Type("Date")
     */
    private $inicia;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="termina", type="date")
     * 
     * @Serializer\Expose
     * @Serializer\Type("Date")
     */
    private $termina;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_pago", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $tipoPago;

    /** relaciones **/
    
    /**
     * @var integer
     * @todo Sucursales de la oferta. 
     *
     * @ORM\ManyToMany(targetEntity="Checkengine\DashboardBundle\Entity\Empresa")
     * @ORM\JoinTable(name="oferta_sucursales")
     * @ORM\OrderBy({"nombre" = "ASC"})
     */
    private $sucursales;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="marcas", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $marcas;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="modelos", type="integer")
     * 
     * @Serializer\Expose
     * @Serializer\Type("integer")
     */
    private $modelos;
	
    /**
     * @var integer
     * @todo Comentarios de la oferta. 
     *
     * @ORM\ManyToMany(targetEntity="Checkengine\DashboardBundle\Entity\Comentario")
     * @ORM\JoinTable(name="oferta_comentarios")
     * @ORM\OrderBy({"createdAt" = "ASC"})
     */
    private $comentarios;

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
    
    const TIPO_OFERTA = 1;
    const TIPO_BANNER = 2;
    const TIPO_MENSAJE_1K = 3;
    const TIPO_MENSAJE_3K = 4;
    const TIPO_MENSAJE_5K = 5;
    const TIPO_MENSAJE_10K = 6;

    static public $sTipo = array(
        self::TIPO_OFERTA => 'Oferta',
        self::TIPO_BANNER => 'Banner',
        self::TIPO_MENSAJE_1K => 'Notificacion push 1km',
        self::TIPO_MENSAJE_3K => 'Notificacion push 3km',
        self::TIPO_MENSAJE_5K => 'Notificacion push 5km',
        self::TIPO_MENSAJE_10K => 'Notificacion push 10km'
    );

    static function getPreferedTipo(){
        return array(self::TIPO_OFERTA);
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
    
    const TIPO_OFERTA_DESCUENTO = 1;
    const TIPO_OFERTA_CANTIDAD = 2;

    static public $sTipoOferta = array(
        self::TIPO_OFERTA_DESCUENTO => 'Descuento',
        self::TIPO_OFERTA_CANTIDAD => 'Por cantidad'
    );

    static function getPreferedTipoOferta(){
        return array(self::TIPO_OFERTA_DESCUENTO);
    }
    
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("stringTipoOferta")
     */
    public function getStringTipoOferta(){
        return self::$sTipoOferta[$this->getTipoOferta()];
    }

    static function getArrayTipoOferta(){
        return self::$sTipoOferta;
    }
    
    const TIPO_PAGO_FACTURACION = 1;
    const TIPO_PAGO_TRANSFERENCIA = 2;

    static public $sTipoPago = array(
        self::TIPO_PAGO_FACTURACION => 'Facturacion',
        self::TIPO_PAGO_TRANSFERENCIA => 'Transferencia'
    );

    static function getPreferedTipoPago(){
        return array(self::TIPO_PAGO_FACTURACION);
    }
    
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("stringTipoPago")
     */
    public function getStringTipoPago(){
        return self::$sTipoPago[$this->getTipoPago()];
    }

    static function getArrayTipoPago(){
        return self::$sTipoPago;
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
        if (isset($this->banner)) {
            // store the old name to delete after the update
            $this->temp = $this->banner;
            $this->banner = null;
        } else {
            $this->banner = 'initial';
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
            $this->banner = $filename.'.'.$this->getFile()->guessExtension();
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
        $this->getFile()->move($this->getUploadRootDir(), $this->banner);

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
        return '/uploads/ofertas';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web'.$this->getUploadDir();
    }
    
    public function getWebPath()
    {
        return null === $this->banner ? null : $this->getUploadDir().'/'.$this->banner;
    }
    
    public function getThumbnailWebPath()
    {
        if(!file_exists($this->getAbosluteThumbnailPath())){
            if(file_exists($this->getAbsolutePath())){
                $this->crearThumbnail();
            }
        }
        return null === $this->banner ? null : $this->getUploadDir().'/thumbnails/'.$this->banner;
        
    }
    
    public function getAbsolutePath()
    {
        return null === $this->banner ? null : $this->getUploadRootDir().'/'.$this->banner;
    }
    
    public function getAbosluteThumbnailPath(){
        return null === $this->banner ? null : $this->getUploadRootDir().'/thumbnails/'.$this->banner;
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
        $this->sucursales = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comentarios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isActive = false;
        $this->tipo = self::TIPO_OFERTA;
        $this->tipoOferta = self::TIPO_OFERTA_DESCUENTO;
        $this->tipoPago = self::TIPO_PAGO_FACTURACION;
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Oferta
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
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
     * Set tipoOferta
     *
     * @param integer $tipoOferta
     * @return Oferta
     */
    public function setTipoOferta($tipoOferta)
    {
        $this->tipoOferta = $tipoOferta;

        return $this;
    }

    /**
     * Get tipoOferta
     *
     * @return integer 
     */
    public function getTipoOferta()
    {
        return $this->tipoOferta;
    }

    /**
     * Set oferta
     *
     * @param string $oferta
     * @return Oferta
     */
    public function setOferta($oferta)
    {
        $this->oferta = $oferta;

        return $this;
    }

    /**
     * Get oferta
     *
     * @return string 
     */
    public function getOferta()
    {
        return $this->oferta;
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
     * Set inicia
     *
     * @param \DateTime $inicia
     * @return Oferta
     */
    public function setInicia($inicia)
    {
        $this->inicia = $inicia;

        return $this;
    }

    /**
     * Get inicia
     *
     * @return \DateTime 
     */
    public function getInicia()
    {
        return $this->inicia;
    }

    /**
     * Set termina
     *
     * @param \DateTime $termina
     * @return Oferta
     */
    public function setTermina($termina)
    {
        $this->termina = $termina;

        return $this;
    }

    /**
     * Get termina
     *
     * @return \DateTime 
     */
    public function getTermina()
    {
        return $this->termina;
    }

    /**
     * Set tipoPago
     *
     * @param integer $tipoPago
     * @return Oferta
     */
    public function setTipoPago($tipoPago)
    {
        $this->tipoPago = $tipoPago;

        return $this;
    }

    /**
     * Get tipoPago
     *
     * @return integer 
     */
    public function getTipoPago()
    {
        return $this->tipoPago;
    }

    /**
     * Set marcas
     *
     * @param integer $marcas
     * @return Oferta
     */
    public function setMarcas($marcas)
    {
        $this->marcas = $marcas;

        return $this;
    }

    /**
     * Get marcas
     *
     * @return integer 
     */
    public function getMarcas()
    {
        return $this->marcas;
    }

    /**
     * Set modelos
     *
     * @param integer $modelos
     * @return Oferta
     */
    public function setModelos($modelos)
    {
        $this->modelos = $modelos;

        return $this;
    }

    /**
     * Get modelos
     *
     * @return integer 
     */
    public function getModelos()
    {
        return $this->modelos;
    }

    /**
     * Set clicks
     *
     * @param integer $clicks
     * @return Oferta
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
     * @return Oferta
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
     * @return Oferta
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
     * @return Oferta
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
     * Add sucursales
     *
     * @param \Checkengine\DashboardBundle\Entity\Empresa $sucursales
     * @return Oferta
     */
    public function addSucursale(\Checkengine\DashboardBundle\Entity\Empresa $sucursales)
    {
        $this->sucursales[] = $sucursales;

        return $this;
    }

    /**
     * Remove sucursales
     *
     * @param \Checkengine\DashboardBundle\Entity\Empresa $sucursales
     */
    public function removeSucursale(\Checkengine\DashboardBundle\Entity\Empresa $sucursales)
    {
        $this->sucursales->removeElement($sucursales);
    }

    /**
     * Get sucursales
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSucursales()
    {
        return $this->sucursales;
    }

    /**
     * Add comentarios
     *
     * @param \Checkengine\DashboardBundle\Entity\Comentario $comentarios
     * @return Oferta
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
}
