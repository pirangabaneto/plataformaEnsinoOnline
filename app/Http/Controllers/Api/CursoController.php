<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * @var Curso
     */
    private $curso;

    public function __construct(Curso $curso)
    {

        $this->curso = $curso;
    }

    public function index(){
        $data = ['data' => $this->curso->all()];

        return response()->json($data);
    }

    public function show($id){
        $data = ['data' => $this->curso->findOrFail($id)];

        return response()->json($data);
    }

    public function store(Request $request){
        $cursoData = $request->all();

        $this->curso->create($cursoData);
    }

    public function update(Request $request, $id){
        $cursoData = $this->curso->findOrFail($id);

        $cursoData->titulo = $request->titulo;
        $cursoData->descricao = $request->descricao;

        $cursoData->save();
    }

    public function delete(Curso $id){
        $id->delete();

        return response()->json(['data' => ['msg' => 'Curso: '. $id->titulo. 'removido com sucesso']]);
    }
}
