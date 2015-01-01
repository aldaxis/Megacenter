<?php

class EmpresasSeeder extends Seeder {

	public function run()
	{

        //Clear table
        DB::table('empresas')->delete();
        
        //Insere uma nova empresa
        $empresa = new Empresa();
        $empresa->nome = "Aldaxis Marketing LTDA";
        $empresa->cnpj = '14327572000194';
        $empresa->inscricao_estadual = '374603332210';
        $empresa->endereco = 'Avenida Pedroso de Morais, 2592 - Pinheiros';
        $empresa->estado_id = 26;
        $empresa->cidade_id = 5270;
        $empresa->cep = '05420-003';
        $empresa->telefone = '(11) 2373-7965';
        $empresa->celular = '(11) 96858-8930';
        $empresa->nome_contato = 'Felipe';
        $empresa->email_contato = 'felipe@aldaxis.com.br';
        $empresa->cargo_contato = 'Programador';
        $empresa->save();        
        
	}
}