<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Felipe R. Alcântara">
    <link rel="icon" href="images/favicon.ico">

    <title>Painel Administrativo</title>
    
    <!-- Styles -->
    {{ HTML::style('assets/admin/css/layout.min.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body role="document">
    
    <div class="wrapper">
        
        @yield('main')
         
    </div>
        
    <!-- Scripts -->
    {{ HTML::script('assets/admin/js/compiled.js') }}
</body>
</html>