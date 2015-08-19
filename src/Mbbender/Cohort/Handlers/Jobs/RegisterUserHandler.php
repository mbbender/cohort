<?php namespace Mbbender\Cohort\Handlers\Jobs;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Contracts\Auth\Registrar;
use Mbbender\Cohort\Jobs\RegisterUser;

/**
 * Class RegisterUserHandler
 * @package Mbbender\Cohort\Handlers\Jobs
 */
class RegisterUserHandler {

    /**
     * @var Registrar
     */
    private $registrar;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Create the command handler.
     *
     * @param Registrar $registrar
     */
    public function __construct(EntityManagerInterface $em, Registrar $registrar)
    {
        $this->registrar = $registrar;
        $this->em = $em;
    }

    /**
     * Use the Registrar to register a new user if data is valid.
     *
     * @param  \App\Commands\RegisterUser $command
     * @throws \App\Exceptions\ValidateException
     * @return void
     */
    public function handle(RegisterUser $command)
    {
        $data = [
            'firstName'                  => $command->getFirstName(),
            'lastName'                  => $command->getLastName(),
            'email'                 => $command->getEmail(),
            'password'              => $command->getPassword()
        ];

        // Create user
        $user = $this->registrar->create($data);

        // Persist user
        $this->em->persist($user);
        $this->em->flush();
    }

}
