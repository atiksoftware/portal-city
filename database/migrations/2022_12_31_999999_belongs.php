<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
	public function up(): void
	{
		Schema::create('post_featured_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('post_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});
		Schema::create('post_gallery_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('post_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});
		Schema::create('post_tags', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('post_id')->constrained();
			$table->foreignId('tag_id')->constrained();
		});

		Schema::create('block_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('block_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});

		Schema::create('business_profile_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('business_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});
		Schema::create('business_cover_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('business_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});
		Schema::create('business_blocks', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('business_id')->constrained();
			$table->foreignId('block_id')->constrained();
		});
		Schema::create('business_tags', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('business_id')->constrained();
			$table->foreignId('tag_id')->constrained();
		});

		Schema::create('person_profile_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('person_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});
		Schema::create('person_cover_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('person_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});
		Schema::create('person_blocks', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('person_id')->constrained();
			$table->foreignId('block_id')->constrained();
		});

		Schema::create('adword_images', function (Blueprint $table): void {
			$table->bigIncrements('id');
			$table->foreignId('adword_id')->constrained();
			$table->foreignId('inode_id')->constrained();
		});

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

	public function down(): void
	{
		Schema::dropIfExists('post_featured_images');
		Schema::dropIfExists('post_gallery_images');
		Schema::dropIfExists('post_tags');

		Schema::dropIfExists('block_images');

		Schema::dropIfExists('business_profile_images');
		Schema::dropIfExists('business_cover_images');
		Schema::dropIfExists('business_blocks');
		Schema::dropIfExists('business_tags');

		Schema::dropIfExists('person_profile_images');
		Schema::dropIfExists('person_cover_images');
		Schema::dropIfExists('person_blocks');

		Schema::dropIfExists('adword_images');
	}
};
