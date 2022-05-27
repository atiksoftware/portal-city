<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
	protected $attributes = [
		'degree' => 0, // [type:float]
		'min' => 0, // [type:float]
		'max' => 0, // [type:float]
		'night' => 0, // [type:float]
		'icon' => '', // [type:string, nullable]
		'description' => '', // [type:string, nullable]
		'status' => '', // [type:string, nullable]
		'date' => '', // [type:string, nullable]
		'day' => '', // [type:string, nullable]
	];

	protected $casts = [
		'degree' => 'float',
		'min' => 'float',
		'max' => 'float',
		'night' => 'float',
		'icon' => 'string',
		'description' => 'string',
		'status' => 'string',
		'date' => 'string',
		'day' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public static $today;

	public static function Today()
	{
		if (null === self::$today) {
			self::$today = self::first();
			if (null === self::$today) {
				self::sync();
			}
		}

		if (null !== self::$today) {
			if (self::$today->updated_at->diffInDays() > 1) {
				self::sync();
			}
		}

		return self::$today;
	}

	public static function sync(): void
	{
		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => 'https://api.collectapi.com/weather/getWeather?data.lang=tr&data.city=' . Str::lower(Settings::get('CITY_NAME')),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => [
				'authorization: apikey ' . env('COLLECTAPI_TOKEN'),
				'content-type: application/json',
			],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			// !!! ERROR LOG !!!
		}

		$weather = self::first();
		if (!$weather) {
			$weather = new self();
		}

		$data = json_decode($response, true);

		// if success is true in data
		if (isset($data['success'])) {
			if (true === $data['success']) {
				$result = $data['result'][0];
				$weather->date = $result['date'];
				$weather->day = $result['day'];
				$weather->degree = (float) $result['degree'];
				$weather->min = (float) $result['min'];
				$weather->max = (float) $result['max'];
				$weather->night = (float) $result['night'];
				$weather->description = $result['description'];
				$weather->icon = $result['icon'];
				$weather->status = $result['status'];
				$weather->save();
				self::$today = $weather;
			}

			// !!! ERROR LOG !!!
		}

		// !!! ERROR LOG !!!
	}
}
