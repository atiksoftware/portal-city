<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class RemoveHelper
{
	public static function hook(): void
	{
		if (url()->previous() !== url()->current()) {
			Session::put('previousUrl', url()->previous());
		}
	}

	public static function goBack($route_name)
	{
		if (Session::has('previousUrl')) {
			$previousUrl = Session::get('previousUrl');
			Session::forget('previousUrl');

			return redirect($previousUrl);
		}

		return redirect()->route($route_name);
	}
}
