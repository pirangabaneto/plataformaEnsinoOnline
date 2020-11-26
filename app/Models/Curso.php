<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descricao'];

    public static $rules =[
        'titulo' => ['required', 'string', 'max:255'],
        'descricao' => ['string'],
    ];

    public static $messages = [
        'titulo.*' => "Título é obrigatório e deve ter até 255 caracteres.",
        'descricao.*' => "Descrição deve ser texto",
    ];

    public function matricula(){
        $this->hasMany('app\Models\Matricula');
    }
}
