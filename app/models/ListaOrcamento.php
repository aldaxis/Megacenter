<?php

class ListaOrcamento {

    /**
     * Adiciona um item à lista de orçamento
     * 
     * @param array $item
     */
    public static function add(array $item){
        
        if(Session::has('produtos')){
            
            $itens = Session::get('produtos');
            
        }else {
            
            $itens = array();
        }
        
        $id = $item['id'];

        $itens[$id] = $item;

        Session::put('produtos', $itens);
    }
    
    /**
     * Remove um item da lista
     * 
     * @param int $id
     */
    public static function remove($id){
        
        if(Session::has('produtos')){
            
            $itens = Session::get('produtos');
            
            unset($itens[$id]);
            
            Session::put('produtos', $itens);
        }
        
    }
    
    /**
     * Verifica se um item já foi adicionado
     * 
     * @param int $id
     * @return boolean
     */
    public static function has($id){
        
        if(Session::has('produtos')){
            
            $itens = Session::get('produtos');
            
            if(isset($itens[$id]) && ! empty($itens[$id])){
                return true;
            }     
        }
        
        return false;    
    }
    
    /**
     * Resgata todos os itens da lista
     * 
     * @param bool $reverse
     * @return array
     */
    public static function getAll($reverse = false){
        
        $itens = array();
        
        if(Session::has('produtos')){
            
            $itens = Session::get('produtos');
            
            if($reverse){
                $itens = array_reverse ($itens, true);
            }
            
        }
        
        return $itens;
    }
    
    /**
     * Resgata um item pelo id
     * 
     * @param int $id
     * @return array
     */
    public static function getItem($id){
        
        $item = array();
        
        if(Session::has('produtos')){
            
            $item = Session::get('produtos');
            $item = $item[$id];
            
        }
        
        return $item;
    }
    
    /**
     * Limpa a lista de orçamento
     */
    public static function clear(){
        
        if(Session::has('produtos')){
            
            Session::put('produtos', array());
            
        }
        
    }
    
}
