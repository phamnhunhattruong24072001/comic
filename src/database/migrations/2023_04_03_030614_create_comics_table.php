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
		Schema::create('comics', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_another')->nullable();
            $table->string('slug')->unique();
            $table->string('author_name')->nullable();
            $table->integer('view')->default(0)->nullable();
            $table->text('tags')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('cover_image')->nullable();
            $table->text('many_pictures')->nullable();
            $table->boolean('highlight')->nullable()->default(0);
            $table->integer('view_search')->default(0)->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->boolean('status')->default(0);
            $table->dateTime('release_time')->nullable();
            $table->string('the_origin')->nullable();
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
		Schema::drop('comics');
	}
};
