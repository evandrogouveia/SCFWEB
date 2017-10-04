<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = "endereco";
    protected $primaryKey = "idendereco";
    public $timestamps = false;
    protected $fillable = [
        'idendereco', 'endereco','bairro','cidade', 'cep', 'estado', 'idfuncionario'
    ];
    
    //Mapear o relacionar -- a chave
    public function funcionario(){
        return $this->belongsTo("App\Funcionario", "idfuncionario");
    }
}