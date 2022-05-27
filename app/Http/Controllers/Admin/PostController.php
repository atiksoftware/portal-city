<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Helpers\RemoveHelper;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
	public function index(Request $request)
	{
		$posts = Post::orderBy('id', 'DESC')->paginate(30);

		return view('admin.pages.posts', [
			'posts' => $posts,
		]);
	}

	public function edit(Request $request, $id = null)
	{
		$post = new Post();
		if (null !== $id) {
			$post = Post::with(['tags'])->find($id);
		}

		return view('admin.pages.post', [
			'post' => $post,
		]);
	}

	public function save(Request $request, $id = null)
	{
		// validate the data
		$this->validate($request, [
			'title' => 'required|max:255',
			'content' => 'required',
		], [
			'title.required' => 'Bir başlık girmelisiniz.',
			'content.required' => 'Bir içerik girmelisiniz.',
		]);

		$post = new Post();
		if (null !== $id) {
			$post = Post::find($id);
			ToastHelper::info('Haber içeriği güncellendi.');
		} else {
			$post = new Post();
			ToastHelper::success('Yeni haber kaydedildi.');
		}

		$post->title = $request->input('title');
		$post->summary = $request->input('summary');
		$post->content = $request->input('content');
		$post->district_id = $request->input('district_id');
		$post->category_id = $request->input('category_id');
		$post->youtube_link = $request->input('youtube_link');
		$post->save();

		$post->featured_images()->detach();
		$post->featured_images()->attach($request->input('featured_images'));

		$post->gallery_images()->detach();
		$post->gallery_images()->attach($request->input('gallery_images'));

		$post->tags()->detach();
		$tags = $request->input('tags');
		if (\is_string($tags)) {
			if (strstr($tags, '[')) {
				$tags = array_map(function ($tag) {
					return $tag->value;
				}, json_decode($tags));
			} else {
				$tags = explode(',', $tags);
			}
			foreach ($tags as $tagName) {
				$tag = Tag::firstOrCreate(['name' => $tagName]);
				$post->tags()->attach($tag->id);
			}
		}

		return redirect('/admin/posts/edit/' . $post->id);
	}

	public function remove(Request $request, Post $post)
	{
		RemoveHelper::hook();

		return view('admin.pages.remove', [
			'name' => $post->title,
		]);
	}

	public function destroy(Request $request, Post $post)
	{
		$post->delete();

		ToastHelper::warning($post->title . ' silindi!');

		return RemoveHelper::goBack('admin.posts');
	}
}
