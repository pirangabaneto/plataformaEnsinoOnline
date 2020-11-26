<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Matricula;
use App\Validator\MatriculaValidator;
use App\Validator\ValidationException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class MatriculaController extends Controller
{

    /**
     * @var Matricula
     */
    private $matricula;

    public function __construct(Matricula $matricula)
    {
        $this->matricula = $matricula;
    }

    private function todosAlunos(){
        $matriculas = $this->matricula->all();
        $alunos = [];

        //todos alunos matriculados
        foreach ($matriculas as $matricula){
            $aluno = Aluno::find($matricula->aluno_id);

            array_push($alunos, $aluno);
        }
        //valores unicos
        return array_unique($alunos);
    }

    private function todosCursos(){
        $matriculas = $this->matricula->all();
        $cursos = [];

        //todos cursos
        foreach ($matriculas as $matricula){
            $curso = Curso::find($matricula->curso_id);

            array_push($cursos, $curso);
        }
        //valores unicos
        return array_unique($cursos);
    }

    public function index(){
        $data = $this->matricula->all();

        return response()->json($data);
    }

    public function show($id){
        $data = ['data' => $this->matricula->findOrFail($id)];
        return response()->json($data);
    }

    public function store(Request $request){
        try {
            $data = $request->all();
            MatriculaValidator::validate($data);

            Aluno::findOrFail($request->aluno_id);
            Curso::findOrFail($request->curso_id);

            $matriculaData = $request->all();

            $this->matricula->create($matriculaData);
        }catch (ValidationException $exception){
            return response()->json( $exception->getValidator());
        }

    }

    public function update(Request $request, $id){
        $matriculaData = $this->matricula->findOrFail($id);

        $matriculaData->aluno_id = $request->aluno_id;
        $matriculaData->curso_id = $request->curso_id;

        $matriculaData->save();
    }

    public function delete(Matricula $id){
        $id->delete();

        return response()->json(['data' => ['msg' => 'Matricula removida com sucesso']]);
    }

    public function alunosFaixaEtaria(){
        $alunos = $this->todosAlunos();

        //separando os alunos por faixa etaria
        $alunosQuinze = [];
        $alunosDezenove = [];
        $alunosVinteCinco = [];
        $alunosTrintaUm = [];
        $alunosMaiorTrinta = [];

        foreach ($alunos as $aluno){
            $idade = Carbon::parse($aluno->data_nascimento)->age;
            if( $idade < 15){
                array_push($alunosQuinze, $aluno);
            }else if($idade >= 15 && $idade < 19){
                array_push($alunosDezenove, $aluno);
            }else if($idade >=19 && $idade < 25){
                array_push($alunosVinteCinco, $aluno);
            }else if($idade >=25 && $idade < 31){
                array_push($alunosTrintaUm, $aluno);
            }else{
                array_push($alunosMaiorTrinta, $aluno);
            }

        }

        $data = ['Total de alunos' => count($alunos), //todos os alunos matriculados
            'ateQuatorze' => count($alunosQuinze), //todos alunos com ate 14 anos
            'ateDezoito' => count($alunosDezenove), //todos alunosEntre 15 e 18 anos anos,
            'ateVinteQuatro' => count($alunosVinteCinco), //todos alunos Entre 19 e 24 anos
            'ateTrinta' => count($alunosTrintaUm), //todos alunos Entre 25 e 30 anos
            'maiorTrinta' => count($alunosMaiorTrinta), //todos alunos Maiores que 30 anos

        ];

        return response()->json($data);
    }

    public function alunosPorCurso(){
        //total de aluno por curso
        $matriculas = $this->matricula->all();
        $cursos = $this->todosCursos();
        $data = [];
        foreach ($cursos as $curso) {
            $total = 0;

            foreach ($matriculas as $matricula){
                $res = [];
                if($curso->id == $matricula->curso_id){
                    $total += 1;
                }
            }
            array_push($data, [$curso->id => $total]);
        }
        return response()->json($data);
    }

    public function alunosPorSexo(){
        //total de alunos por sexo
        $alunos = $this->todosAlunos();
        $data = [];
        $masculino = 0;
        $feminino = 0;
        foreach ($alunos as $aluno) {

            if($aluno->sexo == 0)
                $masculino += 1;
            else
                $feminino += 1;
        }
        array_push($data, [`masculino` => $masculino]);
        array_push($data, [`feminino` => $feminino]);

        return response()->json($data);
    }
}
