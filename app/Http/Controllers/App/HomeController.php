<?php

namespace App\Http\Controllers\App;

use App\Models\Post;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	public function index(Request $request)
	{
		$posts = Post::orderBy('id', 'desc')->take(54)->with(['featured_images', 'category'])->get();

		$headlines = $posts->slice(0, 24);

		$items_1 = [];
		$items_2 = [];
		$items_3 = [];

		if (\count($posts) > 23) {
			$items_1 = $posts->slice(24, 15);
		}
		if (\count($posts) > 38) {
			$items_2 = $posts->slice(39, 15);
		}
		if (\count($posts) > 53) {
			$items_3 = $posts->slice(54, 15);
		}

		return view('app.pages.home', [
			'title' => Settings::get('SITE_TITLE'),
			'description' => Settings::get('SITE_DESCRIPTION'),
			'headlines' => $headlines,
			'items_1' => $items_1,
			'items_2' => $items_2,
			'items_3' => $items_3,
			// 'search' => $search,
		]);
	}
}
