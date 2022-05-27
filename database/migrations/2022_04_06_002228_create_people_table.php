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
        Schema::create('people', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('slug');
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('website')->nullable();
			$table->foreignId('district_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('District ID');
			$table->string('facebook_link')->nullable();
			$table->string('twitter_link')->nullable();
			$table->string('instagram_link')->nullable();
			$table->string('linkedin_link')->nullable();
			$table->string('youtube_link')->nullable();
			$table->string('tiktok_link')->nullable();
			$table->string('github_link')->nullable();
			$table->string('birth_date')->nullable();
			$table->string('birth_place')->nullable();
			$table->string('job_title')->nullable();
			$table->string('company_name')->nullable();
			$table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('User ID');
			$table->integer('view_count');
			$table->integer('fill_percentage');
			$table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('people');
    }
};
