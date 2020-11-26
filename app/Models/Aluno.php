<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'sexo', 'data_nascimento'];

    public static $rules =[
        'nome' => ['required', 'string', 'max:255'],
        'email' => ['required', 'unique:alunos', 'string', 'email', 'max:255',],
        'sexo' => ['integer'],
        'data_nascimento' => ['required'],
    ];

    public static $messages = [
        'nome.*' => "Nome é obrigatório e deve ter até 255 caracteres.",
        'email.*' => "Email é obrigatorio e único.",
        'sexo.*' => "Sexo deve ser um valor inteiro",
        'data_nascimento' => "Data de Nascimento é obrigatório",
    ];

    public function matricula(){
        $this->hasMany('app\Models\Matricula');
    }
}
