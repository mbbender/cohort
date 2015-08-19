<?php

namespace Mbbender\Cohort\Http\Controllers\Account;


use SociableGroup\Exceptions\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ReCaptcha\ReCaptcha;
use Mbbender\Cohort\Http\Controllers\Controller;
use Mbbender\Cohort\Jobs\LoginUser;
use Mbbender\Cohort\Jobs\RegisterUser;

class RegisterController extends Controller{

    public function signup(Request $request)
    {
        return view('site.account.register');
    }

    public function processSignup(Request $request)
    {
        try{
            // Confirm password (if not done via javascript)
            $validator = $this->validator($request->input());
            if(($validator->fails()))
            {
                throw new ValidationException($validator);
            }

            // Confirm recaptcha
            $recaptcha = (new ReCaptcha(config('recaptcha.secret')))
                ->verify($request->get('g-recaptcha-response'), $request->ip());
            if(!$recaptcha->isSuccess()){
                return redirect()->to($this->getRedirectUrl())
                    ->withInput($request->input())
                    ->withErrors('Please let us know you\'re not a robot!', $this->errorBag());
            }

            // Register user
            $this->dispatch(RegisterUser::fromForm($request));

            // Log user in
            $this->dispatch(LoginUser::withCredentials($request->only('email','password'), true));

            // Send user to dashboard
            return redirect()->route('app.home');
        }
        catch(ValidationException $validationException)
        {
            $this->throwValidationException($request, $validationException->getValidator());
        }

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|min:6|confirmed'
        ]);
    }
}