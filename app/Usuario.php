<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
class Usuario extends Model implements Authenticatable
{
    protected $table = "usuario";
    protected $primaryKey = "idusuario";
    public $timestamps = false;
    protected $fillable = [
        'idusuario','nome', 'login','password'
    ];
    
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function getAuthIdentifierName() {
        return $this->login;
    }

    public function getAuthPassword() {
        return $this->password;
    }

    public function getRememberToken() {
        
    }

    public function getRememberTokenName() {
        
    }

    public function setRememberToken($value) {
        
    }

}
