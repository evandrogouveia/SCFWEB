<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = "funcionario";
    protected $primaryKey = "idfuncionario";
    public $timestamps = false;
    protected $fillable = [
        'idfuncionario','matricula','nome','telefone','sexo', 'salario','email','idcargo'
    ];
    
    public function __construct($db = "mysql") {
        $this->connection = $db;
    }
    
    //Relacionar o Funcionario Ao Endereco
    public function endereco(){
        return $this->hasOne("App\Endereco", "idfuncionario");
    }
    
    public function cargo(){
        return $this->belongsTo("App\Cargo", "idcargo");
    }
}
