<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyAccountController extends Controller
{
	public function html(Request $request)
	{
		return response()->json([
			'desktop' => view('app.widgets.my-account-desktop')->render(),
			'mobile' => view('app.widgets.my-account-mobile')->render(),
		]);
	}
}
