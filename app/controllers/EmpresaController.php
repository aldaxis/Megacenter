<?php

class EmpresaController extends BaseController {

    /**
     * Página empresa
     * 
     * @return View
     */
	public function getIndex()
	{
        
        //Define o título da página
        View::share('title', "Megacenter | Empresa");
        
        return View::make('empresa');
	}

}
