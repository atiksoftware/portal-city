<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Person;
use App\Models\Business;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
	public function index(Request $request)
	{
		$items = [];
		$items[] = url('/sitemap/business_pagination');
		$items[] = url('/sitemap/person_pagination');
		$items[] = url('/sitemap/post_pagination');

		$content = view('sitemap.pagination', compact('items'));

		return response($content)->header('Content-Type', 'application/xml');
	}

	private function getPagination($count, $prefix)
	{
		$items = [];
		for ($i = 1; $i <= $count; ++$i) {
			$items[] = url($prefix . '/' . $i);
		}

		return view('sitemap.pagination', compact('items'));
	}

	private function getUrls($models)
	{
		$items = [];
		foreach ($models as $model) {
			$items[] = [
				'loc' => $model->public_link,
				'lastmod' => $model->updated_at->toIso8601String(),
				'changefreq' => 'weekly',
				'priority' => '0.5',
			];
		}

		return view('sitemap.urls', compact('items'));
	}

	public function business_pagination(Request $request)
	{
		$count = ceil(Business::count() / 100);

		return response($this->getPagination($count, '/sitemap/businesses'))->header('Content-Type', 'application/xml');
	}

	public function businesses(Request $request, $page_id)
	{
		$models = Business::skip(($page_id - 1) * 100)->take(100)->get(['slug', 'updated_at']);

		return response($this->getUrls($models))->header('Content-Type', 'application/xml');
	}

	public function person_pagination(Request $request)
	{
		$count = ceil(Person::count() / 100);

		return response($this->getPagination($count, '/sitemap/persons'))->header('Content-Type', 'application/xml');
	}

	public function persons(Request $request, $page_id)
	{
		$models = Person::skip(($page_id - 1) * 100)->take(100)->get(['slug', 'updated_at']);

		return response($this->getUrls($models))->header('Content-Type', 'application/xml');
	}

	public function post_pagination(Request $request)
	{
		$count = ceil(Post::count() / 100);

		return response($this->getPagination($count, '/sitemap/posts'))->header('Content-Type', 'application/xml');
	}

	public function posts(Request $request, $page_id)
	{
		$models = Post::skip(($page_id - 1) * 100)->take(100)->get(['slug', 'updated_at']);

		return response($this->getUrls($models))->header('Content-Type', 'application/xml');
	}
}
