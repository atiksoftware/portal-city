<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class NewPasswordController extends Controller
{
	public function create(Request $request)
	{
		return view('auth.reset-password', ['request' => $request]);
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'token' => ['required'],
			'email' => ['required', 'email'],
			'password' => ['required', 'min:6', 'confirmed', Rules\Password::defaults()],
		], [
			'token.required' => __('validation.token.required'),
			'email.required' => __('validation.email.required'),
			'email.email' => __('validation.email.email'),
			'password.required' => __('validation.password.required'),
			'password.min' => __('validation.password.min'),
			'password.confirmed' => __('validation.password.confirmed'),
		]);

		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user) use ($request): void {
				$user->forceFill([
					'password' => Hash::make($request->password),
					'remember_token' => Str::random(60),
				])->save();

				event(new PasswordReset($user));
			}
		);

		return Password::PASSWORD_RESET === $status
					? redirect()->route('login')->with('status', __($status))
					: back()->withInput($request->only('email'))
						->withErrors(['email' => __($status)]);
	}
}
