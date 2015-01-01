<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');

Route::group(array('prefix' => 'empresa'), function(){
    
    Route::get('/', 'EmpresaController@getIndex');
    
});

Route::group(array('prefix' => 'produtos'), function(){
    
    Route::get('/{pag?}', 'ProdutosController@getIndex')->where('pag', '[0-9]+');
    
    Route::get('/categoria/{categoria}', 'ProdutosController@getByCategory')->where(array(
        'categoria' => '[0-9a-z\-]+'
    ));
    
    Route::get('/busca/{chave}', 'ProdutosController@getCategoria')->where(array(
        'chave' => '[0-9a-z\-]+'
    ));
    
    Route::get('/item/{produto}', 'ProdutosController@getProduto')->where(array(
        'produto' => '[0-9a-z\-]+'
    ));

});

Route::group(array('prefix' => 'meu-orcamento'), function(){
    
    Route::get('/', 'OrcamentoController@getIndex');
    Route::get('/last-items/{qtde?}', 'OrcamentoController@getLastItems')->where('qtde', '[0-9]+');
    Route::post('/adicionar', 'OrcamentoController@postAddItem');
    Route::post('/remover', 'OrcamentoController@postRemoveItem');
    Route::post('/submit-registered', 'OrcamentoController@postSubmitRegistered');
    Route::post('/submit-nonregistered', 'OrcamentoController@postSubmitNonRegistered');
    
});

Route::group(array('prefix' => 'contato'), function(){
    
    Route::get('/', 'ContatoController@getIndex');
     
});

Route::group(array('prefix' => 'cidades'), function(){
    
    Route::get('/get/{estado}', 'CidadeController@getPorEstado')->where('estado', '[0-9]+');
     
});

//Gets the name of the route of administration
$admin_route = Config::get('admin.route');

//Routes of admin login
Route::get($admin_route . '/logout', array('as' => 'admin.logout', 'uses' => 'Admin\AuthController@getLogout'));
Route::get($admin_route . '/login', array('as' => 'admin.login', 'uses' => 'Admin\AuthController@showLogin'));
Route::post($admin_route . '/login', array('as' => 'admin.login.post', 'before' => 'csrf', 'uses' => 'Admin\AuthController@postLogin'));

//Routes of admin panel
Route::group(array('prefix' => $admin_route, 'before' => 'auth.admin|checkUser'), function()
{

	Route::get('/', function(){

		return 'Bem-vindo ' . Auth::user()->name . ' | ' . link_to_route('admin.logout', "Sair");

	});

	Route::get('/usuarios', function(){

		return "Página de usuários";

	});


    /*Route::any('/', 'App\Controllers\Admin\PagesController@index');
    Route::resource('articles', 'App\Controllers\Admin\ArticlesController');
    Route::resource('pages', 'App\Controllers\Admin\PagesController');*/
});
