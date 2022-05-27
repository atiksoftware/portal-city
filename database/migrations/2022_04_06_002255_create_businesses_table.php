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
        Schema::create('businesses', function (Blueprint $table) {
			$table->id();
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->string('phone')->nullable();
			$table->string('fax')->nullable();
			$table->string('email')->nullable();
			$table->string('website')->nullable();
			$table->string('address')->nullable();
			$table->string('zip')->nullable();
			$table->foreignId('district_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('District ID');
			$table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('Category ID');
			$table->string('google_maps_link')->nullable();
			$table->float('location_lat')->nullable();
			$table->float('location_lng')->nullable();
			$table->float('location_heading')->nullable();
			$table->float('location_pitch')->nullable();
			$table->boolean('location_show_map')->nullable();
			$table->boolean('location_show_view')->nullable();
			$table->string('working_start_at', 5)->nullable();
			$table->string('working_end_at', 5)->nullable();
			$table->integer('min_price');
			$table->integer('max_price');
			$table->string('currency', 3)->nullable()->default('TRY');
			$table->string('contact_person_name')->nullable();
			$table->string('youtube_link')->nullable();
			$table->integer('level');
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
        Schema::dropIfExists('businesses');
    }
};
