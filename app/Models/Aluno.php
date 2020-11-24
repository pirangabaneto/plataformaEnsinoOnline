<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'sexo', 'data_nascimento'];

    public function matricula(){
        $this->hasMany('app\Models\Matricula');
    }
}
