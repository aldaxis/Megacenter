<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cidades', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nome', 200);
			$table->integer('estado_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::table('cidades', function(Blueprint $table) {
			$table->foreign('estado_id')->references('id')->on('estados')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		/*Schema::table('cidades', function(Blueprint $table) {
			$table->dropForeign('cidade_estado_id_foreign');
		});*/
		
		Schema::drop('cidades');
	}

}
