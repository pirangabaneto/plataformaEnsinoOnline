<?php

use App\Http\Controllers\Api\AlunoController;
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
        Route::post('/', [AlunoController::class, 'store'])->name('store_aluno');
        Route::put('/{id}', [AlunoController::class, 'update'])->name('update_aluno');
        Route::delete('/{id}', [AlunoController::class, 'delete'])->name('delete_aluno');
    });

});
