<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = ['aluno_id', 'curso_id'];

    public static $rules =[
        'aluno_id' => ['required',],
        'curso_id' => ['required',],
    ];

    public static $messages = [
        'aluno_id.*' => "Aluno é obrigatório",
        'curso_id.*' => "Curso é obrigatorio.",
    ];

    public function aluno(){
        return $this->belongsTo('app\Models\Aluno');
    }

    public function curso(){
        return $this->belongsTo('app\Models\Curso');
    }
}
