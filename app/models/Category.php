<?php

class Category extends Eloquent {
    
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'categories';
    
    /**
     * Produtos
     *
     * @return object
     */
    public function produtos()
    {
        return $this->belongsToMany('Produto', 'categoria_produto')->withTimestamps();
    }
    
    /**
     * Get the parent of a category
     * 
     * @return object
     */
    public function parent()
    {
        return $this->hasOne('Category', 'id', 'parent_id');
    }
    
    /**
     * Get the children of a category
     * 
     * @return object
     */
    public function children()
    {
        return $this->hasMany('Category', 'parent_id', 'id');
    }
    
    public static function tree() {

        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=', NULL)->get();
        
        /*$teste = Category::tree();
        
        foreach($teste as $item){
            echo '<li>' . $item->titulo;
            foreach($item['children'] as $child){
                '<li>' . $child->titulo . '</li>';
            }
            echo '</li>';
        }*/

    }
    
    /**
     * Gera um menu multi-level adicionando os itens
     * ao objeto passado por referência
     * 
     * @param Array $itens
     * @param Lavary/Menu $menu
     * @param int $parent_id
     */
    public static function makeOrderedMenu($itens, $menu, $parent_id = 0, array $make_active = array())
    {
        //Faz a iteração dos itens
        foreach($itens as $item)
        {
            
            //Verifica se "pai" do item atual é igual ao passado por parâmetro
            if($item->parent_id == $parent_id)
            {
                
                //Determina se o item será adicionado a um elemento pai ou não.
                $objMenu = ($menu->find($parent_id) !== null) ? $menu->find($parent_id) : $menu;
                
                //Adiciona o item atual ao menu
                $objMenu->add($item->titulo, $item->id, array('url'  => 'produtos/categoria/' . $item->slug, 'id' => 'item' . $item->id));
                
                //Verifica se há itens a serem marcados
                if(in_array($item->id, $make_active)){
                    
                    $menu->last()->active(); 
                }
                
                //Faz a chamada a função novamente (recursividade)
                self::makeOrderedMenu($itens, $menu, $item->id, $make_active);

            }
        }
    }
    
}
