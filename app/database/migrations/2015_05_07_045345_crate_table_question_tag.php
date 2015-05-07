<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateTableQuestionTag extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('question_tag', function(Blueprint $table)
		{
        	$table->increments('id');
        	$table->integer('question_id')->unsigned()->default(0);
        	$table->integer('tag_id')->unsigned()->default(0);
        	$table->timestamps();
		});

		Schema::table('question_tag', function(Blueprint $table){
			$table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('question_tag');
	}

}
