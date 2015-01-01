<?php

class Produto extends Eloquent {
    
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'produtos';
    
    /**
     * Categories
     *
     * @return object
     */
    public function categories()
    {
        return $this->belongsToMany('Category', 'categoria_produto');
    }
    
}
