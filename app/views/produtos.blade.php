@extends('ly_produtos')
 
@section('content')

<div class="box-produtos">
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
    <div class="box-pagination">
        {{ $produtos->links() }}
    </div>
</div>

@stop