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
            $table->string('name');
            $table->string('slug')->unique();
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
