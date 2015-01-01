<?php

class HomeController extends BaseController {

    /**
     * Página home
     * 
     * @return View
     */
	public function getIndex()
	{
        //Resgata alguns produtos
        $produtos = Produto::orderByRaw('RAND()')->take(4)->get();
        
        //Define o título da página
        View::share('title', "Megacenter");
        
        return View::make('home', array('produtos' => $produtos));
	}

}
