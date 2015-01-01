<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//User seeder
		$this->call('UserSeeder');
		$this->command->info('User table seeded!');
        
        //Categories seeder
		$this->call('CategoriesSeeder');
		$this->command->info('Categories table seeded!');
        
        //Produtos seeder
		$this->call('ProdutosSeeder');
		$this->command->info('Produtos table seeded!');
        
        //Estados seeder
		$this->call('EstadosSeeder');
		$this->command->info('Estados table seeded!');
        
        //Cidades seeder
		$this->call('CidadesSeeder');
		$this->command->info('Cidades table seeded!');
        
        //Empresas seeder
		$this->call('EmpresasSeeder');
		$this->command->info('Empresas table seeded!');
	}

}
