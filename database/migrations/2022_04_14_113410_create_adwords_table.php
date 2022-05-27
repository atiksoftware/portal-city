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
        Schema::create('adwords', function (Blueprint $table) {
			$table->id();
			$table->string('title')->nullable();
			$table->string('type_id', 32)->nullable();
			$table->text('html_code')->nullable();
			$table->string('target_url')->nullable();
			$table->boolean('is_active');
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
        Schema::dropIfExists('adwords');
    }
};
