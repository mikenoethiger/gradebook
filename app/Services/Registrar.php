<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
        $customMessages = array(
            'name.required' => 'Der name darf nicht leer sein.',
            'name.max' => 'Der Name darf höchstens :max Zeichen lang sein.',
            'email.required' => 'Die E-Mail Adresse darf nicht leer sein.',
            'email.email' => 'Ungültige E-Mail Adresse.',
            'email.max' => 'Die E-Mail Adresse darf höchstens :max Zeichen lang sein.',
            'email.unique' => 'Diese E-Mail Adresse ist bereits registriert.',
            'password.required' => 'Das Passwort darf nicht leer sein.',
            'password.confirmed' => 'Die Passwörter stimmen nicht überein.',
            'password.min' => 'Das Passwort muss mindestens :min Zeichen lang sein'
        );
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		], $customMessages);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}
}