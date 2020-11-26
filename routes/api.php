<?php

use App\Http\Controllers\Api\AlunoController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\Api\MatriculaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->name('api.')->group(function(){
    Route::prefix('/alunos')->group(function (){
        Route::get('/', [AlunoController::class, 'index'])->name('alunos');
        Route::get('/{id}', [AlunoController::class, 'show'])->name('mostrar_aluno');
        Route::get('/buscaNome/{nome}', [AlunoController::class, 'busca_nome'])->name('busca_nome_aluno');
        Route::get('/buscaEmail/{email}', [AlunoController::class, 'busca_email'])->name('busca_email_aluno');
        Route::post('/', [AlunoController::class, 'store'])->name('store_aluno');
        Route::put('/{id}', [AlunoController::class, 'update'])->name('update_aluno');
        Route::delete('/{id}', [AlunoController::class, 'delete'])->name('delete_aluno');
    });

    Route::prefix('/cursos')->group(function (){
        Route::get('/', [CursoController::class, 'index'])->name('cursos');
        Route::get('/{id}', [CursoController::class, 'show'])->name('mostrar_curso');
        Route::post('/', [CursoController::class, 'store'])->name('store_curso');
        Route::put('/{id}', [CursoController::class, 'update'])->name('update_curso');
        Route::delete('/{id}', [CursoController::class, 'delete'])->name('delete_curso');
    });

    Route::prefix('/matriculas')->group(function (){
        Route::get('/', [MatriculaController::class, 'index'])->name('matriculas');
        Route::post('/', [MatriculaController::class, 'store'])->name('store_matricula');
        Route::get('/alunosPorSexo', [MatriculaController::class, 'alunosPorSexo'])->name('sexo_matriculas');
        Route::get('/alunosFaixaEtaria', [MatriculaController::class, 'alunosFaixaEtaria'])->name('faixa_etaria_matriculas');
        Route::get('/alunosPorCurso', [MatriculaController::class, 'alunosPorCurso'])->name('alunos_curso_matriculas');
    });

});
