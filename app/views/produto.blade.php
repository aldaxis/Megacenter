@extends('ly_produtos')
 
@section('content')

<div class="box-produto" data-id="{{ $produto->id }}">
    <div class="categorias">
        <ol class="breadcrumb">
            @foreach($produto->categories as $c)
                
                @if($c == $produto->categories->last())
                    <li @if($produto->categories->count() > 1) class="active"@endif>{{ $c->titulo }}</li>
                @else
                    <li><a href="/produtos/categoria/{{ $c->slug }}">{{ $c->titulo }}</a></li>
                @endif
            @endforeach
        </ol>
    </div>
    <div class="left-col">
        <div class="foto"></div>
        <div class="info">
            <h1 class="nome">{{ $produto->nome }}<br /><span>{{$produto->fabricante}}</span></h1>
            <div class="descricao">
                <p class="head-title">Descrição</p>
                <p class="text">{{ $produto->descricao }}</p>
            </div>
            <div class="orcamento">
                <input type="text" id="txtQuantidade" name="quantidade" maxlength="6" placeholder="1" value="@if(isset($orcamento[$produto->id])) {{ $orcamento[$produto->id]['quantidade'] }} @endif" />
                <button class="adicionar" id="btnAdicionar"></button>
            </div>
        </div>
        <input type="hidden" name="nome" id="txtNome" value="{{ $produto->nome }}" />
        <input type="hidden" name="fabricante" id="txtFabricante" value="{{ $produto->fabricante }}" />
        <input type="hidden" name="slug" id="txtSlug" value="{{ $produto->slug }}" />
    </div>
    <div class="right-col">
        <div class="lista-orcamento">
            <div class="title"><span>Lista de<br />orçamento</span></div>
            <ul class="itens">
                @if(count($orcamento) > 0)
                    @foreach($orcamento as $item)
                    <li data-id="{{ $item['id'] }}">
                        <div class="box"><button class="btn-remover" title="Remover"></button>
                            <p class="nome">{{ $item['nome'] }}<br /><span>{{ $item['fabricante'] }}</span></p>
                            <p class="quantidade">{{ $item['quantidade'] }} @if($item['quantidade'] == 1)unid. @else unids. @endif</p>
                        </div>
                    </li>
                    @endforeach
                @else
                    <li class="empty">Nenhum item adicionado.</li>
                @endif
            </ul>
            <a href="/meu-orcamento" class="ver-lista"></a>
        </div>
    </div>
    @if(!$produtos->isEmpty())
    <div class="outros-produtos">
        <p class="head-title">Veja também</p>
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
    </div>
    @endif
</div>
    
@stop