<?php

namespace Mbbender\Cohort\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Mbbender\Cohort\Jobs\LoginUser;
use Mbbender\Cohort\Jobs\LogoutUser;

/**
 * Class AuthController
 * @package App\Http\Controllers\Account
 */
class AuthController extends Controller{

    /**
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('cohort::login');
    }

    /**
     * @param Request $request
     * @param Guard $auth
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function processLogin(Request $request, Guard $auth)
    {
        $remember = true;
        $credentials = $request->only('email', 'password');

        $this->dispatch(LoginUser::withCredentials($credentials, $remember));

        if(!$auth->check())
        {
            return redirect(route('account.login'))
                ->withInput($request->input())
                ->withErrors(['Invalid username or password']);
        }

        return redirect()->intended(route('app.home'));
    }

    /**
     * @param Guard $auth
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function logout(Guard $auth)
    {
        $this->dispatch(new LogoutUser);

        if($auth->check())
        {
            return redirect(route('app.home'))->withErrors('Unable to logout. Please try again.');
        }
        return redirect()->route('site.home');
    }
}