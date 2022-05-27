<?php

namespace App\Helpers;

use App\Models\Weather;
use Illuminate\Support\Str;

class WeatherHelper
{
	public static function sync(): void
	{
		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => 'https://api.collectapi.com/weather/getWeather?data.lang=tr&data.city=' . Str::lower(env('DISTRICT_NAME')),
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

		$weather = Weather::first();
		if (!$weather) {
			$weather = new Weather();
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
			}

			// !!! ERROR LOG !!!
		}

		// !!! ERROR LOG !!!
	}
}
