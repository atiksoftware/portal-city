<?php

namespace App\Http\Controllers\App;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\District;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
	public function index(Request $request)
	{
		$posts = [];
		$title = Settings::get('POSTS_TITLE');
		$description = Settings::get('POSTS_DESCRIPTION');

		$search = $request->input('search');

		if (null !== $search) {
			$posts = Post::where('title', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->paginate(100);
			$posts->appends(['search' => $search]);
			$title = sprintf(Settings::get('POSTS_TITLE'), $search);
			$description = sprintf(Settings::get('POSTS_DESCRIPTION'), $search);
		} else {
			$posts = Post::orderBy('id', 'DESC')->paginate(100);
		}

		$title = __('app.posts.title');
		if (null !== $search) {
			$title = __('app.posts.title.searched', ['search' => $search]);
		}

		return view('app.pages.posts', [
			'posts' => $posts,
			'search' => $search,
			'title' => $title,
			'description' => $description,
		]);
	}

	public function by_category(Request $request, Category $category)
	{
		$posts = [];

		$search = $request->input('search');

		if (null !== $search) {
			$posts = $category->posts()->where('title', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->paginate(100);
			$posts->appends(['search' => $search]);
		} else {
			$posts = $category->posts()->orderBy('id', 'DESC')->paginate(100);
		}

		$title = __('app.posts.title');
		if ('haber' !== $category->slug) {
			$title = __('app.posts.title.by_category', [
				'category' => $category->name,
			]);
		}
		if (null !== $search) {
			$title = __('app.posts.title.searched', ['search' => $search]);
		}

		return view('app.pages.posts', [
			'posts' => $posts,
			'search' => $search,
			'title' => Settings::get('POSTS_TITLE'),
			'description' => Settings::get('POSTS_DESCRIPTION'),
		]);
	}

	public function by_district(Request $request, District $district)
	{
		$posts = [];

		$search = $request->input('search');

		if (null !== $search) {
			$posts = Post::where('title', 'like', '%' . $search . '%')->where('district_id', $district->id)->orderBy('id', 'DESC')->paginate(100);
			$posts->appends(['search' => $search]);
		} else {
			$posts = Post::where('district_id', $district->id)->orderBy('id', 'DESC')->paginate(100);
		}

		$title = __('app.posts.title.by_district', [
			'district' => $district->name,
		]);
		if (null !== $search) {
			$title = __('app.posts.title.searched', ['search' => $search]);
		}

		return view('app.pages.posts', [
			'posts' => $posts,
			'search' => $search,
			'title' => $title,
		]);
	}

	public function by_user(Request $request, User $user)
	{
		$posts = [];

		$search = $request->input('search');

		if (null !== $search) {
			$posts = Post::where('title', 'like', '%' . $search . '%')->where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(100);
			$posts->appends(['search' => $search]);
		} else {
			$posts = Post::where('user_id', $user->id)->orderBy('id', 'DESC')->paginate(100);
		}

		$title = __('app.posts.title.by_user', [
			'fullname' => $user->fullname,
		]);
		if (null !== $search) {
			$title = __('app.posts.title.searched', ['search' => $search]);
		}

		return view('app.pages.posts', [
			'posts' => $posts,
			'search' => $search,
			'title' => $title,
		]);
	}

	public function view(Request $request, Post $post)
	{
		return view('app.pages.post', [
			'post' => $post,
		]);
	}
}
