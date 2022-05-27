<?php

namespace Database\Seeders;

use App\Models\Inode;
use Illuminate\Database\Seeder;

class InodeSeeder extends Seeder
{
	public function addInode($uuid, $storage_path, $path, ): void
	{
		$inode = new Inode();
		$inode->uuid = $uuid;

		$image = \Image::make($storage_path);
		$inode->width = $image->width();
		$inode->height = $image->height();

		$inode->path = $path;
		$inode->size = filesize($storage_path);

		$inode->save();
	}

	public function run(): void
	{
		$this->addInode(
			'person_profile_image',
			storage_path('app/public/defaults/person_profile_image.webp'),
			'storage/defaults/person_profile_image.webp',
		);
		$this->addInode(
			'person_cover_image',
			storage_path('app/public/defaults/person_cover_image.webp'),
			'storage/defaults/person_cover_image.webp',
		);

		$this->addInode(
			'business_profile_image',
			storage_path('app/public/defaults/business_profile_image.webp'),
			'storage/defaults/business_profile_image.webp',
		);
		$this->addInode(
			'business_cover_image',
			storage_path('app/public/defaults/business_cover_image.webp'),
			'storage/defaults/business_cover_image.webp',
		);

		$this->addInode(
			'post_cover_image',
			storage_path('app/public/defaults/post_cover_image.webp'),
			'storage/defaults/post_cover_image.webp',
		);
	}
}
