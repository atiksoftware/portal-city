<?php

namespace App\Transporter;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserManager
{
	public $list = [];

	public function run(): void
	{
		$this->removeAll();

		$rows = Helper::getCollection('users');
		$count = \count($rows);

		foreach ($rows as $i => $row) {
			Helper::info($i . '/' . $count . ' - ' . $row['fname'] . ' ' . $row['lname']);
			$this->import($row);
		}
	}

	public function removeAll(): void
	{
		foreach (User::all() as $item) {
			$item->delete();
		}
	}

	public function import($row): void
	{
		if (empty($row['fname']) && empty($row['lname'])) {
			Helper::info('User name is empty');

			return;
		}

		// if is $row['email'] exists, then check if it is unique
		if (isset($row['email']) && !empty($row['email'])) {
			$user = User::where('email', $row['email'])->first();

			if ($user) {
				Helper::info('User already exists');

				return;
			}
		}

		$user = User::create([
			'firstname' => $row['fname'],
			'lastname' => Str::upper($row['lname'] ?? ''),

			'email' => $row['email'],
			'password' => Hash::make('password'),

			'is_admin' => isset($row['admin']) && ('1' === $row['admin'] || 1 === $row['admin']),
		]);

		$this->list[$row['_id']] = $user;
	}
}
