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
        Schema::create('inodes', function (Blueprint $table) {
			$table->id();
			$table->string('uuid', 36);
			$table->string('path');
			$table->integer('width');
			$table->integer('height');
			$table->integer('size');
			$table->integer('duration');
			$table->enum('type', [1, 2])->comment('InodeType');
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
        Schema::dropIfExists('inodes');
    }
};
