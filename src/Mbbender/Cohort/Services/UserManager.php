<?php

namespace Mbbender\Cohort\Services;

use Doctrine\ORM\EntityManagerInterface;
use Mbbender\Cohort\Domain\User;

class UserManager {

    /**
     * @var EntityManagerInterface
     */
    private $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function resetPassword(User $user, $password)
    {
        $user->setPassword(bcrypt($password));
        $this->em->flush();
    }
}