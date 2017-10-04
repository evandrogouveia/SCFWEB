<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function novo(Request $request){
        $data = array();
        if($request->isMethod("POST")){
            $nomecargo = $request->input("nomecargo");
            $cargo = new \App\Cargo();
            
            $cargo->nomecargo = $nomecargo;
            
            if($nomecargo == ""){
                $data["resp"] = "<div class='alert alert-warning'>"
                        . "Digite o nome do cargo</div>";
            }else if($cargo->save()){
                $data["resp"] = "<div class='alert alert-success'>"
                        . "Cargo cadastrado com sucesso</div>";
            }else{
                $data["resp"] = "<div class='alert alert-danger'>"
                        . "Erro ao cadastrar o cargo</div>";
            }
        }
        $lista = \App\Cargo::all();
        $data["lista"] = $lista;
        return view('cargo/novo', $data);
    }
}
