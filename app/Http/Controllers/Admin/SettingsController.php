<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingsController extends Controller
{
	public function index(Request $request)
	{
		return view('admin.pages.settings');
	}

	public function save(Request $request)
	{
		foreach ($request->all() as $key => $value) {
			Settings::set($key, $value);
		}

		return redirect()->route('admin.settings');
	}
}
