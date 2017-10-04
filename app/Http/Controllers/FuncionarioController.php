<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function index(){
        $data = array();
       
        return view('funcionario/index', $data);
    }
    
    public function cadastrar(Request $request){
        $data = array();
        $data["lista"] = \App\Cargo::all();
        if($request->isMethod("POST")){
            try{
                //pegar os dados do formulario
                $matricula = $request->input("matricula", "");
                $nome = $request->input("nome", "");
                $telefone = $request->input("telefone", "");
                $sexo = $request->input("sexo", "");
                $email = $request->input("email", "");
                $salario = $request->input("salario", "");
                $endereco = $request->input("endereco", "");
                $bairro = $request->input("bairro", "");
                $cep = $request->input("cep", "");
                $cidade = $request->input("cidade", "");
                $estado = $request->input("estado", "");
                $idcargo = $request->input("idcargo", "");
                
                $file = $request->file("foto");
                $ext = $file->getClientOriginalExtension();
                $size = $file->getSize();
                
                if($ext != "jpg" && $ext != "png" && $ext != "jpeg"){
                    $data["resp"] = "<div class='alert alert-info'>"
                            . "Escolha uma IMAGEM valida</div>";
                    //2MB
                }else if($size > (1024 * 1024 * 2)){
                    $data["resp"] = "<div class='alert alert-info'>"
                            . "Tamanho da imagem invalido</div>";
                }else{
                
                    //ft_20170831121840.jpg
                    $fileName = "ft_" .date('YmdHis').".".$ext;
                    
                    //pegar o cargo
                    $cargo = \App\Cargo::find($idcargo);

                    $f = new \App\Funcionario();
                    $e = new \App\Endereco();
                    
                    $f->matricula = $matricula;
                    $f->nome = $nome;
                    $f->telefone = $telefone;
                    $f->sexo = $sexo;
                    $f->salario = $salario;
                    $f->email = $email;
                    $f->foto = $fileName;

                    //Relacionar o funcionario com o Cargo
                    $f->cargo()->associate($cargo);

                    $e->endereco = $endereco;
                    $e->bairro = $bairro;
                    $e->cidade = $cidade;
                    $e->cep = $cep;
                    $e->estado = $estado;

                    //gravar o funcionario
                    $f->save();
                    //Relacionar os objetos
                    $e->funcionario()->associate($f);
                    //gravar o endereco
                    $e->save();
                    //chmod 777 fotos
                    //upload
                    $file->move("fotos", $fileName);
                    
                    $data["resp"] = "<div class='alert alert-success'>"
                            . $nome . ", enviado com sucesso!</div>";
                }
            } catch (Exception $ex) {
                $data["resp"] = "<div class='alert alert-danger'>"
                        . "Dados não enviados!</div>";
            }
        }
        return view('funcionario/cadastrar', $data);
    }
    
    public function buscar(Request $request){
        $data = array();
        $fDao = new \App\Repository\FuncionarioDao(new \App\Funcionario);
        if($request->isMethod("POST")){
            $nome = $request->input("nome");
            $data["lista"] = $fDao->buscar($nome);
        }else{
            $data["lista"] = $fDao->listar();
        }
        return view('funcionario/buscar', $data);
    }
    
    public function  detalhes($id, Request $request){
        $data = array();
        $data["lista"] = \App\Cargo::all();
        try{
            //buscar os dados do funcionario pelo id
            $func = \App\Funcionario::find($id);
            if($request->isMethod("POST")){
                //Vamos editar o funcionario
                
                //pegar os dados do formulario
                $matricula = $request->input("matricula", "");
                $nome = $request->input("nome", "");
                $telefone = $request->input("telefone", "");
                $sexo = $request->input("sexo", "");
                $email = $request->input("email", "");
                $salario = $request->input("salario", "");
                $endereco = $request->input("endereco", "");
                $bairro = $request->input("bairro", "");
                $cep = $request->input("cep", "");
                $cidade = $request->input("cidade", "");
                $estado = $request->input("estado", "");
                $idcargo = $request->input("idcargo", "");
                
                $func->matricula = $matricula;
                $func->nome = $nome;
                $func->telefone = $telefone;
                $func->sexo = $sexo;
                $func->salario = $salario;
                $func->email = $email;
                $func->idcargo = $idcargo;
                
                //editar o funcionario
                $func->save();
                
                $idend = $func->endereco->idendereco;
                //Pegar a referencia (os dados) do endereco
                $e = \App\Endereco::find($idend);
                
                $e->endereco = $endereco;
                $e->bairro = $bairro;
                $e->cidade = $cidade;
                $e->cep = $cep;
                $e->estado = $estado;
                
                $e->funcionario()->associate($func);
                //atualizar o endereco
                $e->save();
               
                
                $data["resp"] = "<div class='alert alert-success'>"
                        . "Funcionario editado com sucesso!</div>";
                
                //Buscar os dados de funcionario novamente
                $func = \App\Funcionario::find($id);
               
                return redirect('admin/buscar.html');
            }
            $data["f"] = $func;
        } catch (Exception $ex) {
            $data["resp"] = "<div class='alert alert-danger'>"
                    . "Operação não realizada</div>";
        }
        return view('funcionario/detalhes', $data);
    }
    
    public function excluir($id){
        $data = array();
        
        $func = \App\Funcionario::find($id);
        if($func == null){
            $data["resp"] = "<div class='alert alert-danger'>"
                    . "Funcionário não encontrado</div>";
        }else{
            //excluir o endereco
            $func->endereco()->delete();
            $func->delete();
            
            $data["resp"] = "<div class='alert alert-success'>"
                    . "Funcionario excluído com sucesso</div>";
        }
        
        return view("funcionario/buscar", $data);
    }
}
