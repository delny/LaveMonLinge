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
                        'slot' => '08:00 - 09:00',
                        'isAvailable'=> true,
                    ],
                    [
                        'slot' => '10:00 - 11:00',
                        'isAvailable'=> true,
                    ],
                    [
                        'slot' => '10:00 - 11:00',
                        'isAvailable'=> true,
                    ],
                    [
                        'slot' => '11:00 - 12:00',
                        'isAvailable'=> true,
                    ],
                    [
                        'slot' => '15:00 - 16:00',
                        'isAvailable'=> true,
                    ],
                    [
                        'slot' => '17:00 - 18:00',
                        'isAvailable'=> true,
                    ],
        ];

        foreach ($datas as $i => $data) {
            $timeSlot = new Timeslot();
            $timeSlot->setSlot($data['slot']);
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

