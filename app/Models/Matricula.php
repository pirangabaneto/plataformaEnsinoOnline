<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = ['aluno_id', 'curso_id'];

    public function aluno(){
        return $this->belongsTo('app\Models\Aluno');
    }

    public function curso(){
        return $this->belongsTo('app\Models\Curso');
    }
}
