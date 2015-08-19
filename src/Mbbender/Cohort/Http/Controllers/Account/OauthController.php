<?php namespace Mbbender\Cohort\Http\Controllers\Account;


use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\SocialiteManager;
use Mbbender\Cohort\Domain\EmailAddress;
use Mbbender\Cohort\Domain\User;
use Mbbender\Cohort\Http\Controllers\Controller;
use Mbbender\Cohort\Jobs\LoginUser;
use Mbbender\Cohort\Jobs\RegisterUser;

/**
 * Class OauthController
 * @package app\Http\Controllers\Account
 */
class OauthController extends Controller{

    /**
     * @var SocialiteManager
     */
    protected $socialite;
    /**
     * @var Guard
     */
    protected $auth;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @param SocialiteManager $socialite
     * @param Guard $auth
     */
    public function __construct(Socialite $socialite, Guard $auth, EntityManagerInterface $em)
    {

        $this->socialite = $socialite;
        $this->auth = $auth;
        $this->em = $em;
    }

    /**
     * @param $provider
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        if(!in_array($provider, (config('services.oauth_services'))))
            throw new \Exception('Oauth provider not supported: '.$provider);

        return $this->socialite->with($provider)->redirect();
    }


    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = $this->socialite->with($provider)->user();

        // If user already in system login
        $user = $this->em->getRepository(User::class)->findOneBy(
            ['primaryEmail' => $this->em->getRepository(EmailAddress::class)->findOneBy(['email' => $user->getEmail()])]
        );
        if(!is_null($user))
        {
            $this->auth->login($user, true);
            return redirect()->route('app.home');
        }

        // Otherwise register the user and log them in.
        $this->dispatch(RegisterUser::withValues(explode(' ',$user->getName())[0], explode(' ',$user->getName())[1],$user->getEmail(),$user->getId()));
        $this->dispatch(LoginUser::withCredentials(['email' => $user->getEmail(), 'password' => $user->getId()], true));
        return redirect()->route('app.home');
    }
}