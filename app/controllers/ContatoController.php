<?php

class ContatoController extends BaseController {

    /**
     * Página home
     * 
     * @return View
     */
	public function getIndex()
	{
        
        //Define o título da página
        View::share('title', "Megacenter | Contato");
        
        return View::make('contato');
	}

}
