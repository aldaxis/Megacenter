<?php

class Estado extends Eloquent {
    
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'estados';
    
    public function cidades(){
        return $this->hasMany('Cidade', 'estado_id', 'id');
    }
    
}
