<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Disciplina;

class DisciplinaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_disciplina()
    {
        $disciplina = Disciplina::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/disciplinas', $disciplina
        );

        $this->assertApiResponse($disciplina);
    }

    /**
     * @test
     */
    public function test_read_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/disciplinas/'.$disciplina->id
        );

        $this->assertApiResponse($disciplina->toArray());
    }

    /**
     * @test
     */
    public function test_update_disciplina()
    {
        $disciplina = Disciplina::factory()->create();
        $editedDisciplina = Disciplina::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/disciplinas/'.$disciplina->id,
            $editedDisciplina
        );

        $this->assertApiResponse($editedDisciplina);
    }

    /**
     * @test
     */
    public function test_delete_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/disciplinas/'.$disciplina->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/disciplinas/'.$disciplina->id
        );

        $this->response->assertStatus(404);
    }
}
