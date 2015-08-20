<?php

namespace Mbbender\Cohort\Services;

use LaravelDoctrine\ORM\Auth\DoctrineUserProvider as LDDoctrineUserProvider;
use Mbbender\Cohort\Domain\EmailAddress;

class DoctrineUserProvider extends LDDoctrineUserProvider
{

    /**
     * Retrieve a user by the given credentials.
     *
     * @param array $credentials
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $criteria = [];
        foreach ($credentials as $key => $value) {
            if (!str_contains($key, 'password')) {
                $criteria[$key] = $value;
            }

            if($key == 'email')
            {
                $email = $this->em->getRepository(EmailAddress::class)->findOneBy(['email' => $value]);
                if(is_null($email)) return null;

                $criteria['primaryEmail'] = $email->getId();
                unset($criteria['email']);
            }
        }

        return $this->getRepository()->findOneBy($criteria);
    }

}