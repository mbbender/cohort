<?php

namespace Mbbender\Cohort\Jobs;

use Illuminate\Auth\Guard;
use Illuminate\Contracts\Bus\SelfHandling;


/**
 * Class LoginUser
 * @package Mbbender\Cohort\Jobs
 */
class LoginUser extends Command implements SelfHandling{

    /**
     * @var Boolean
     */
    private $remember;
    /**
     * @var
     */
    private $credentials;


    /**
     * @param $credentials
     * @param bool $remember
     * @return static
     */
    public static function withCredentials($credentials, $remember = false)
    {
        return new static($credentials, $remember);
    }

    /**
     * Create a new command instance.
     *
     * @param $credentials
     * @param bool $remember
     */
    private function __construct($credentials, $remember = false)
    {
        //
        $this->credentials = $credentials;
        $this->remember = $remember;
    }

    /**
     * @return mixed
     */
    public function shouldRemember()
    {
        return $this->remember;
    }

    /**
     * @return mixed
     */
    public function getCredentials()
    {
        return $this->credentials;
    }


    /**
     * Handle the command.
     *
     * @param  LoginUser $command
     * @return void
     */
    public function handle(Guard $auth)
    {
        // Attempt to authenticate and login the user
        $login = true;
        $auth->attempt($this->getCredentials(), $this->shouldRemember(), $login);
    }


}
