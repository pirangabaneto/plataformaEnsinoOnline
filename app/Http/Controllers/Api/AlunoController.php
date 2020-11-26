<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Validator\AlunoValidator;
use App\Validator\ValidationException;
use Illuminate\Http\Request;

class AlunoController extends Controller
{

    /**
     * @var Aluno
     */
    private $aluno;

    public function __construct(Aluno $aluno)
    {

        $this->aluno = $aluno;
    }

    public function index(){
        $data = ['data' => $this->aluno->all()];

        return response()->json($data);
    }

    public function show($id){
        $data = ['data' => $this->aluno->findOrFail($id)];
        return response()->json($data);
    }

    public function busca_nome($nome){
        $data = ['data' => $this->aluno::where('nome', $nome)->first()];
        return response()->json($data);
    }

    public function busca_email($email){
        $data = ['data' => $this->aluno::where('email', $email)->first()];
        return response()->json($data);
    }


    public function store(Request $request){
         try {
            $alunoData = $request->all();
            AlunoValidator::validate($alunoData);
            $this->aluno->create($alunoData);
        }catch (ValidationException $exception){
            return response()->json( $exception->getValidator());
        }

    }

    public function update(Request $request, $id){
        try {
            $alunoData = $request->all();
            AlunoValidator::validate($alunoData);

            $alunoData = $this->aluno->findOrFail($id);

            $alunoData->nome = $request->nome;
            $alunoData->email = $request->email;
            $alunoData->sexo = $request->sexo;
            $alunoData->data_nascimento = $request->data_nascimento;
            $alunoData->save();
        }catch (ValidationException $exception){
            return response()->json( $exception->getValidator());
        }

    }

    public function delete(Aluno $id){
        $id->delete();

        return response()->json(['data' => ['msg' => 'Aluno: '. $id->nome. 'removido com sucesso']]);
    }
}
