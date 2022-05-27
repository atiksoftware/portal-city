<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
	/**
	 * Display the password reset link request view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return view('auth.forgot-password');
	}

	/**
	 * Handle an incoming password reset link request.
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'g-recaptcha-response' => 'required|recaptcha',
		], [
			'email.required' => __('auth.password.email.required'),
			'email.email' => __('auth.password.email.email'),
			'g-recaptcha-response.required' => __('validation.recaptcha.required'),
			'g-recaptcha-response.recaptcha' => __('validation.recaptcha.recaptcha'),
		]);

		$status = Password::sendResetLink(
			$request->only('email')
		);

		if (Password::RESET_LINK_SENT === $status) {
			return back()->with('status', __('auth.password.email.sent'));
		}
		$errors = [];
		if (Password::INVALID_USER === $status) {
			$errors['email'] = __('auth.password.email.email');
		}

		return back()
			->withInput($request->only('email'))
			->withErrors($errors);
	}
}
