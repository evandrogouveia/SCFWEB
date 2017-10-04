<?php
namespace App\Repository;
use App\Funcionario;

class FuncionarioDao {
    /**
     * @var Funcionario
     */
    private $model;
    
    public function __construct(Funcionario $f) {
        $this->model = $f;
    }
    
    public function buscar($nome = ""){
        $select = $this->model
                ->join("endereco as e", "e.idfuncionario", "=",
                        "funcionario.idfuncionario")
                ->leftJoin("cargos as c", "c.id","=",
                        "funcionario.idcargo")
                ->where("nome", "like", $nome . "%")
                ->orderBy("nome");
        return $select->get();
    }
    
    public function listar(){
        $select = $this->model
                ->join("endereco as e", "e.idfuncionario", "=",
                        "funcionario.idfuncionario")
                ->leftJoin("cargos as c", "c.id","=",
                        "funcionario.idcargo")
                ->orderBy("funcionario.idfuncionario", "desc")
                ->limit(10);
        return $select->get();
    }
}
