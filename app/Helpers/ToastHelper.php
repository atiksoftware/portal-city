<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;

class ToastHelper
{
	public static function success($text): void
	{
		self::add('success', $text);
	}

	public static function error($text): void
	{
		self::add('error', $text);
	}

	public static function info($text): void
	{
		self::add('info', $text);
	}

	public static function warning($text): void
	{
		self::add('warning', $text);
	}

	public static function add($type, $text): void
	{
		$toasts = Session::has('toasts') ? Session::get('toasts') : [];
		$toasts[] = [
			'type' => $type,
			'text' => $text,
		];
		Session::put('toasts', $toasts);
	}

	public static function get()
	{
		$toasts = Session::has('toasts') ? Session::get('toasts') : [];
		if (\count($toasts) > 0) {
			Session::forget('toasts');
		}

		return $toasts;
	}
}
