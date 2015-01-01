<?php

class EstadosSeeder extends Seeder {

	public function run()
	{
        
        //Clear table
        DB::table('estados')->delete();

        // Estados
		DB::select(DB::raw("INSERT INTO `estados` (`id`, `nome`, `sigla`, `created_at`, `updated_at`) VALUES
		(1, 'Acre', 'AC', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(2, 'Alagoas', 'AL', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(3, 'Amazonas', 'AM', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(4, 'Amapá', 'AP', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(5, 'Bahia', 'BA', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(6, 'Ceará', 'CE', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(7, 'Distrito Federal', 'DF', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(8, 'Espírito Santo', 'ES', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(9, 'Goiás', 'GO', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(10, 'Maranhão', 'MA', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(11, 'Minas Gerais', 'MG', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(12, 'Mato Grosso do Sul', 'MS', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(13, 'Mato Grosso', 'MT', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(14, 'Pará', 'PA', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(15, 'Paraíba', 'PB', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(16, 'Pernambuco', 'PE', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(17, 'Piauí', 'PI', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(18, 'Paraná', 'PR', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(19, 'Rio de Janeiro', 'RJ', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(20, 'Rio Grande do Norte', 'RN', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(21, 'Rondônia', 'RO', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(22, 'Roraima', 'RR', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(23, 'Rio Grande do Sul', 'RS', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(24, 'Santa Catarina', 'SC', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(25, 'Sergipe', 'SE', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(26, 'São Paulo', 'SP', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP ),
		(27, 'Tocantins', 'TO', CURRENT_TIMESTAMP ,CURRENT_TIMESTAMP)"));        
        
	}
}