@extends('layouts.default')
 
@section('page')
    
<div id="produtos" class="page pg-produtos">
    
    <div class="banner">
        <div class="container">
            <div class="title">
                {{ HTML::image('images/icon_produtos.png') }}
                <span>produtos</span>
            </div>
            <div class="grandes-marcas"><p class="head-label">grandes<br />&nbsp;&nbsp;marcas</p></div>
        </div>
    </div>
    
    <div class="content">
        <div class="container">
             
            <div class="left-col">

                <div class="categorias">
                    <p class="label">categorias</p>

                    <ul class="menu">  
                        @include('menu-items', array('items' => $CategoriesMenu->roots()))
                    </ul>

                </div>

            </div>

            <div class="right-col">
                <div class="busca">
                    <input type="text" name="busca" id="txtBusca" placeholder="O que procura?" />
                    <button class="btn-buscar" id="btnBuscar"></button>
                </div>
                @yield('content')
            </div>

        </div>
    </div>
    
</div>

@stop