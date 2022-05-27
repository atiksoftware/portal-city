<?php

namespace App\Models;

use App\Enums\InodeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Inode extends Model
{
	protected $attributes = [
		'uuid' => '', // [type:string, length:36]
		'path' => '', // [type:string]
		'width' => 0, // [type:integer]
		'height' => 0, // [type:integer]
		'size' => 0, // [type:integer]
		'duration' => 0, // [type:integer]
		'type' => InodeType::IMAGE, // [type:string, enum:InodeType, def:1] InodeType
	];

	protected $casts = [
		'uuid' => 'string',
		'path' => 'string',
		'width' => 'integer',
		'height' => 'integer',
		'size' => 'integer',
		'duration' => 'integer',
		'type' => InodeType::class,
	];

	protected $appends = ['link', 'image'];

	protected $guarded = [];

	protected $hidden = [];

	protected function link(): Attribute
	{
		return Attribute::make(
			get: fn () => url($this->path),
		);
	}

	protected function image(): Attribute
	{
		if (InodeType::IMAGE === $this->type) {
		}
		if (InodeType::VIDEO === $this->type) {
			return Attribute::make(
				get: fn () => str_replace('.mp4', '.webp', $this->link),
			);
		}

		return Attribute::make(
			get: fn () => $this->link,
		);
	}

	public function widthByScaledHeight(int $height) 
	{
		return $height * $this->width / $this->height;
	}
}
