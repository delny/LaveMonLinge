<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Timeslot;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadTimeSlotData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $datas = [
                    [
                        'slot_start' => '08:00',
                        'isAvailable'=> true,
                        'slot_end' => '09:00'
                    ],
                    [
                        'slot_start' => '09:00',
                        'isAvailable'=> true,
                        'slot_end' => '10:00'
                    ],
                    [
                        'slot_start' => '11:00',
                        'isAvailable'=> true,
                        'slot_end' => '12:00'
                    ],
                    [
                        'slot_start' => '14:00',
                        'isAvailable'=> true,
                        'slot_end' => '15:00'
                    ],
                    [
                        'slot_start' => '16:00',
                        'isAvailable'=> true,
                        'slot_end' => '17:00'
                    ],
                    [
                        'slot_start' => '18:00',
                        'isAvailable'=> true,
                        'slot_end' => '19:00'
                    ],
        ];

        foreach ($datas as $i => $data) {
            $timeSlot = new Timeslot();
            $timeSlot->setSlotStart($data['slot_start']);
            $timeSlot->setSlotEnd($data['slot_end']);
            $timeSlot->setIsAvailable($data['isAvailable']);

            $manager->persist($timeSlot);
            $this->addReference('timeSlot-'.$i, $timeSlot);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 1;
    }
}

