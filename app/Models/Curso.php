<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao'];

    public function matricula(){
        $this->hasMany('app\Models\Matricula');
    }
}
