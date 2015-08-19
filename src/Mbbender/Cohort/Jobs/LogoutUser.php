<?php

namespace Mbbender\Cohort\Jobs;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\SelfHandling;

/**
 * Class LogoutUser
 * @package Mbbender\Cohort\Jobs
 */
class LogoutUser extends Command implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Guard $auth)
    {
        $auth->logout();
    }
}
