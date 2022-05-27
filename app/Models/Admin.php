<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	protected $attributes = [
		'firstname' => '', // [type:string,length:32,nullable]
		'lastname' => '', // [type:string,length:32,nullable]

		'email' => '', // [type:string,length:64]
	];

	protected $casts = [
		'firstname' => 'string',
		'lastname' => 'string',
		'email' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
