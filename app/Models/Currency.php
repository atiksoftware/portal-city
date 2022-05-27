<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	protected $attributes = [
		'code' => '', // [type:string]
		'name' => '', // [type:string]

		'price' => 0, // [type:float]

		'is_rising' => false, // [type:boolean]
	];

	protected $casts = [
		'code' => 'string',
		'name' => 'string',
		'price' => 'float',
		'is_rising' => 'boolean',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public static $currencies = [];

	public static function getAll()
	{
		if (0 === \count(self::$currencies)) {
			self::$currencies = self::all();
			if (0 === \count(self::$currencies)) {
				self::sync();
			}
		}

		if (\count(self::$currencies) > 0) {
			if (self::$currencies[0]->updated_at->diffInDays() > 1) {
				self::sync();
			}
		}

		return self::$currencies;
	}

	public static function byCode($code)
	{
		foreach (self::getAll() as $currency) {
			if ($currency->code === $code) {
				return $currency;
			}
		}

		return new self();
	}

	public static function sync(): void
	{
		self::syncCurrencies();
		// self::syncGold();
		self::$currencies = self::all();
	}

	public static function syncCurrencies(): void
	{
		$url = 'https://api.genelpara.com/embed/para-birimleri.json';
		$client = new \GuzzleHttp\Client();
		$options = [
			'headers' => [
				'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36',
				'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
			],
			'timeout' => 5,
			'connect_timeout' => 5,
		];
		// send request
		$response = $client->get($url, $options);

		$data = $response->getBody()->getContents();

		$data = json_decode($data, true);

		$names = [
			'USD' => 'ABD Doları',
			'EUR' => 'Avro',
			'BTC' => 'Bitcoin',
			'ETH' => 'Ethereum',
			'GA' => 'ALTIN',
		];

		foreach (array_keys($names) as $code) {
			$currency = self::where('code', $code)->first();

			if (!$currency) {
				$currency = new self();
				$currency->code = $code;
			}
			$currency->name = $names[$code];

			$currency->price = (float) $data[$code]['satis'];
			$currency->is_rising = (float) $data[$code]['degisim'] > 0;

			$currency->save();
		}
	}

	// public static function syncGold(): void
	// {
	// 	echo file_get_contents('https://api.genelpara.com/embed/altin.json');
	// 	exit;
	// 	$data = json_decode(file_get_contents('https://api.genelpara.com/embed/altin.json'), true);

	// 	$currency = self::where('code', 'GA')->first();

	// 	if (!$currency) {
	// 		$currency = new self();
	// 		$currency->code = 'GA';
	// 	}
	// 	$currency->name = 'ALTIN';

	// 	dd($data);

	// 	$currency->price = (float) $data['GA']['satis'];
	// 	$currency->is_rising = (float) $data['GA']['degisim'] > 0;

	// 	$currency->save();
	// }
}
