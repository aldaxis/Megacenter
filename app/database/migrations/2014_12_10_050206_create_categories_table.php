<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 // Create the categories table
        Schema::create('categories', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->string('titulo', 255);
            $table->text('descricao')->nullable()->default(null);
            $table->string('slug', 255)->unique();
            $table->integer('parent_id')->unsigned()->nullable()->default(null);
            $table->boolean('disabled')->default(0);
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
		Schema::drop('categories');
	}

}
