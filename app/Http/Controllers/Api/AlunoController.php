<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
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

    public function store(Request $request){
        $alunoData = $request->all();

        $this->aluno->create($alunoData);
    }

    public function update(Request $request, $id){
        $alunoData = $this->aluno->findOrFail($id);

        $alunoData->nome = $request->nome;
        $alunoData->email = $request->email;
        $alunoData->sexo = $request->sexo;
        $alunoData->data_nascimento = $request->data_nascimento;
        $alunoData->save();
    }

    public function delete(Aluno $id){
        $id->delete();

        return response()->json(['data' => ['msg' => 'Aluno: '. $id->nome. 'removido com sucesso']]);
    }
}
