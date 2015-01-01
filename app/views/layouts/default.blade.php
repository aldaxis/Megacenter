<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Aldaxis Marketing LTDA">
    <meta name= "description" content= "" />
    <meta name="keywords" content="" />
    <link rel="icon" href="images/favicon.ico">

    <title>{{{ $title }}}</title>
    
    <!-- Styles -->
    {{ HTML::style('assets/css/layout.min.css') }}
</head>
<body role="document">
    
    <div class="wrapper"><div class="strip-top"></div>
        <header class="main-header">
            <div class="container">
                <a href="/">{{ HTML::image('images/logo.png', 'Megacenter', array('class' => 'logo')) }}</a>

                <ul class="menu">
                    <li><a href="/">{{ HTML::image('images/menu/home.png') }}home</a>{{ (Request::is('/') ? '<div class="active"></div>' : '') }}</li>
                    <li><a href="/empresa">{{ HTML::image('images/menu/empresa.png') }}empresa</a>{{ (Request::is('empresa') ? '<div class="active"></div>' : '') }}</li>
                    <li><a href="/produtos">{{ HTML::image('images/menu/produtos.png') }}produtos</a>{{ (Request::is('produtos*') ? '<div class="active"></div>' : '') }}</li>
                    <li><a href="/contato">{{ HTML::image('images/menu/contato.png') }}contato</a>{{ (Request::is('contato') ? '<div class="active"></div>' : '') }}</li>
                    <li><a href="/meu-orcamento">{{ HTML::image('images/menu/orcamento.png') }}meu orçamento</a>{{ (Request::is('meu-orcamento') ? '<div class="active"></div>' : '') }}</li>
                </ul>
       
            </div>
        </header>
        
        @yield('page')
        
        <footer class="footer">
            <div class="strip-1">
                <div class="container">
                    <ul class="menu">
                        <li><a href="/">home</a></li>
                        <li><a href="/empresa">empresa</a></li>
                        <li><a href="/produtos">produtos</a></li>
                        <li><a href="/contato">contato</a></li>
                        <li><a href="/meu-orcamento">meu orçamento</a></li>
                    </ul>
                    <div class="phone"><span>(11) 2373 7965</span></div>
                    <div class="brand"></div>
                </div>
            </div>
            <div class="strip-2">
                <div class="container">
                    <div class="copyright"><span><b>copyright &copy; mega center</b> | Todos os direitos reservados.</span></div>
                    <a href="http://aldaxis.com.br/" title="Aldaxis Novas Ideias" target="_blank" class="aldaxis">desenvolvido por</a>
                </div>
            </div>
        </footer>
    </div>
    <!-- Scripts -->
    {{ HTML::script('assets/js/compiled.js') }}
</body>
</html>