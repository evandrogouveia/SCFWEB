<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bem Vindo</title>
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('bootstrap/css/style.css')}}"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" 
              rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" 
              crossorigin="anonymous"/>
    </head>
    <body class="home">
        <div class="container-fluid">
            <div class="col-md-2 hidden-xs" id="navigation">
                <div class="logo">
                    <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-responsive">
                </div>
                <div class="navi">
                    <ul>
                        @can('publica',Auth::user())
                           <li class="active"><a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i>HOME</a></li>
                        @endcan
                        @can('adm',Auth::user())
                           <li><a href="{{route('cargo_novo')}}"><i class="fa fa-briefcase" aria-hidden="true"></i>NOVO CARGO</a></li>
                        @endcan
                        @can('adm',Auth::user())
                           <li><a href="{{route('funcionario_cadastrar')}}"><i class="fa fa-file-text" aria-hidden="true"></i>NOVO FUNCIONÁRIO</a></li>
                        @endcan
                        @can('publica',Auth::user())
                           <li><a href="{{route('funcionario_buscar')}}"><i class="fa fa-search-minus" aria-hidden="true"></i>BUSCAR FUNCIONÁRIO</a></li>
                        @endcan
                           <li><a href="{{route('sair')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>SAIR</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-10">
                <p class="text-right">
                   Bem vindo ao sistema, {{Auth::user()->nome}}
                   <br>
                   Perfil: {{Auth::user()->perfil}}
                </p>
                @yield("conteudo")
                {!! $resp or '' !!}
            </div>
        </div>
    </body>
</html>
