<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('bootstrap/css/style.css')}}"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" 
              rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" 
              crossorigin="anonymous"/>
    </head>
    <body>
        <div class="container">
             <div class="panel-title text-center">
                <img src="{{ asset('img/logo.png') }}" /> 
             </div> 
             <div class="card card-container">
                 <p id="profile-name" class="profile-name-card"></p>
                 <form method="post"class="form-signin">
                     <div class="input-group">
                         <div class="input-group-addon" ><i class="fa fa-user fa-lg"></i></div>
                         <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Usuário" required autofocus>
                     </div><br>
                     <div class="input-group">
                         <div class="input-group-addon" ><i class="fa fa-lock fa-lg"></i></div>
                         <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
                     </div>
                     <div id="remember" class="checkbox">
                         <label>
                             <input type="checkbox" name="remember_token" value="remember_me" > Lembrar-me
                         </label>
                     </div>
                      
                     <input type="submit" value="LOGIN" class="btn btn-lg btn-primary btn-block btn-signin">
                      <a href='{{ route('esqueci') }}' class="forgot-password">
                         Esqueci a senha
                      </a>
                      <a href='{{ route('novo') }}' class="forgot-password pull-right">
                         Novo usuário
                      </a>
                     {{ csrf_field() }}
                 </form><!-- /form -->
                 {!! $resp or '' !!}
             </div><!-- /card-container --> 
         </div><!-- /container -->
        
    </body>
</html>
