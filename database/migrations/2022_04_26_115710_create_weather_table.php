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
        Schema::create('weather', function (Blueprint $table) {
			$table->id();
			$table->float('degree');
			$table->float('min');
			$table->float('max');
			$table->float('night');
			$table->string('icon')->nullable();
			$table->string('description')->nullable();
			$table->string('status')->nullable();
			$table->string('date')->nullable();
			$table->string('day')->nullable();
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
        Schema::dropIfExists('weather');
    }
};
