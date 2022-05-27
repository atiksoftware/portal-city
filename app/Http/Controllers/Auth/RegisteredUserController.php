<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
	public function create()
	{
		return view('auth.register');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'firstname' => 'required|string|max:255',
			'lastname' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'g-recaptcha-response' => 'required|recaptcha',
		], [
			'firstname.required' => __('validation.firstname.required'),
			'firstname.string' => __('validation.firstname.string'),
			'firstname.max' => __('validation.firstname.max'),
			'lastname.required' => __('validation.lastname.required'),
			'lastname.string' => __('validation.lastname.string'),
			'lastname.max' => __('validation.lastname.max'),
			'email.required' => __('validation.email.required'),
			'email.string' => __('validation.email.string'),
			'email.email' => __('validation.email.email'),
			'email.max' => __('validation.email.max'),
			'email.unique' => __('validation.email.unique'),
			'password.required' => __('validation.password.required'),
			'password.confirmed' => __('validation.password.confirmed'),
			'g-recaptcha-response.required' => __('validation.recaptcha.required'),
			'g-recaptcha-response.recaptcha' => __('validation.recaptcha.recaptcha'),
		]);

		$user = User::create([
			'firstname' => $request->firstname,
			'lastname' => $request->lastname,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		event(new Registered($user));

		Auth::login($user);

		return redirect()->route('profile');
	}
}
