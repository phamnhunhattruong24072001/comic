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
		Schema::create('chapters', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('comic_id');
            $table->foreign('comic_id')->references('id')->on('comics');
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('number_chapter');
            $table->string('slug');
            $table->text('content_image')->nullable();
            $table->text('content_text')->nullable();
            $table->text('short_desc')->nullable();
            $table->boolean('is_visible')->default(0)->nullable();
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
		Schema::drop('chapters');
	}
};
