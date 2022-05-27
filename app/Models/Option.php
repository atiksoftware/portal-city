<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
	protected $attributes = [
		'name' => '', // [type:string]
		'value' => '', // [type:string, dbType:text]
	];

	protected $casts = [
		'name' => 'string',
		'value' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
