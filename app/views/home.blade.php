@extends('layouts.default')
 
@section('page')
    
<div id="home" class="page pg-home">
    
    <div class="banner">
        <div class="container"><div class="art-brand"></div>
            <div class="brand-box">
                <p class="title">Variedade,<br />&nbsp;&nbsp;qualidade e<br />&nbsp;&nbsp;&nbsp;&nbsp;compromisso.</p>
                <p class="text">
                    Lorem ipsum dolor sit amet, consectetur 
                    adipiscing elit, sed do eiusmod tempor 
                    incididunt ut labore et dolore magna 
                    aliqua.<br /><br />
                    <a href="/empresa" class="saiba-mais">Saiba mais</a>
                </p>
            </div>  
        </div>
    </div>
    
    <div class="content">
        <div class="container">
            
                <div class="box-produtos">

                    <p class="head-label">produtos</p>

                    <ul class="produtos">
                        @foreach($produtos as $p)
                        <li class="item">
                            <a href="/produtos/item/{{ $p->slug }}">
                                <div class="photo"></div>
                                <p class="nome">{{ $p->nome }}<br /><span>{{ $p->fabricante }}</span></p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <a href="/produtos" class="confira-mais"><span class="text1">confira</span><br /><span class="text2">muito<br />mais</span></a>
                </div>
                <div class="grandes-marcas">

                    <p class="head-label">grandes marcas</p>

                    <div class="box-marcas">
                        <ul>
                            <li><div class="marca">{{ HTML::image('images/marcas/ype.png') }}</div></li>
                            <li><div class="marca">{{ HTML::image('images/marcas/assolan.png') }}</div></li>
                            <li><div class="marca">{{ HTML::image('images/marcas/hth.png') }}</div></li>
                            <li><div class="marca">{{ HTML::image('images/marcas/copobras.png') }}</div></li>
                            <li><div class="marca">{{ HTML::image('images/marcas/pilao.png') }}</div></li>
                        </ul>
                        <button class="btn-left"></button>
                        <button class="btn-right"></button>
                    </div>
                </div>
            
        </div>
    </div>
    
</div>

@stop