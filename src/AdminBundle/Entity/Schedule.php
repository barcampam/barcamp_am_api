<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schedule
 *
 * @ORM\Table("schedule")
 * @ORM\Entity(repositoryClass="AdminBundle\Entity\Repository\ScheduleRepository")
 */
class Schedule
{
    public static $rooms = array(
        '0' => 'Big Hall',
        '1' => "W1",
        '2' => "W2",
        '3' => "P1",
        '4' => "P2",
    );
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_from", type="datetime")
     */
    private $timeFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_to", type="datetime")
     */
    private $timeTo;

    /**
     * @var string
     *
     * @ORM\Column(name="bg_image_url", type="string", length=255, nullable=true)
     */
    private $bgImageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="room", type="string", length=255)
     */
    private $room;

    /**
     * @var string
     *
     * @ORM\Column(name="speaker", type="string", length=255, nullable=true)
     */
    private $speaker;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Speaker")
     * @ORM\JoinColumn(name="mySpeaker", referencedColumnName="id", nullable=true)
     */
    private $mySpeaker;


    /**
     * @var string
     *
     * @ORM\Column(name="topic", type="string", length=255)
     */
    private $topic;

    public function serialize()
    {
        if (is_null($this->getMySpeaker())) {
            $speakerEn = $this->getSpeaker();
            $speakerHy = $this->getSpeaker();
            $topicEn = $this->getTopic();
            $topicHy = $this->getTopic();
            $bgImageUrl = '';
        } else {
            $speakerHy = $this->getMySpeaker()->getNameHy();
            $speakerEn = $this->getMySpeaker()->getNameEn();
            $topicEn = $this->getTopic();
            $topicHy = $this->getTopic();
            $bgImageUrl = $this->getMySpeaker()->getPhoto();
        }
        
        $result = [
            'id' => $this->getId(),
            'en' => ['speaker' => $speakerEn, 'topic' => $topicEn],
            'hy' => ['speaker' => $speakerHy, 'topic' => $topicHy],
            'bg_image_url' => "http://api.barcamp.am".$bgImageUrl,
            'time_from' => $this->getTimeFrom(),
            'time_to' => $this->getTimeTo(),
            'room' => self::$rooms[$this->getRoom()]
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
     * Set timeFrom
     *
     * @param \DateTime $timeFrom
     * @return Schedule
     */
    public function setTimeFrom($timeFrom)
    {
        $this->timeFrom = $timeFrom;

        return $this;
    }

    /**
     * Get timeFrom
     *
     * @return \DateTime 
     */
    public function getTimeFrom()
    {
        return $this->timeFrom;
    }

    /**
     * Set timeTo
     *
     * @param \DateTime $timeTo
     * @return Schedule
     */
    public function setTimeTo($timeTo)
    {
        $this->timeTo = $timeTo;

        return $this;
    }

    /**
     * Get timeTo
     *
     * @return \DateTime 
     */
    public function getTimeTo()
    {
        return $this->timeTo;
    }

    /**
     * Set bgImageUrl
     *
     * @param string $bgImageUrl
     * @return Schedule
     */
    public function setBgImageUrl($bgImageUrl)
    {
        $this->bgImageUrl = $bgImageUrl;

        return $this;
    }

    /**
     * Get bgImageUrl
     *
     * @return string 
     */
    public function getBgImageUrl()
    {
        return $this->bgImageUrl;
    }

    /**
     * Set room
     *
     * @param string $room
     * @return Schedule
     */
    public function setRoom($room)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return string 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set speaker
     *
     * @param string $speaker
     * @return Schedule
     */
    public function setSpeaker($speaker)
    {
        $this->speaker = $speaker;

        return $this;
    }

    /**
     * Get speaker
     *
     * @return string 
     */
    public function getSpeaker()
    {
        return $this->speaker;
    }

    /**
     * Set topic
     *
     * @param string $topic
     * @return Schedule
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return string 
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set mySpeaker
     *
     * @param \AdminBundle\Entity\Speaker $mySpeaker
     * @return Schedule
     */
    public function setMySpeaker(\AdminBundle\Entity\Speaker $mySpeaker = null)
    {
        $this->mySpeaker = $mySpeaker;

        return $this;
    }

    /**
     * Get mySpeaker
     *
     * @return \AdminBundle\Entity\Speaker 
     */
    public function getMySpeaker()
    {
        return $this->mySpeaker;
    }
}
