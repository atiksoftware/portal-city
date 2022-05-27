<?php

namespace App\Http\Controllers\Admin;

use App\Models\Adword;
use App\Helpers\ToastHelper;
use Illuminate\Http\Request;
use App\Helpers\RemoveHelper;
use App\Http\Controllers\Controller;

class AdwordController extends Controller
{
	public function index(Request $request)
	{
		$records = [];

		$search = $request->input('search');

		if (null !== $search) {
			$records = Adword::where('title', 'like', '%' . $search . '%')->orderBy('title', 'ASC')->paginate(50);
		} else {
			$records = Adword::orderBy('title', 'ASC')->paginate(50);
		}

		return view('admin.pages.adwords', [
			'adwords' => $records,
		]);
	}

	public function edit(Request $request, $id = null)
	{
		$adword = new Adword();
		if (null !== $id) {
			$adword = Adword::find($id);
		}

		return view('admin.pages.adword', [
			'adword' => $adword,
		]);
	}

	public function save(Request $request, $id = null)
	{
		$this->validate($request, [
			'title' => 'required|max:255',
		], [
			'title.required' => 'Bir başlık girmelisiniz.',
		]);

		$adword = new Adword();

		if (null !== $id) {
			$adword = Adword::find($id);
			ToastHelper::info('Reklam kodu bilgileri güncellendi.');
		} else {
			ToastHelper::success('Yeni reklam kodu oluşturuldu.');
		}

		$adword->title = $request->input('title');
		$adword->type_id = $request->input('type_id');
		$adword->html_code = $request->input('html_code');
		$adword->target_url = $request->input('target_url');
		$adword->is_active = $request->boolean('is_active');
		$adword->save();

		$adword->images()->detach();
		$adword->images()->attach($request->input('images'));

		return redirect()->route('admin.adwords.edit', [$adword->id]);
	}

	public function remove(Request $request, Adword $adword)
	{
		RemoveHelper::hook();

		return view('admin.pages.remove', [
			'name' => $adword->title,
		]);
	}

	public function destroy(Request $request, Adword $adword)
	{
		$adword->delete();

		ToastHelper::warning($adword->name . ' silindi!');

		return RemoveHelper::goBack('admin.users');
	}
}
