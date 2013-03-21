<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HotelController extends Controller
{
    /**
     * @Route( "/", name="_hotel_index")
     * @Template()
     */
    public function indexAction()
    {
        $em     = $this->getDoctrine()->getEntityManager();
        $hotels = $em->getRepository( 'AcmeDemoBundle:Hotel' )->findAll();
        
        return array( 
            'hotels' => $hotels
        );
    }
    
    /**
     * @Route( "/hotel/{hotel_id}", name="_hotel_show")
     * @Template()
     */
    public function showAction( $hotel_id )
    {
        $em             = $this->getDoctrine()->getEntityManager();
        $reservations   = $em->getRepository( 'AcmeDemoBundle:Hotel' )->findOneBy( $hotel_id );
        
        
        return array( 
            
        );
    }
}
