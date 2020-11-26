<?php

namespace Tests\Unit;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Matricula;
use App\Validator\AlunoValidator;
use App\Validator\CursoValidator;
use App\Validator\ValidationException;
use Database\Factories\MatriculaFactory;
use Tests\TestCase;

class AlunoTest extends TestCase
{

    public function testAlunoSemNome(){
        $this->expectException(ValidationException::class);
        $aluno = Aluno::factory()->make();
        $aluno->nome = '';
        AlunoValidator::validate($aluno->toArray());
    }

    public function testAlunoSemEmail(){
        $this->expectException(ValidationException::class);
        $aluno = Aluno::factory()->make();
        $aluno->email = '';
        AlunoValidator::validate($aluno->toArray());
    }

    public function testAlunoSexoInvalido(){
        $this->expectException(ValidationException::class);
        $aluno = Aluno::factory()->make();
        $aluno->sexo = 'masculino';
        AlunoValidator::validate($aluno->toArray());
    }

    public function testAlunoSemDataNascimento(){
        $this->expectException(ValidationException::class);
        $aluno = Aluno::factory()->make();
        $aluno->data_nascimento = '';
        AlunoValidator::validate($aluno->toArray());
    }
}
