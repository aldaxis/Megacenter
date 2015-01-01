@extends('layouts.default')
 
@section('page')
    
<div id="empresa" class="page pg-empresa">
    
    <div class="banner">
        <div class="container"><div class="art-brand"></div><div class="mulher"></div>
            <div class="title">
                {{ HTML::image('images/icon_empresa.png') }}
                <span>empresa</span>
            </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container">
            <div class="box">
                
                <div class="texto">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo 
                    ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis 
                    dis parturient montes, nascetur ridiculus mus.</p>

                    <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla 
                    consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, 
                    vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis 
                    vitae, justo.</p>

                    <p>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. 
                    Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, 
                    porttitor eu, consequat vitae, eleifend ac, enim.</p>

                    <p>Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra 
                    nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies 
                    nisi vel augue. Curabitur ullamcorper ultricies nisi.</p>
                </div>
                
                <div class="grandes-marcas">

                    <p class="head-label">grandes<br /><span>&nbsp;&nbsp;marcas</span></p>

                    <div class="box-marcas">
                        <ul>
                            <li><div class="marca">{{ HTML::image('images/marcas/ype.png') }}</div></li>
                            <li><div class="marca">{{ HTML::image('images/marcas/assolan.png') }}</div></li>
                            <li><div class="marca">{{ HTML::image('images/marcas/hth.png') }}</div></li>
                            <li><div class="marca">{{ HTML::image('images/marcas/copobras.png') }}</div></li>
                            <li><div class="marca">{{ HTML::image('images/marcas/pilao.png') }}</div></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    
</div>

@stop