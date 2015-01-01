<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produtos', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->string('nome', 255);
            $table->string('fabricante', 255)->nullable();
            $table->text('descricao', 255)->nullable();
            $table->string('slug', 255)->unique();
            $table->char('dir_name', 32)->unique();
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
		Schema::drop('produtos');
	}

}
