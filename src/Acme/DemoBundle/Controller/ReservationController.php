<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\DemoBundle\Form\Type\ReservationType;
use Acme\DemoBundle\Entity\Reservation;

class ReservationController extends Controller
{
    /**
     * @Route( "/hotel/{hotel_id}/book", name="_reservation_new")
     * @Template()
     */
    public function newAction( $hotel_id )
    {
        // Checks if hotel exists.
        $em     = $this->getDoctrine()->getEntityManager();
        $hotel  = $em->getRepository( 'AcmeDemoBundle:Hotel' )->findOneById( $hotel_id );
     
        if( empty( $hotel ) ) {
            throw new NotFoundHttpException( 'Página no encontrada' );
        }
        
        // Creates new reservation form.
        $form       = $this->createForm( new ReservationType( $hotel_id ), new Reservation() );
        $request    = $this->getRequest();
        
        // If form is sent, validation is executed. If form was not sent, reservation form is shown.
        if( $request->getMethod() == 'POST' )
        {   
            $form->bind( $request );
            
            // Checks if form is valid, otherwise, error message is shown.
            if( $form->isValid() )
            {
                $reservation = $form->getData();
                $reservation->setCreationDate( new \DateTime() );
                        
                // Saves reservation.
                $em->persist( $reservation );
                $em->flush();
                
                //TODO: On new reservation an email should be sent to user.
                   
                return $this->redirect( $this->generateUrl( '_hotel_show', array( 'hotel_id' => $hotel_id ) ) );
            }
        }
        
        return $this->render( 'AcmeDemoBundle:Reservation:new.html.twig', array(
            'form'  => $form->createView(),
            'hotel' => $hotel
        ));
    }
    
    /**
     * @Route( "/hotel/{hotel_id}/book/checkReservation", name="_reservation_new_check")
     * @Template()
     */
    public function isReservationAvailable()
    {
        $request = $this->container->get( 'request' );
        
        // Must be an ajax request.
        if( $request->isXmlHttpRequest() ) 
        {
            $em = $this->getDoctrine()->getEntityManager();
            
            return new Response( json_encode( $jsonResponse ) );
        }
    }
}
