<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
class LoginController extends Controller
{
    public function index(Request $request){
        $data = array();
        
        if($request->isMethod("POST")){
            $login = $request->input("login");
            $senha = $request->input("senha");
            
           
            $credential =[
              'login' => $login, 'password' => $senha
            ];
            if(Auth::attempt($credential)){
                return redirect()->intended('admin/');
            }else{
                $data["resp"] = "<div class='alert alert-danger'>"
                        . "Usuário inválido</div>";
            }
        }
        return view("login", $data);
    }
    
    public function sair(){
        Auth::logout();
        return redirect()->intended('/');
    }

        public function novo(Request $request){
        $data = array();
        if($request->isMethod("post")){
            $nome = $request->input("nome");
            $senha = $request->input("senha");
            $login = $request->input("login");
            $perfil = $request->input("perfil");
            
            $senha = Hash::make($senha);
            
            
            //1 - Verificar se o login ja existe no sistema
            $user = \App\Usuario::whereLogin($login)->first();
            if($user == null){
                //nao tem ngm com este login -- vamos gravar
                $usuario = new \App\Usuario();
                $usuario->nome = $nome;
                $usuario->password = $senha;
                $usuario->login = $login;
                $usuario->perfil = $perfil;
                
                if($usuario->save()){
                    $data["resp"] = "<div class='alert alert-success'>"
                        . "Usuário cadastrado com sucesso</div>";
                }else{
                    $data["resp"] = "<div class='alert alert-info'>"
                        . "Usuário não cadastrado</div>";
                }
            }else{
                $data["resp"] = "<div class='alert alert-warning'>"
                        . "Login ja existente no sistema</div>";
            }
            
        }
        return view("novo", $data);
    }
    
    public function esqueci(Request $request){
        $data = array();
        if($request->isMethod("POST")){
            $login = $request->input("login");
            $email = $request->input("email");
            
            $usuario = \App\Usuario::whereLogin($login)->first();
            if($usuario == null){
                $data["resp"] = "<div class='alert alert-danger'>"
                        . "Login não encontrado</div>";
            }else{
                $senha = rand(1000, 9999);
                $usuario->password = Hash::make($senha);
                
                if($usuario->save()){
                    \Mail::send('email',
                            array('login'=>$login,'senha'=>$senha),
                            function($message)use($request,$email){
                                  $message->to($email);
                                  $message->from("vandogouveia67@gmail.com");
                                  $message->subject("Recuperação de Senha");
                            });
                    $data["resp"] = "<div class='alert alert-info'>"
                        . "Uma nova senha foi enviada para o email: ".$email."</div>";
                }else{
                    $data["resp"] = "<div class='alert alert-info'>"
                        . "Senha não alterada!</div>";
                }
            }
        }
        return view('esqueci', $data);
    }
}
