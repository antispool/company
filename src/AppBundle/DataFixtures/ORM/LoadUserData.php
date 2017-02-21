<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setEmail('admin@test.ru');
        $userAdmin->setPassword('21232f297a57a5a743894a0e4a801fc3');
        $userAdmin->setRole(User::ROLE_ADMIN);
        $manager->persist($userAdmin);

        $userWorker = new User();
        $userWorker->setUsername('worker');
        $userWorker->setEmail('worker@test.ru');
        $userWorker->setPassword('b61822e8357dcaff77eaaccf348d9134');
        $userWorker->setRole(User::ROLE_WORKER);
        $manager->persist($userWorker);

        $userManager = new User();
        $userManager->setUsername('manager');
        $userManager->setEmail('manager@test.com');
        $userManager->setPassword('1d0258c2440a8d19e716292b231e3190');
        $userManager->setRole(User::ROLE_MANAGER);
        $manager->persist($userManager);

        $manager->flush();
    }
}