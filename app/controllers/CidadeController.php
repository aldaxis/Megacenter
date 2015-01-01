<?php

class CidadeController extends BaseController {

    /**
     * Resgata todas as cidades de um estado
     * 
     * @return Response Json
     */
	public function getPorEstado($estado_id)
	{
        
        $cidades = Cidade::where('estado_id', $estado_id)->select('id', 'nome')->get()->toArray();
        return Response::json($cidades);
        
	}

}