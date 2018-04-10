<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration 
{
	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('status_id')->unsigned()->default(0)->index();
            $table->integerunsigned('user_id')->default(0)->index();
            $table->text('comment');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('comments');
	}
}
