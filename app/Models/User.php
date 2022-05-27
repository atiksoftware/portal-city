<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use HasApiTokens;
	use HasFactory;
	use HasSlug;
	use Notifiable;

	protected $attributes = [
		'firstname' => '', // [type:string ]
		'lastname' => '', // [type:string]
		'slug' => '', // [type:string, unique]
		'email' => '', // [type:string, unique]
		'password' => '', // [type:string]
		'remember_token' => '', // [type:string]
		'is_admin' => false, // [type:boolean]
		'is_active' => true, // [type:boolean]
	];

	protected $casts = [
		'firstname' => 'string',
		'lastname' => 'string',
		'slug' => 'string',
		'email' => 'string',
		'password' => 'string',
		'remember_token' => 'string',
		'is_admin' => 'boolean',
		'is_active' => 'boolean',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [
		'password',
		'remember_token',
	];

	public function getSlugOptions(): SlugOptions
	{
		return SlugOptions::create()
			->generateSlugsFrom(['firstname', 'lastname'])
			->saveSlugsTo('slug');
	}

	public function businesses()
	{
		return $this->hasMany(Business::class);
	}

	public function persons()
	{
		return $this->hasMany(Person::class);
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function getFullNameAttribute()
	{
		return $this->firstname . ' ' . $this->lastname;
	}
}
