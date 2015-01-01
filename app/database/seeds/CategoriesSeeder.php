<?php

class CategoriesSeeder extends Seeder {

	public function run()
	{

        //Clear table
        DB::table('categories')->delete();
        
        $data = array(
            array(
                'titulo' => 'acessórios domésticos', 
                'slug' => 'acessorios-domesticos',
            ),
            array(
                'titulo' => 'artigos para festa', 
                'slug' => 'artigos-para-festa'
            ),
            array(
                'titulo' => 'bandejas diversas', 
                'slug' => 'bandejas-diversas'
            ),
            array(
                'titulo' => 'bandejas de isopor', 
                'slug' => 'bandejas-de-isopor'
            ),
            array(
                'titulo' => 'bobinas plásticas', 
                'slug' => 'bobinas-plasticas'
            ),
            array(
                'titulo' => 'caixas', 
                'slug' => 'caixas'
            ),
            array(
                'titulo' => 'cutelaria', 
                'slug' => 'cutelaria'
            ),
            array(
                'titulo' => 'dispensers', 
                'slug' => 'dispensers'
            ),
            array(
                'titulo' => 'embalagens', 
                'slug' => 'embalagens'
            ),
            array(
                'titulo' => 'e.p.i',
                'slug' => 'epi'
            )
        );

        Category::insert($data);
        
        //Cria subcategorias
        $cat = new Category();
        $cat->titulo = 'utensílios';
        $cat->slug = 'utensilios';
        $cat->parent_id = 1;
        $cat->save();
        
        $cat = new Category();
        $cat->titulo = 'diversos';
        $cat->slug = 'utensilios-diversos';
        $cat->parent_id = 11;
        $cat->save();
        
	}
}