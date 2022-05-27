<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::create('users', function (Blueprint $table): void {
			$table->id();
			$table->string('firstname');
			$table->string('lastname');
			$table->string('slug')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('remember_token');
			$table->boolean('is_admin');
			$table->boolean('is_active');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		Schema::dropIfExists('users');
	}
};
