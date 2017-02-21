<?php

namespace AppBundle\Entity;

/**
 * Phone
 */
class Phone
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Employee
     */
    private $employee;

    /**
     * @var string
     */
    private $number;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param Employee $employee
     *
     * @return Phone
     */
    public function setEmployee(Employee $employee)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }
}

