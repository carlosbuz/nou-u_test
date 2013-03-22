<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        // Gets all hotels data.
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
        // Gets hotel and its reservations data.
        $em     = $this->getDoctrine()->getEntityManager();
        $hotel  = $em->getRepository( 'AcmeDemoBundle:Hotel' )->findOneById( $hotel_id );
        
        if( empty( $hotel ) ) {
            throw new NotFoundHttpException( 'Página no encontrada' );
        }
        
        $reservations = $em->getRepository( 'AcmeDemoBundle:Reservation' )->getHotelReservations( $hotel_id );
        
        return array( 
            'hotel'         => $hotel,
            'reservations'  => $reservations
        );
    }
}
