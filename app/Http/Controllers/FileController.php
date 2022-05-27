<?php

namespace App\Http\Controllers;

use App\Enums\InodeType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class FileController extends Controller
{
	public function upload(Request $request)
	{
		// validate request
		$request->validate([
			'file' => 'required|file|max:12048|mimes:png,jpg,jpeg,webp,mp4',
		]);

		$file = $request->file('file');

		$directory_name = date('Y/m/d');
		$file_orginal_extension = strtolower($file->getClientOriginalExtension());

		$uuid = Str::uuid();
		$filename = $uuid . '.' . $file_orginal_extension;

		$is_image = \in_array($file_orginal_extension, ['jpg', 'jpeg', 'png', 'webp'], true);
		$is_video = \in_array($file_orginal_extension, ['mp4'], true);

		if ($is_image) {
			$filename = $uuid . '.webp';
		}

		$file_path = $directory_name . '/' . $filename;

		$file->storeAs('public/uploads/' . $directory_name, $filename);

		$file_real_path = storage_path('app/public/uploads/' . $file_path);

		$inode = new \App\Models\Inode();
		$inode->uuid = $uuid;
		$inode->path = '/storage/uploads/' . $file_path;

		if ($is_image) {
			$image = Image::make($file_real_path);
			$image->encode('webp', 75);
			// set image max size 1920 x 1080
			$image->resize(1920, 1080, function ($constraint): void {
				$constraint->aspectRatio();
				$constraint->upsize();
			});
			$image->save($file_real_path);

			$inode->width = $image->width();
			$inode->height = $image->height();
			$inode->type = InodeType::IMAGE;
		}
		if ($is_video) {
			$inode->type = InodeType::VIDEO;
			// $inode->duration = $this->getVideoDuration($file_real_path);
		}

		$inode->size = filesize($file_real_path);
		$inode->save();

		return response()->json($inode);
	}
}
