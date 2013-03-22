<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Repository\RoomRepository")
 * @ORM\Table(name="room")
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $number;
    
    /**
     * @ORM\ManyToOne(targetEntity="Hotel", inversedBy="rooms")
     * @ORM\JoinColumn(name="hotel_id", referencedColumnName="id")
     */
    protected $hotel;

    /**
     * @ORM\OneToMany(targetEntity="Reservation", mappedBy="room")
     */
    protected $reservations;
    
    
    public function __construct()
    {
        $this->reservations = new ArrayCollection();
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
     * Set number
     *
     * @param integer $number
     * @return Room
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set hotel
     *
     * @param Acme\DemoBundle\Entity\Hotel $hotel
     * @return Room
     */
    public function setHotel(\Acme\DemoBundle\Entity\Hotel $hotel = null)
    {
        $this->hotel = $hotel;
    
        return $this;
    }

    /**
     * Get hotel
     *
     * @return Acme\DemoBundle\Entity\Hotel 
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Add reservations
     *
     * @param \Acme\DemoBundle\Entity\Reservation $reservations
     * @return Room
     */
    public function addReservation(\Acme\DemoBundle\Entity\Reservation $reservations)
    {
        $this->reservations[] = $reservations;
    
        return $this;
    }

    /**
     * Remove reservations
     *
     * @param \Acme\DemoBundle\Entity\Reservation $reservations
     */
    public function removeReservation(\Acme\DemoBundle\Entity\Reservation $reservations)
    {
        $this->reservations->removeElement($reservations);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}