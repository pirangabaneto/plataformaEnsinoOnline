<?php


namespace App\Validator;


use App\Models\Matricula;
use Illuminate\Support\Facades\Validator;

class MatriculaValidator
{
    public static function validate($data){
        $validator = Validator::make($data, Matricula::$rules, Matricula::$messages);

        if(!$validator->errors()->isEmpty()){
            throw new ValidationException($validator, "Erro na validação da Matricula");
        }else{
            return $validator;
        }
    }
}
