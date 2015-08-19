<?php

namespace Mbbender\Cohort\Domain;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Address
 * @package App\Domain\Entities
 *
 * @ORM\Entity
 * @ORM\Table(name="addresses")
 */
class Address extends BaseEntity{

    /** @ORM\Column(type="string")  */
    private $address1;
    /** @ORM\Column(type="string")  */
    private $address2;
    /** @ORM\Column(type="string")  */
    private $city;
    /** @ORM\Column(type="string")  */
    private $state;
    /** @ORM\Column(type="string")  */
    private $postalCode;
    /** @ORM\Column(type="string")  */
    private $country;


    /**
     * Create a new address by passing in all the values for the address.
     *
     * @param $address1
     * @param $address2
     * @param $city
     * @param $state
     * @param $postalCode
     * @param $country
     * @return Address
     */
    public static function fromValues($address1=null,$address2=null,$city=null,$state=null,$postalCode=null,$country=null)
    {
        $address = new self();
        $address->setAddress1($address1);
        $address->setAddress2($address2);
        $address->setCity($city);
        $address->setState($state);
        $address->setPostalCode($postalCode);
        $address->setCountry($country);
        return $address;
    }

    /**
     * Use static named constructors to create a new object.
     */
    protected function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param mixed $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }



}