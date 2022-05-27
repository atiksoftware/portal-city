<?php

namespace App\Http\Controllers\App;

use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
	public function index(Request $request)
	{
		$user = $request->user();

		return view('app.pages.profile', [
			'user' => $user,
		]);
	}

	public function save(Request $request)
	{
		switch ($request->input('submit')) {
			case 'informations':
				return $this->saveInformations($request);
				break;
			case 'password':
				return $this->savePassword($request);
				break;
		}
	}

	public function saveInformations(Request $request)
	{
		$request->validate([
			'firstname' => 'required|max:255',
			'lastname' => 'required|max:255',
		], [
			'firstname.required' => 'Bir ad girmelisiniz.',
			'lastname.required' => 'Bir soyad girmelisiniz.',
		]);
		ToastHelper::info('Kullanıcı bilgileri güncellendi.');

		$user = $request->user();
		$user->firstname = $request->input('firstname');
		$user->lastname = $request->input('lastname');
		$user->save();

		return redirect()->route('profile');
	}

	public function savePassword(Request $request)
	{
		$user = $request->user();
		$this->validate($request, [
			'password' => 'required|string|min:6|confirmed',
		], [
			'password.required' => 'Şifre girmelisiniz.',
			'password.min' => 'Şifreniz en az 6 karakterden oluşmalıdır.',
			'password.confirmed' => 'Şifreler eşleşmiyor.',
		]);
		$user->password = Hash::make($request->input('password'));
		$user->save();

		ToastHelper::info('Şifre güncellendi.');

		return redirect()->route('profile');
	}
}
