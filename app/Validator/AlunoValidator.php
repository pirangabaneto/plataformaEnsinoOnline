<?php

namespace App\Validator;
use App\Models\Aluno;
use Illuminate\Support\Facades\Validator;

class AlunoValidator
{
    public static function validate($data){
        $validator = Validator::make($data, Aluno::$rules, Aluno::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, "Erro na validação do Aluno");
        }else{
            return $validator;
        }
    }
}
