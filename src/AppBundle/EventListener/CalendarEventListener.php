<?php

namespace AppBundle\EventListener;


use ADesigns\CalendarBundle\Entity\EventEntity;
use ADesigns\CalendarBundle\Event\CalendarEvent;
use Doctrine\ORM\EntityManager;

class CalendarEventListener
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDatetime();
        $endDate = $calendarEvent->getEndDatetime();

        // The original request so you can get filters from the calendar
        // Use the filter in your query for example

        $request = $calendarEvent->getRequest();
        $filter = $request->get('filter');


        // load events using your custom logic here,
        // for instance, retrieving events from a repository

        $companyEvents = $this->entityManager->getRepository('AppBundle:OrderLaundry')
            ->createQueryBuilder('u')
            ->andWhere('u.dateCollect BETWEEN :startDate and :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
            ->setParameter('endDate', $endDate->format('Y-m-d H:i:s'))
            ->getQuery()->getResult();

        // $companyEvents and $companyEvent in this example
        // represent entities from your database, NOT instances of EventEntity
        // within this bundle.
        //
        // Create EventEntity instances and populate it's properties with data
        // from your own entities/database values.

        foreach($companyEvents as $companyEvent) {
            $timeSlotStart = $companyEvent->getTimeSlotDelivery()->getSlotStart();
            $slotStart = substr($timeSlotStart,0,2);
            $timeSlotEnd = $companyEvent->getTimeSlotDelivery()->getSlotEnd();
            $slotEnd = substr($timeSlotEnd,0,2);
            $dateDelivery = $companyEvent->getDateDelivery()->format('Y-m-d');

            $dateDeliverySlotStart = new \DateTime($dateDelivery);
            $dateDeliverySlotEnd = new \DateTime($dateDelivery);

            $eventEntity = new EventEntity($companyEvent->getStatut(),$dateDeliverySlotStart->setTime($slotStart,00), $dateDeliverySlotEnd->setTime($slotEnd,00), false);



            //optional calendar event settings
            if($companyEvent->getStatut() == "Expédié"){
                $eventEntity->setBgColor('green'); //set the background color of the event's label
            }else{
                $eventEntity->setBgColor('red'); //set the background color of the event's label
            }
            $eventEntity->setFgColor('#FFFFFF'); //set the foreground color of the event's label
            //$eventEntity->setUrl('test/'.$companyEvent->getId()); // url to send user to when event label is clicked
            $eventEntity->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels
            $eventEntity->addField('name','value');
            $eventEntity->addField('name1','value1');
            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($eventEntity);
        }
    }

}