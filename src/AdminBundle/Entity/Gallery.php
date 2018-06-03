<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * Gallery
 *
 * @ORM\Table("gallery")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 */
class Gallery
{
    use HasUploadedDocumentTrait;

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
     * @ORM\Column(name="name_hy", type="string", length=255, nullable=true)
     */
    private $nameHy;

    /**
     * @var string
     *
     * @ORM\Column(name="name_en", type="string", length=255, nullable=true)
     */
    private $nameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    protected $fileFieldName = "photo";

    protected function getUploadDir()
    {
        return '/i/gallery/';
    }

    public function __toString()
    {
        return (string)$this->getNameEn();
    }

    public function serialize($lang = null)
    {
        if (substr($this->getPhoto(), 0, 4) == 'http') {
            $photo = $this->getPhoto();
        } else {
            $photo = "http://api.barcamp.am" . $this->getPhoto();
        }

        if (is_null($lang)) {
            $result = array(
                'id'             => $this->getId(),
                'en'             => array(
                    'name'  => $this->getNameEn(),
                ),
                'hy'             => array(
                    'name'  => $this->getNameHy(),
                ),
                'photo'          => $photo, // "http://api.barcamp.am". $this->getPhoto(),
            );
        } else {
            if ($lang == 'hy') {
                $result = array(
                    'id'             => $this->getId(),
                    'hy'             => array(
                        'name'  => $this->getNameHy(),
                    ),
                    'photo'          => $photo, // "http://api.barcamp.am". $this->getPhoto(),
                );
            } else {
                if ($lang == 'en') {
                    $result = array(
                        'id'             => $this->getId(),
                        'en'             => array(
                            'name'  => $this->getNameEn(),
                        ),
                        'photo'          => $photo, // "http://api.barcamp.am". $this->getPhoto(),
                    );
                }
            }
        }

        return $result;
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
     * Set nameHy
     *
     * @param string $nameHy
     * @return Gallery
     */
    public function setNameHy($nameHy)
    {
        $this->nameHy = $nameHy;

        return $this;
    }

    /**
     * Get nameHy
     *
     * @return string
     */
    public function getNameHy()
    {
        return $this->nameHy;
    }

    /**
     * Set nameEn
     *
     * @param string $nameEn
     * @return Gallery
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameEn
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Gallery
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
