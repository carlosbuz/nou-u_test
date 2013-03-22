<?php
namespace Acme\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Acme\DemoBundle\Entity\Hotel;
use Acme\DemoBundle\Entity\Room;
use Acme\DemoBundle\Entity\Customer;
use Acme\DemoBundle\Entity\Reservation;

class LoadTestData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //hotels
        $hotels['names'] = array('Melia', 'Wella', 'NH', 'Princesa Sofía', 'Ritz', 'Mandarín Oriental', 'Palace');
        $hotels['cities'] = array('Palma de Mallorca', 'Barcelona', 'Barcelona', 'Barcelona', 'París', 'Barcelona', 'New York');
        $hotels['stars'] = array(4, 5, 3, 5, 5, 5, 5);
        
        for($i=0; $i<count($hotels['names']); $i++)
        {
            $hotel = new Hotel();
            $hotel->setName($hotels['names'][$i]);
            $hotel->setCity($hotels['cities'][$i]);
            $hotel->setStars($hotels['stars'][$i]);
            
            //rooms
            for($j=0; $j<=20; $j++)
            {
                $room = new Room();
                $room->setHotel($hotel);
                $room->setNumber(101+$j);
                $this->addReference( 'room_'. $i. '_'. ( 101 + $j ), $room );
                $manager->persist($room);
            }
            
            $manager->persist($hotel);
        }
        
        //customers
        $customers['names'] = array('Joan', 'Fran', 'Carles', 'Jose', 'Marta', 'Amagoia', 'Albert', 'Oriol');
        
        for($i=0; $i<count($customers['names']); $i++)
        {
            $customer = new Customer();
            $customer->setName($customers['names'][$i]);
            $customer->setAge(rand(18, 50));
            
            //Reservations
//            $reservation = new Reservation();
//            $reservation->setCustomer( $customer );
//            $reservation->setRoom( $this->getReference( 'room_'.  rand( 0, 6 ). '_'. ( 101 + rand( 0, 100 ) ) ) );
//            $reservation->setInDate( new \DateTime() );
//            $reservation->setOutDate( new \DateTime( '2013-04-01' ) );
//            $reservation->setCreationDate( new \DateTime() );
//        
//            $manager->persist( $reservation );
            $manager->persist( $customer );
        }        
        
        $manager->flush();
    }
    
    public function getOrder()
	{
		return 1;
	}
}