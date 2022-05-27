<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Person;

class PersonController extends Controller
{
	public function index(Request $request)
	{
		$persons = [];

		$search = $request->input('search');

		if (null !== $search) {
			$persons = Person::where('name', 'like', '%' . $search . '%')->orderBy('name', 'ASC')->paginate(100);
			$persons->appends(['search' => $search]);
		} else {
			$persons = Person::orderBy('name', 'ASC')->paginate(100);
		}

		return view('app.pages.persons', [
			'persons' => $persons,
			'search' => $search,
		]);
	}

	public function view(Request $request, Person $person)
	{
		return view('app.pages.person', [
			'person' => $person,
		]);
	}
}
