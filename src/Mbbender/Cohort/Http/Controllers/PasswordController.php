<?php namespace Mbbender\Cohort\Http\Controllers;


use Mbbender\Cohort\Jobs\LoginUser;
use Mbbender\Cohort\Services\UserManager;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use SociableGroup\Exceptions\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PasswordController
 * @package App\Http\Controllers\Account
 */
class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password contryeoller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		$this->middleware('guest');
	}

	/**
	 * @return \Illuminate\View\View
     */
	public function findByEmail()
	{
		return view('site.account.password');
	}

	/**
	 * @param Request $request
	 * @return $this|\Illuminate\Http\RedirectResponse
     */
	public function sendPasswordResetEmail(Request $request)
	{
		$this->validate($request, ['email' => 'required|email']);

		$response = $this->passwords->sendResetLink($request->only('email'), function (Message $message) {
			$message->subject($this->getEmailSubject());
		});

		switch ($response) {
			case PasswordBroker::RESET_LINK_SENT:
				return redirect()->back()->with('status', trans($response));

			case PasswordBroker::INVALID_USER:
				return redirect()->back()->withErrors(['email' => trans($response)]);
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return \Illuminate\Http\Response
	 */
	public function reset(Request $request)
	{
		if (is_null($request->get('token'))) {
			throw new NotFoundHttpException;
		}

		return view('site.account.reset')->with('token', $request->get('token'));
	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param UserManager $userManager
	 * @return \Illuminate\Http\Response
	 */
	public function processReset(Request $request, UserManager $userManager)
	{
		$this->validate($request, [
			'token' => 'required',
			'email' => 'required|email',
			'password' => 'required|confirmed',
		]);

		$credentials = $request->only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = $this->passwords->reset($credentials, function ($user, $password) use ($userManager) {
			$userManager->resetPassword($user, $password);
		});

		switch ($response) {
			case PasswordBroker::PASSWORD_RESET:
				try{
					$this->dispatch(LoginUser::withCredentials($request->only('email','password'), false));
					return redirect()->route('app.home');
				}
				catch(ValidationException $validationException)
				{
					$this->throwValidationException($request, $validationException->getValidator());
				}
			default:
				return redirect()->back()
					->withInput($request->only('email'))
					->withErrors(['email' => trans($response)]);
		}
	}

	/**
	 * Reset the given user's password.
	 *
	 * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
	 * @param  string  $password
	 * @return void
	 */
	protected function resetPassword($user, $password)
	{
		$user->password = bcrypt($password);

		$user->save();

		$this->auth->login($user);
	}


}
