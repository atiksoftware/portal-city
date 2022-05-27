<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
	protected $attributes = [
		'film_name' => '', // [type:string, nullable]
		'image_url' => '', // [type:string, nullable]
	];

	protected $casts = [
		'film_name' => 'string',
		'image_url' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public static $cache = [];

	public static function getAll()
	{
		if (0 === \count(self::$cache)) {
			self::$cache = self::all();
		}
		if (0 === \count(self::$cache)) {
			self::sync();
		}

		if (!empty(self::$cache) && \count(self::$cache) > 0) {
			if (self::$cache[0]->updated_at->diffInHours() > 6) {
				self::sync();
			}
		}

		return self::$cache;
	}

	public static function sync(): void
	{
		$cinema_module = Settings::get('CINAMA_MODULE');
		$params = explode(':', $cinema_module);
		$module_name = $params[0];
		switch ($module_name) {
			case 'cinemapink':
				self::syncCinemaPink($params);
				break;
		}

		self::$cache = self::all();
	}

	public static function syncCinemaPink($params): void
	{
		$CinemaBranchId = (int) $params[1];
		$films = self::getFilmsFromBiletinial($CinemaBranchId);

		foreach (self::all() as $cinema) {
			$cinema->delete();
		}
		foreach ($films as $film) {
			$cinema = new self();
			$cinema->film_name = $film['film_name'];
			$cinema->image_url = $film['image_url'];
			$cinema->save();
		}
	}

	public static function getFilmsFromBiletinial($CinemaBranchId)
	{
		$date = date('Y-m-d');
		$url = "http://sinemaapi.biletinial.com/api/cinema_seance_service/get_cinemapink_seances/{$date}";
		$data = json_decode(file_get_contents($url));
		$films = [];
		foreach ($data as $item) {
			if ((int) $item->CinemaBranchId !== $CinemaBranchId) {
				continue;
			}
			$film_name = $item->FilmName;
			$image_url = $item->ImageUrl;
			foreach ($films as $film) {
				if ($film['film_name'] === $film_name) {
					continue 2;
				}
			}
			$films[] = [
				'film_name' => $film_name,
				'image_url' => $image_url,
			];
		}

		return $films;
	}
}
