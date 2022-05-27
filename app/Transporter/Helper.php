<?php

namespace App\Transporter;

use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use App\Models\Inode;
use App\Enums\InodeType;
use App\Models\Category;
use App\Models\District;
use FFMpeg\Coordinate\TimeCode;

class Helper
{
	public static function clearText($text)
	{
		return preg_replace('/<([a-z][a-z0-9]*)[^>]*?(\\/?)>/si', '<$1$2>', $text);
	}

	public static function getUUID($string)
	{
		$hash = sha1($string);

		return substr($hash, 0, 8) . '-' . substr($hash, 8, 4) . '-' . substr($hash, 12, 4) . '-' . substr($hash, 16, 4) . '-' . substr($hash, 20, 12);
	}

	public static function dl($url, $file_path): void
	{
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$raw = curl_exec($ch);
		curl_close($ch);
		if (file_exists($file_path)) {
			unlink($file_path);
		}
		$fp = fopen($file_path, 'x');
		fwrite($fp, $raw);
		fclose($fp);
	}

	public static function getPhoneNumber($phone)
	{
		$phone = str_replace(' ', '', $phone);
		$phone = str_replace('-', '', $phone);
		// if start with 0
		if ('0' === substr($phone, 0, 1)) {
			$phone = '+9' . $phone;
		}

		return $phone;
	}

	public static function getDistrictId($ilce)
	{
		if (!$ilce) {
			return null;
		}
		if ('merkez' === $ilce) {
			$ilce = 'bolu';
		}
		$district = District::where('name', $ilce)->first();
		if ($district) {
			return $district->id;
		}

		return null;
	}

	public static function getCategoryId($slug)
	{
		if (!$slug) {
			$slug = 'haber';
		}
		$category = Category::where('slug', $slug)->first();
		if ($category) {
			return $category->id;
		}

		return null;
	}

	public static function info($text): void
	{
		echo $text . PHP_EOL;
	}

	public static function getInode($img_url)
	{
		// if $img_url not start with http, then add http://
		if (0 !== strpos($img_url, 'https:')) {
			$img_url = 'https:' . $img_url;
		}
		$img_url = str_replace(' ', '%20', $img_url);

		// example url : //storage.boludabolu.com/2017/11/23/18a43-WhatsApp Image 2017-09-19 at 15.23.13.jpg
		$uuid = self::getUUID($img_url);
		// get link without domain
		$parse = parse_url($img_url);
		$url_path = $parse['path'];

		$directory = \dirname($url_path);

		$redirects_path = storage_path('app/public/uploads/redirects.txt');

		$storage_directory = storage_path('app/public/uploads' . $directory);
		if (!is_dir($storage_directory)) {
			mkdir($storage_directory, 0755, true);
		}

		$inode = Inode::where('uuid', $uuid)->first();
		if (null !== $inode) {
			return $inode;
		}

		$inode = new Inode();
		$inode->uuid = $uuid;

		$ext = pathinfo($url_path, PATHINFO_EXTENSION);
		if ('mp4' === $ext) {
			$inode->type = InodeType::VIDEO;
		} else {
			$inode->type = InodeType::IMAGE;
		}

		if (InodeType::IMAGE === $inode->type) {
			$filename = $uuid . '.webp';
			$storage_path = $storage_directory . '/' . $filename;
			$inode->path = '/storage/uploads' . $directory . '/' . $filename;
			if (!file_exists($storage_path)) {
				self::info('downloading ' . $img_url);
				// download file as temp file
				$temp_file = tempnam(sys_get_temp_dir(), 'img');
				self::dl($img_url, $temp_file);

				// convert to webp
				self::info('converting ' . $temp_file . ' to ' . $storage_path);
				$image = \Image::make($temp_file);
				$image->encode('webp', 75);
				$image->save($storage_path);
				unlink($temp_file);
			}
			// self::info('reading sizes');
			$imagesize = getimagesize($storage_path);
			$inode->width = $imagesize[0];
			$inode->height = $imagesize[1];
			$inode->size = filesize($storage_path);
		}

		if (InodeType::VIDEO === $inode->type) {
			$filename = $uuid . '.mp4';
			$image_filename = $uuid . '.webp';
			$storage_path = $storage_directory . '/' . $filename;
			$image_storage_path = $storage_directory . '/' . $image_filename;
			$inode->path = '/storage/uploads' . $directory . '/' . $filename;

			$ffmpeg = FFMpeg::create([
				'ffmpeg.binaries' => env('FFMPEG_BINARIES'),
				'ffprobe.binaries' => env('FFPROBE_BINARIES'),
			]);
			$ffprobe = FFProbe::create([
				'ffprobe.binaries' => env('FFPROBE_BINARIES'),
			]);

			if (!file_exists($storage_path)) {
				self::info('downloading ' . $img_url);
				self::dl($img_url, $storage_path);
			}
			if (!file_exists($image_storage_path)) {
				$temp_file = tempnam(sys_get_temp_dir(), 'img');
				self::info('exporting thumbnail ' . $storage_path . ' to ' . $temp_file);

				$video = $ffmpeg->open($storage_path);
				$video
					->frame(TimeCode::fromSeconds(1))
					->save($temp_file);

				self::info('converting ' . $temp_file . ' to ' . $image_storage_path);
				$image = \Image::make($temp_file);
				$image->encode('webp', 75);
				$image->save($image_storage_path);
				unlink($temp_file);
			}
			// self::info('reading sizes ');

			$video = $ffprobe
				->streams($storage_path)
				->videos()
				->first();
			$dimensions = $video->getDimensions();
			$inode->width = $dimensions->getWidth();
			$inode->height = $dimensions->getHeight();
			$inode->duration = (int) $video->get('duration');
			$inode->size = filesize($storage_path);
		}

		$inode->save();

		return $inode;
	}

	public static function getCollection($collection)
	{
		$path = storage_path('collections') . '/' . $collection . '.json';

		return json_decode(file_get_contents($path), true);
	}
}
