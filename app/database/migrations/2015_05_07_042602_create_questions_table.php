<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title', 255);
            $table->text('content');
            $table->integer('view')->unsigned()->defaukt(0);
            $table->integer('vote');
            $table->integer('user_id')->unsigned()->default(0);
            $table->integer('category_id')->unsigned()->default(0);
            $table->timestamps();
		});

        Schema::table('questions', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions');
	}

}
