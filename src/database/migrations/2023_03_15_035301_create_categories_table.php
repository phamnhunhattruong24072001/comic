<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
			$table->string('name');
			$table->string('type')->default('image')->nullable();
			$table->string('slug')->unique();
			$table->string('tags')->nullable();
			$table->text('short_desc')->nullable();
			$table->text('long_desc')->nullable();
			$table->boolean('is_visible')->default(0);
            $table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}
};
