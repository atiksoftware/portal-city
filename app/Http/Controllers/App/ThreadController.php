<?php

namespace App\Http\Controllers\App;

use App\Models\Post;
use App\Models\Weather;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Adword;

class ThreadController extends Controller
{
	public function index(Request $request)
	{
		// $buffer = [];

		// $currencies = Currency::getAll();
		// $weather = Weather::Today();

		// // get rendered components
		// $buffer['currencies'] = view('components.currency', compact('currency'))->render();

		// return as json
		return response()->json([
			'currencies' => $this->getCurrencies(),
			'weather' => $this->getWeathers(),
			'breaking' => $this->getBreaking(),
		]);
	}

	public function getCurrencies()
	{
		return Currency::getAll();
	}

	public function getWeathers()
	{
		return Weather::Today();
	}

	public function getBreaking()
	{
		return Post::latest()->take(5)->get(['slug', 'title']);
	}

	public function getAdwords()
	{
		$list = [];
		foreach (Adword::getAdwordTypeList() as $item) {
			$list[$item->id] = Adword::getByTypeId($item->id);
		}

		return $list;
	}
}
