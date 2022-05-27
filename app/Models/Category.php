<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $attributes = [
		'name' => '', // [type:string]
		'slug' => '', // [type:string]

		'content' => '', // [type:string, dbType:text]

		'type_id' => 1, // [type:integer, default:1 ] Category Type ID 0: Post 1: Business

		'color' => '', // [type:string, length:12, nullable]
	];

	protected $casts = [
		'name' => 'string',
		'slug' => 'string',
		'content' => 'string',
		'type_id' => 'integer',
		'color' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function businesses()
	{
		return $this->hasMany(Business::class);
	}
}
