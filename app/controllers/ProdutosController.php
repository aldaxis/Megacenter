<?php

class ProdutosController extends BaseController {
    
    /**
     * Index
     * 
     * @return View
     */
	public function getIndex()
	{
        $seed = date('dmy');
        
        //Resgata os produtos
        $produtos = Produto::orderByRaw('RAND("' . $seed . '")')->paginate(15);
        
        //Cria o menu de categorias
        $this->makeCategoriesMenu();
        
        //Define o título da página
        View::share('title', "Megacenter | Produtos");
        
        //Retorna a view
		return View::make('produtos', array('produtos' => $produtos));
	}
    
    /**
     * Get products by category
     * 
     * @return View
     */
    public function getByCategory(){
        
        //Resgata o slug
        $category_slug = Route::input('categoria');
        
        //Procura a categoria pelo slug
        $category = Category::where('slug', $category_slug)->firstOrFail();
        
        //Resgata os produtos da categoria
        $produtos = Produto::whereHas('categories', function($q) use ($category)
        {
            $q->where('id', $category->id);

        })->paginate(15);
        
        //Cria o menu de categorias
        $this->makeCategoriesMenu();
        
        //Define o título da página
        View::share('title', "Megacenter | " . $category->titulo);
        
        //Retorna a view
		return View::make('produtos', array('produtos' => $produtos));
        
    }
    
    /**
     * Shows information of a product
     * 
     * @return View
     */
    public function getProduto(){
        
        //Resgata o slug
        $produto_slug = Route::input('produto');
        
        //Procura o produto pelo slug
        $produto = Produto::where('slug', $produto_slug)->first();
        
        //Resgata as categorias do produto
        $categorias = $produto->categories;
        
        $ids = array();
        
        //Resgata os ids das categorias do produto
        foreach($categorias as $c){
            
            $ids[] = $c->id;
        }
                
        //Resgata outros produtos da mesma categoria
        $outros_produtos = Produto::where('id', '!=', $produto->id)->whereHas('categories', function($q) use ($ids)
        {
            $q->whereIn('id', $ids);

        })->take(5)->orderByRaw('RAND()')->get();
        
        /*Session::flush();
        Session::regenerate();*/

        //Cria o menu de categorias passando os ids dos 
        //itens que serão marcados
        $this->makeCategoriesMenu($ids);
        
        //Resgata os itens da lista de orçamento
        $orcamento = ListaOrcamento::getAll(true);
        
        //Define o título da página
        View::share('title', "Megacenter | " . $produto->nome);
        
        //Retorna a view
        return View::make('produto', array(
            'produto' => $produto, 
            'produtos' => $outros_produtos, 
            'orcamento' => $orcamento
        ));
        
    }
    
    /**
     * Cria o menu de categorias
     * 
     * @param array $make_active IDs dos itens que serão marcados como ativos
     */
    private function makeCategoriesMenu(array $make_active = array()) {
        
        //Cria o menu de categorias
        Menu::make('CategoriesMenu', function($menu) use($make_active) {
            
            //Resgata as categorias que contém produtos
            $itens = Category::has('produtos')->get();

            //Cria o menu
            Category::makeOrderedMenu($itens, $menu, 0, $make_active);
            
        });
        
    }

}
