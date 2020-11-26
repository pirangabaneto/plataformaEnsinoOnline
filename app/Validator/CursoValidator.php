<?php


namespace App\Validator;


use App\Models\Curso;
use Illuminate\Support\Facades\Validator;

class CursoValidator
{
    public static function validate($data){
        $validator = Validator::make($data, Curso::$rules, Curso::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, "Erro na validação do Curso");
        }else{
            return $validator;
        }
    }
}
