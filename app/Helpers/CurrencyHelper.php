<?php

namespace App\Helpers;

use App\Models\Currency;

class CurrencyHelper
{
	public static function sync(): void
	{
		self::syncCurrencies();
		self::syncGold();
	}

	public static function syncCurrencies(): void
	{
		$data = json_decode(file_get_contents('https://api.genelpara.com/embed/para-birimleri.json'), true);

		$names = [
			'USD' => 'ABD Doları',
			'EUR' => 'Avro',
			'BTC' => 'Bitcoin',
			'ETH' => 'Ethereum',
		];

		foreach (array_keys($names) as $code) {
			$currency = Currency::where('code', $code)->first();

			if (!$currency) {
				$currency = new Currency();
				$currency->code = $code;
			}
			$currency->name = $names[$code];

			$currency->price = (float) $data[$code]['satis'];
			$currency->is_rising = (float) $data[$code]['degisim'] > 0;

			$currency->save();
		}
	}

	public static function syncGold(): void
	{
		$data = json_decode(file_get_contents('https://api.genelpara.com/embed/altin.json'), true);

		$currency = Currency::where('code', 'GA')->first();

		if (!$currency) {
			$currency = new Currency();
			$currency->code = 'GA';
		}
		$currency->name = 'ALTIN';

		$currency->price = (float) $data['GA']['satis'];
		$currency->is_rising = (float) $data['GA']['degisim'] > 0;

		$currency->save();
	}
}
