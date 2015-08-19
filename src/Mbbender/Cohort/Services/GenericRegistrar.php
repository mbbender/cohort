<?php namespace Mbbender\Cohort\Services;

use SociableGroup\Exceptions\ValidationException;
use Mbbender\Cohort\Domain\EmailAddress;
use Mbbender\Cohort\Domain\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

/**
 * Class Registrar
 * @package App\Services
 */
class GenericRegistrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'firstName' => 'required|max:255',
			'lastName' => 'required|max:255',
			'password' => 'required|min:6',
			'email' => 'required|email|max:255|unique:'.EmailAddress::class

		]);

	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array $data
	 * @return User
	 * @throws ValidationException
	 */
	public function create(array $data)
	{

		$validator = $this->validator($data);

		if ($validator->fails())
		{
			throw new ValidationException($validator);
		}

		$primaryEmail = new EmailAddress($data['email']);

		$user = new User();
		$user->setFirstName($data['firstName']);
		$user->setLastName($data['lastName']);
		$user->setPrimaryEmail($primaryEmail);
		$user->setPassword(bcrypt($data['password']));

		return $user;
	}

}
