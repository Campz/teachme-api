<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Disciplina_Leciona;

class Disciplina_LecionaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_disciplina__leciona()
    {
        $disciplinaLeciona = Disciplina_Leciona::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/disciplina__lecionas', $disciplinaLeciona
        );

        $this->assertApiResponse($disciplinaLeciona);
    }

    /**
     * @test
     */
    public function test_read_disciplina__leciona()
    {
        $disciplinaLeciona = Disciplina_Leciona::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/disciplina__lecionas/'.$disciplinaLeciona->id
        );

        $this->assertApiResponse($disciplinaLeciona->toArray());
    }

    /**
     * @test
     */
    public function test_update_disciplina__leciona()
    {
        $disciplinaLeciona = Disciplina_Leciona::factory()->create();
        $editedDisciplina_Leciona = Disciplina_Leciona::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/disciplina__lecionas/'.$disciplinaLeciona->id,
            $editedDisciplina_Leciona
        );

        $this->assertApiResponse($editedDisciplina_Leciona);
    }

    /**
     * @test
     */
    public function test_delete_disciplina__leciona()
    {
        $disciplinaLeciona = Disciplina_Leciona::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/disciplina__lecionas/'.$disciplinaLeciona->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/disciplina__lecionas/'.$disciplinaLeciona->id
        );

        $this->response->assertStatus(404);
    }
}
