<?php

namespace Acme\DemoBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Acme\DemoBundle\Validator\Constraints as AcmeAssert;
use Symfony\Component\Validator\ExecutionContext;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Acme\DemoBundle\Repository\ReservationRepository")
 * @ORM\Table(name="reservation")
 * @Assert\Callback(methods={"isValidDateIn", "isValidDateOut"} )
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="reservations")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    protected $customer;
    
    /**
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="reservations")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    protected $room;
    
    /**
     * @ORM\Column(name="creation_date", type="datetime")
     */
    protected $creation_date;
    
    /**
     * @ORM\Column(name="in_date", type="datetime")
     */
    protected $in_date;
    
    /**
     * @ORM\Column(name="out_date", type="datetime")
     */
    protected $out_date;

    
    public function __construct() 
    {
        $this->in_date = new \DateTime();
        $this->out_date = new \DateTime("now +1 day");
    }
    
    public function isValidDateIn( ExecutionContext $context )
    {
        if( $this->getInDate() < new \DateTime() ) {   
            $context->addViolationAtSubPath( 'in_date', 'Check in date must be later than today', array(), null);
        }
    }
    
    public function isValidDateOut( ExecutionContext $context )
    {
        if( $this->getOutDate() < $this->getInDate() ) {   
            $context->addViolationAtSubPath( 'out_date', 'Check out date must be later than check in date', array(), null);
        }
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
     * Set creation_date
     *
     * @param \DateTime $creationDate
     * @return Reservation
     */
    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;
    
        return $this;
    }

    /**
     * Get creation_date
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * Set in_date
     *
     * @param \DateTime $inDate
     * @return Reservation
     */
    public function setInDate($inDate)
    {
        $this->in_date = $inDate;
    
        return $this;
    }

    /**
     * Get in_date
     *
     * @return \DateTime 
     */
    public function getInDate()
    {
        return $this->in_date;
    }

    /**
     * Set out_date
     *
     * @param \DateTime $outDate
     * @return Reservation
     */
    public function setOutDate($outDate)
    {
        $this->out_date = $outDate;
    
        return $this;
    }

    /**
     * Get out_date
     *
     * @return \DateTime 
     */
    public function getOutDate()
    {
        return $this->out_date;
    }

    /**
     * Set customer
     *
     * @param \Acme\DemoBundle\Entity\Customer $customer
     * @return Reservation
     */
    public function setCustomer(\Acme\DemoBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;
    
        return $this;
    }

    /**
     * Get customer
     *
     * @return \Acme\DemoBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set room
     *
     * @param \Acme\DemoBundle\Entity\Room $room
     * @return Reservation
     */
    public function setRoom(\Acme\DemoBundle\Entity\Room $room = null)
    {
        $this->room = $room;
    
        return $this;
    }

    /**
     * Get room
     *
     * @return \Acme\DemoBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }
}