<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
	protected $attributes = [
		'type_id' => 1, // [type:integer, def:1] Block Type ID (1: Text, 2: Image )
		'content' => '', // [type:string, dbType:text]
	];

	protected $casts = [
		'type_id' => 'integer',
		'content' => 'string',
	];

	protected $appends = [];

	protected $guarded = [];

	protected $hidden = [];

	public function images()
	{
		return $this->belongsToMany(Inode::class, 'block_images', 'block_id', 'inode_id');
	}
}
