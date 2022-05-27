<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Helpers\RemoveHelper;
use App\Http\Controllers\Controller;

class BusinessCategoryController extends Controller
{
	public function index(Request $request)
	{
		$records = [];

		$search = $request->input('search');

		if (null !== $search) {
			$records = Category::where('type_id', 2)->where('name', 'like', '%' . $search . '%')
				->orderBy('name', 'ASC')
				->paginate(50);
		} else {
			$records = Category::where('type_id', 2)->orderBy('name', 'ASC')
				->paginate(50);
		}

		return view('admin.pages.business_categories', [
			'categories' => $records,
		]);
	}

	public function edit(Request $request, $id = null)
	{
		$category = new Category();
		if (null !== $id) {
			$category = Category::find($id);
		}

		return view('admin.pages.business_category', [
			'category' => $category,
		]);
	}

	public function save(Request $request, $id = null)
	{
		// validate the request
		$this->validate($request, [
			'name' => 'required|max:255',
		], [
			'name.required' => 'Bir ad girmelisiniz.',
		]);

		$category = new Category();
		if (null !== $id) {
			$category = Category::find($id);
			ToastHelper::info('Kategori güncellendi.');
		} else {
			ToastHelper::success('Yeni kategori eklendi.');
		}

		$category->type_id = 2;
		$category->name = $request->input('name');
		$category->save();

		return redirect()->route('admin.business_categories.edit', [$category->id]);
	}

	public function remove(Request $request, Category $category)
	{
		RemoveHelper::hook();

		return view('admin.pages.remove', [
			'name' => $category->name,
		]);
	}

	public function destroy(Request $request, Category $category)
	{
		$category->delete();

		ToastHelper::warning($category->name . ' silindi.');

		return RemoveHelper::goBack('admin.business_categories');
	}
}
