<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Helpers\RemoveHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function index(Request $request)
	{
		$records = [];

		$search = $request->input('search');

		if (null !== $search) {
			// find firstname or lastname or email contains $search
			$records = User::where('firstname', 'like', '%' . $search . '%')
				->orWhere('lastname', 'like', '%' . $search . '%')
				->orWhere('email', 'like', '%' . $search . '%')
				->orderBy('firstname', 'ASC')
				->paginate(50);
		} else {
			$records = User::paginate(50);
		}

		return view('admin.pages.users', [
			'users' => $records,
		]);
	}

	public function edit(Request $request, $id = null)
	{
		$user = new User();
		if (null !== $id) {
			$user = User::find($id);
		}

		return view('admin.pages.user', [
			'user' => $user,
		]);
	}

	public function save(Request $request, $id = null)
	{
		switch ($request->input('submit')) {
			case 'informations':
				return $this->saveInformations($request, $id);
				break;
			case 'password':
				return $this->savePassword($request, $id);
				break;
		}
	}

	public function saveInformations(Request $request, $id = null)
	{
		$user = new User();
		$user->password = Hash::make(Str::random(16));
		if (null !== $id) {
			$user = User::find($id);
			$request->validate([
				'firstname' => 'required|max:255',
				'lastname' => 'required|max:255',
				'email' => 'required|email|max:255|unique:users,email,' . $id,
			], [
				'firstname.required' => 'Bir ad girmelisiniz.',
				'lastname.required' => 'Bir soyad girmelisiniz.',
				'email.required' => 'Bir email girmelisiniz.',
				'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
			]);
			ToastHelper::info('Kullanıcı bilgileri güncellendi.');
		} else {
			$request->validate([
				'firstname' => 'required',
				'lastname' => 'required',
				'email' => 'required|email|unique:users',
			], [
				'firstname.required' => 'İsim girmelisiniz.',
				'lastname.required' => 'Soyisim girmelisiniz.',
				'email.required' => 'E-posta girmelisiniz.',
				'email.email' => 'Geçerli bir e-posta adresi girmelisiniz.',
				'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
			]);
			ToastHelper::success('Yeni kullanıcı oluşturuldu.');
		}
		$user->firstname = $request->input('firstname');
		$user->lastname = $request->input('lastname');
		$user->email = $request->input('email');
		$user->is_admin = $request->input('is_admin');
		$user->is_active = $request->input('is_active');
		$user->save();

		return redirect()->route('admin.users.edit', [$user->id]);
	}

	public function savePassword(Request $request, $id = null)
	{
		$user = User::find($id);
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

		return redirect()->route('admin.users.edit', [$user->id]);
	}

	public function remove(Request $request, User $user)
	{
		RemoveHelper::hook();

		return view('admin.pages.remove', [
			'name' => $user->fullname,
		]);
	}

	public function destroy(Request $request, User $user)
	{
		$user->delete();

		ToastHelper::success($user->fullname . ' silindi.');

		return RemoveHelper::goBack('admin.users');
	}
}
