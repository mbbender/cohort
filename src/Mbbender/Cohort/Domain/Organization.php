<?php

namespace Mbbender\Cohort\Domain;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Organization
 * @package App\Domain\Entities
 * @ORM\Entity
 * @ORM\Table(name="organizations")
 */

class Organization extends BaseEntity{

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Address", cascade={"persist"})
     * @ORM\JoinTable(name="addresses_organizations",
     *      joinColumns={@ORM\JoinColumn(name="organization_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id")})
     */
    private $addresses;

    /**
     * @ORM\ManyToMany(targetEntity="Phonenumber", cascade={"persist"})
     * @ORM\JoinTable(name="phonenumbers_organizations",
     *      joinColumns={@ORM\JoinColumn(name="organization_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="phonenumber_id", referencedColumnName="id")})
     */
    private $phoneNumbers;

    /**
     * @ORM\ManyToMany(targetEntity="Address", cascade={"persist"})
     * @ORM\JoinTable(name="emails_organizations",
     *      joinColumns={@ORM\JoinColumn(name="organization_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="email_id", referencedColumnName="id")})
     */
    private $emails;

    /**
     * @ORM\ManyToMany(targetEntity="User", cascade={"persist"})
     * @ORM\JoinTable(name="organizations_users",
     *      joinColumns={@ORM\JoinColumn(name="organization_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")})
     */
    private $users;

    public function __construct($name)
    {
        $this->setName($name);
        $this->addresses = new ArrayCollection();
        $this->phoneNumbers = new ArrayCollection();
        $this->emails = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name=$name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress(Address $address)
    {
        $this->addresses->add($address);
    }

    /**
     * @param Address $address
     */
    public function removeAddress(Address $address)
    {
        $this->addresses->removeElement($address);
    }

}