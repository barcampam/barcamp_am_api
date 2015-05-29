<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * Speaker
 *
 * @ORM\Table("speaker")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
*/
class Speaker
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
     * @ORM\Column(name="bio_hy", type="text", nullable=true)
     */
    private $bioHy;

    /**
     * @var string
     *
     * @ORM\Column(name="bio_en", type="text", nullable=true)
     */
    private $bioEn;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation_topic_hy", type="string", length=255, nullable=true)
     */
    private $presentationTopicHy;

    /**
     * @var string
     *
     * @ORM\Column(name="presentation_topic_en", type="string", length=255, nullable=true)
     */
    private $presentationTopicEn;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string", length=255, nullable=true)
     */
    private $twitter;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @var string
     *
     * @ORM\Column(name="linkedin", type="string", length=255, nullable=true)
     */
    private $linkedin;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    protected $fileFieldName = "photo";

    protected function getUploadDir()
    {
        return '/i/speaker/';
    }    

    public function __toString()
    {
        return (string)$this->getNameEn();
    }

    public function serialize()
    {
    
        $result = [
            'id' => $this->getId(),
            'en' => ['name' => $this->getNameEn(), 'topic' => $this->getPresentationTopicHy(), 'bio' => $this->getBioEn()],
            'hy' => ['name' => $this->getNameHy(), 'topic' => $this->getPresentationTopicHy(), 'bio' => $this->getBioHy()],
            'photo' => "http://api.barcamp.am". $this->getPhoto(),
            'socialnetworks' => [
                'facbook' => $this->getFacebook(),
                'twitter' => $this->getTwitter(),
                'instagram' => $this->getInstagram(),
                'linkedin' => $this->getLinkedin(),
            ]
            
        ];  
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
     * @return Speaker
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
     * @return Speaker
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
     * Set bioHy
     *
     * @param string $bioHy
     * @return Speaker
     */
    public function setBioHy($bioHy)
    {
        $this->bioHy = $bioHy;

        return $this;
    }

    /**
     * Get bioHy
     *
     * @return string 
     */
    public function getBioHy()
    {
        return $this->bioHy;
    }

    /**
     * Set bioEn
     *
     * @param string $bioEn
     * @return Speaker
     */
    public function setBioEn($bioEn)
    {
        $this->bioEn = $bioEn;

        return $this;
    }

    /**
     * Get bioEn
     *
     * @return string 
     */
    public function getBioEn()
    {
        return $this->bioEn;
    }

    /**
     * Set presentationTopicHy
     *
     * @param string $presentationTopicHy
     * @return Speaker
     */
    public function setPresentationTopicHy($presentationTopicHy)
    {
        $this->presentationTopicHy = $presentationTopicHy;

        return $this;
    }

    /**
     * Get presentationTopicHy
     *
     * @return string 
     */
    public function getPresentationTopicHy()
    {
        return $this->presentationTopicHy;
    }

    /**
     * Set presentationTopicEn
     *
     * @param string $presentationTopicEn
     * @return Speaker
     */
    public function setPresentationTopicEn($presentationTopicEn)
    {
        $this->presentationTopicEn = $presentationTopicEn;

        return $this;
    }

    /**
     * Get presentationTopicEn
     *
     * @return string 
     */
    public function getPresentationTopicEn()
    {
        return $this->presentationTopicEn;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Speaker
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

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return Speaker
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     * @return Speaker
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set Website
     *
     * @param string $Website
     * @return Speaker
     */
    public function setWebsite($Website)
    {
        $this->website = $Website;

        return $this;
    }

    /**
     * Get Website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }


    /**
     * Set instagram
     *
     * @param string $instagram
     * @return Speaker
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get instagram
     *
     * @return string 
     */
    public function getInstagram()
    {
        return $this->instagram;
    }

    /**
     * Set linkedin
     *
     * @param string $linkedin
     * @return Speaker
     */
    public function setLinkedin($linkedin)
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    /**
     * Get linkedin
     *
     * @return string 
     */
    public function getLinkedin()
    {
        return $this->linkedin;
    }
    
}
