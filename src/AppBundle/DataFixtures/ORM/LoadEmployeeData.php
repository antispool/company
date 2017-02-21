<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Address;
use AppBundle\Entity\Employee;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class LoadEmployeeData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $employee = new Employee();
        $employee->setFirstName('Jon');
        $employee->setLastName("Jonson");
        $employee->setSalary("1");
        $employee->setGender(1);
        $employee->setDateOfBirth(new \DateTime());
        $employee->setComment("comment");
        $employee->setIsActive(true);
        $employee->setIsRemoved(false);
        $address = new Address();
        $address->setComment("123");
        $employee->addAddress($address);
        $manager->persist($employee);

        $manager->flush();
    }
}