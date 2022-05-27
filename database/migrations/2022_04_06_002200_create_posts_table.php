<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug');
			$table->foreignId('district_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('District ID');
			$table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('Category ID');
			$table->text('summary');
			$table->text('content');
			$table->string('youtube_link')->nullable();
			$table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('User ID');
			$table->integer('view_count');
			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
