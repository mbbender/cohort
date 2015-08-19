<?php

namespace Mbbender\Cohort\Domain;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Address
 * @package App\Domain\Entities
 *
 * @ORM\Entity
 * @ORM\Table(name="phone_numbers")
 */
class Phonenumber extends BaseEntity{

    /** @ORM\Column(type="string")  */
    private $areacode;
    /** @ORM\Column(type="string")  */
    private $number;
    /** @ORM\Column(type="string")  */
    private $prefix;
    /** @ORM\Column(type="string")  */
    private $country;

    /**
     * Use static named constructors to create a new object.
     */
    public function __construct($number)
    {
        $this->setNumber($number);
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }


}