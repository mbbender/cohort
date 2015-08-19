<?php

namespace Mbbender\Cohort\Jobs;


use Illuminate\Http\Request;

/**
 * Class RegisterUser
 * @package Mbbender\Cohort\Jobs
 */
class RegisterUser extends Command {

    /**
     * @var
     */
    private $firstName;

    /**
     * @var
     */
    private $lastName;

    /**
     * @var
     */
    private $email;

    /**
     * @var
     */
    private $password;


    /**
     * Create a new RegisterUser command from an HTTP Request
     *
     * @param \Illuminate\Http\Request $request
     * @return RegisterUser
     */
    public static function fromForm(Request $request)
    {
        return new static(
            $request->get('firstName'),
            $request->get('lastName'),
            $request->get('email'),
            $request->get('password')
        );
    }

    /**
     * Create a new RegisterUer command from basic strings
     *
     * @param $name
     * @param $email
     * @param $password
     * @param $passwordConfirmation
     * @return RegisterUser
     */
    public static function withValues($firstName, $lastName, $email, $password)
    {
        return new static(
            $firstName, $lastName, $email, $password
        );
    }

    /**
     * Create a new command instance.
     *
     * @param $name
     * @param $email
     * @param $password
     * @param $passwordConfirmation
     */
    private function __construct($firstName, $lastName, $email, $password)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }


}
