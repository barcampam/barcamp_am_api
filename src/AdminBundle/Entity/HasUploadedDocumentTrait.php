<?php

namespace AdminBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait HasUploadedDocumentTrait
{
    /**
     * @Assert\File(maxSize="1000000000")
     */
    protected $file;
    private $temp;

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getAbsolutePath($filename = null)
    {
        return $this->getUploadRootDir().$this->getUploadDir().$filename;
    }

    public function getWebPath($filename = null)
    {
        return $this->getUploadDir().$filename;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web';
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return '/i';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        var_dump("asdf");
        die();
        if (null !== $this->getFile()) {
            $field = $this->fileFieldName;
            $this->temp = $this->$field;

            // do whatever you want to generate a unique name
            // $filename = sha1(uniqid(mt_rand(), true));
            if (isset($this->slug)) {
                $filename = $this->slug ."_". $this->getFile()->getClientOriginalName();    
            } else {
                $filename = $this->id ."_". $this->getFile()->getClientOriginalName();
            }
            
            $this->$field = $this->getWebPath($filename);
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null !== $this->getFile()) {
            $field = $this->fileFieldName;
            $this->getFile()->move($this->getAbsolutePath(), $this->$field);
        }

        if (isset($this->temp) and file_exists($this->getUploadRootDir() . $this->temp)) {
            unlink($this->getUploadRootDir() . $this->temp);
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $field = $this->fileFieldName;
        if ($this->$field && $file = $this->getUploadRootDir() . $this->$field) {
            var_dump($file);
            die();
            if (file_exists($file)) {            
                unlink($file);
            }
        }
    }    

}