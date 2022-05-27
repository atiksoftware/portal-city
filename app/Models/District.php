<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	protected $attributes = [
		'name' => '', // [type:string]
		'slug' => '', // [type:string]
	];

	protected $casts = [
		'name' => 'string',
		'slug' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];
}
