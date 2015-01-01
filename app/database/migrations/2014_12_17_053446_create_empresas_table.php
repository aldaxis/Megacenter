<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('empresas', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';

            $table->increments('id')->unsigned();
            $table->string('nome', 255);
            $table->string('cnpj', 18)->unique();
            $table->string('inscricao_estadual', 20)->nullable();
            $table->string('endereco', 255);
            $table->integer('estado_id')->unsigned();
            $table->integer('cidade_id')->unsigned();
            $table->string('complemento', 255)->nullable();
            $table->string('cep', 9);
            $table->string('telefone', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('nome_contato', 255);
            $table->string('email_contato', 255);
            $table->string('cargo_contato', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('cidade_id')->references('id')->on('cidades');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('empresas');
	}

}
