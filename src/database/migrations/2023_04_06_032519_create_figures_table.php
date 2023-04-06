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
		Schema::create('figures', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('comic_id');
            $table->foreign('comic_id')->references('id')->on('comics');
            $table->unsignedInteger('chapter_appeared');
            $table->foreign('chapter_appeared')->references('id')->on('chapters');
            $table->unsignedInteger('chapter_end');
            $table->foreign('chapter_end')->references('id')->on('chapters');
            $table->string('name');
            $table->string('nickname')->nullable();
            $table->integer('age')->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('gender')->default(0)->nullable();
            $table->string('nationality')->nullable();
            $table->string('height')->nullable();
            $table->string('avatar');
            $table->boolean('character_role')->default(1)->nullable();
            $table->string('career')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('long_desc')->nullable();
            $table->text('relationship')->nullable();
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
		Schema::drop('figures');
	}
};
