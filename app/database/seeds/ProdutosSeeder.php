<?php

class ProdutosSeeder extends Seeder {

	public function run()
	{

        //Clear table
        DB::table('produtos')->delete();
        
        //Cria um novo produto
        $produto = new Produto();
        $produto->nome = "Veja Multiuso";
        $produto->fabricante = "Reckitt Benckiser";
        $produto->descricao = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa";
        $produto->slug = "veja-multiuso";
        $produto->dir_name = md5(uniqid(rand(), true));
        $produto->save();
        
        //Adiciona as categorias
        $produto->categories()->sync(array(1,11));
        
        //Cria um novo produto
        $produto = new Produto();
        $produto->nome = "Esponja de Aço";
        $produto->fabricante = "Assolan";
        $produto->descricao = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa";
        $produto->slug = "esponja-de-aco";
        $produto->dir_name = md5(uniqid(rand(), true));
        $produto->save();
        
        //Adiciona as categorias
        $produto->categories()->sync(array(1,11,12));
        
        //Cria um novo produto
        $produto = new Produto();
        $produto->nome = "Café - 500g";
        $produto->fabricante = "Pilão";
        $produto->descricao = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa";
        $produto->slug = "cafe-500g";
        $produto->dir_name = md5(uniqid(rand(), true));
        $produto->save();
        
        //Adiciona as categorias
        $produto->categories()->sync(array(2));
        
        //Cria um novo produto
        $produto = new Produto();
        $produto->nome = "Copos 200ml - 100 unid.";
        $produto->fabricante = "Copobras";
        $produto->descricao = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa";
        $produto->slug = "copos-200ml-100unid";
        $produto->dir_name = md5(uniqid(rand(), true));
        $produto->save();
        
        //Adiciona as categorias
        $produto->categories()->sync(array(3));
  
	}
}