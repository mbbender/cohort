<?php

namespace Mbbender\Cohort\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 * @ORM\Entity
 * @ORM\Table=("users")
 */
class User extends BaseEntity implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable;

    /** @ORM\Column(type="string") */
    private $firstName;

    /** @ORM\Column(type="string") */
    private $lastName;

    /**
     * @ORM\OneToOne(targetEntity="EmailAddress", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="primary_email_id", referencedColumnName="id", onDelete="cascade")
     */
    private $primaryEmail;

    /**
     * @ORM\ManyToMany(targetEntity="Phonenumber")
     * @ORM\JoinTable(name="phonenumbers_users",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="phonenumber_id", referencedColumnName="id")})
     */
    private $phoneNumbers;

    /**
     * @ORM\ManyToMany(targetEntity="EmailAddress")
     * @ORM\JoinTable(name="emails_users",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="email__address_id", referencedColumnName="id")})
     */
    private $emails;

    /**
     * @ORM\ManyToMany(targetEntity="Address")
     * @ORM\JoinTable(name="addresses_users",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="id")})
     */
    private $addresses;

    /**
     * @ORM\ManyToMany(targetEntity="Organization")
     * @ORM\JoinTable(name="organization_users",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="organization_id", referencedColumnName="id")})
     */
    private $organizations;


    public function __construct()
    {
        $this->phoneNumbers = new ArrayCollection();
        $this->emails = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->organizations = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * @param mixed $phoneNumbers
     */
    public function setPhoneNumbers($phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;
    }

    /**
     * @return mixed
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * @param mixed $emails
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
    }

    /**
     * @return mixed
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param mixed $addresses
     */
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * @return mixed
     */
    public function getOrganizations()
    {
        return $this->organizations;
    }

    /**
     * @param mixed $organizations
     */
    public function setOrganizations($organizations)
    {
        $this->organizations = $organizations;
    }

    /**
     * @return mixed
     */
    public function getPrimaryEmail()
    {
        return $this->primaryEmail->getEmail();
    }

    /**
     * @param mixed $primaryEmail
     */
    public function setPrimaryEmail($primaryEmail)
    {
        $this->primaryEmail = $primaryEmail;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->getPrimaryEmail();
    }

    /**
     * @param mixed $primaryEmail
     */
    public function setEmail($primaryEmail)
    {
        $this->setPrimaryEmail($primaryEmail);
    }

    public function getEmailForPasswordReset()
    {
        return $this->getPrimaryEmail();
    }




}