<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Business;

class BusinessController extends Controller
{
	public function index(Request $request)
	{
		$businesses = [];

		$search = $request->input('search');

		if (null !== $search) {
			$businesses = Business::where('name', 'like', '%' . $search . '%')->orderBy('name', 'ASC')->paginate(50);
			$businesses->appends(['search' => $search]);
		} else {
			$businesses = Business::orderBy('name', 'ASC')->paginate(50);
		}

		return view('app.pages.businesses', [
			'businesses' => $businesses,
			'search' => $search,
		]);
	}

	public function view(Request $request, Business $business)
	{
		return view('app.pages.business', [
			'business' => $business,
		]);
	}
}
