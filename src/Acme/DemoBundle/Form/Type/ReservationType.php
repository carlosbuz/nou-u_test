<?php

namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReservationType extends AbstractType
{
    protected $hotelId;
    
    public function __construct( $hotel_id = null )
    {
        $this->hotelId = $hotel_id;
    }

    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $hotel_id = $this->hotelId;
        
        $builder->add( 'room', 'entity', array(
            'class'         => 'AcmeDemoBundle:Room',
            'property'      => 'number',
            'query_builder' => function( \Acme\DemoBundle\Repository\RoomRepository $repository ) use ( $hotel_id )
            {
                return $repository->createQueryBuilder('r')
                    ->leftJoin( 'r.hotel', 'h' )
                    ->where( "h.id = :hotel_id" )
                    ->orderBy( 'r.number', 'ASC' )
                    ->setParameter( 'hotel_id', $hotel_id );
            },
            'label'         => 'reservation.form.label.room'
        ));
                        
        $builder->add( 'customer', 'entity', array(
            'class'         => 'AcmeDemoBundle:Customer',
            'property'      => 'name',
            'query_builder' => function( \Acme\DemoBundle\Repository\CustomerRepository $repository )
            {
                return $repository->createQueryBuilder('c')
                    ->orderBy( 'c.name', 'ASC ');
            },
            'label'         => 'reservation.form.label.customer'
        ));
        
        $builder->add( 'in_date', 'date', array(
            'format'    => \IntlDateFormatter::MEDIUM,
            'input'     => 'datetime',
            'label' => 'reservation.form.label.dateIn'
        ));
        
        $builder->add( 'out_date', 'date', array(
            'format'    => \IntlDateFormatter::MEDIUM,
            'input'     => 'datetime',
            'label' => 'reservation.form.label.dateOut'
        ));
    }
    
    public function setDefaultOptions( OptionsResolverInterface $resolver )
    {
        $resolver->setDefaults( array(
            'data_class'        => 'Acme\DemoBundle\Entity\Reservation',
            'csrf_protection'   => false,
            'csrf_field_name'   => '_token',
            'intention'         => 'task_item'
        ));
    }

    public function getName()
    {
        return 'reservation';
    }
}