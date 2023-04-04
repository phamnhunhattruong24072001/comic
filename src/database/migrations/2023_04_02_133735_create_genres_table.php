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
		Schema::create('genres', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('name_another')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->text('tags')->nullable();
            $table->boolean('highlight')->nullable()->default(0);
            $table->integer('view_search')->nullable()->default(0);
            $table->boolean('is_visible')->default(0);
            $table->softDeletes();
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
		Schema::drop('genres');
	}
};
