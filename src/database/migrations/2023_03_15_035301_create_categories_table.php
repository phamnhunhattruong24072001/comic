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
			$table->string('slug');
			$table->string('tags')->nullable();
			$table->text('short_desc')->nullable();
			$table->text('long_desc')->nullable();
			$table->boolean('parent_id')->default(0);
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
