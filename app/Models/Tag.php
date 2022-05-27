<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $attributes = [
		'name' => '', // [type:string]
	];

	protected $casts = [
		'name' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
