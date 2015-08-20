<?php

namespace Mbbender\Cohort\Domain;

use Doctrine\ORM\Mapping as ORM;
use Mbbender\Cohort\Traits\BaseEntityTrait;


/**
 * Class Address
 * @package App\Domain\Entities
 *
 * @ORM\Entity
 * @ORM\Table(
 *  name="email_addresses",
 *  uniqueConstraints={@ORM\UniqueConstraint(name="email_idx",columns={"email"})}
 * )
 */
class EmailAddress{

    use BaseEntityTrait;

    /** @ORM\Column(type="string")  */
    private $email;

    public function __construct($email)
    {
      $this->setEmail($email);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $address
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}