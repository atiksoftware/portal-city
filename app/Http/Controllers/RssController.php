<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class RssController extends Controller
{
	public function index(Request $request)
	{
		// get last 10 posts
		$posts = Post::orderBy('created_at', 'desc')->take(10)->get();

		$content = view('rss.index', compact('posts'));

		return response($content)->header('Content-Type', 'application/xml');
	}
}
