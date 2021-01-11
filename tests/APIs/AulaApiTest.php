<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Aula;

class AulaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_aula()
    {
        $aula = Aula::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/aulas', $aula
        );

        $this->assertApiResponse($aula);
    }

    /**
     * @test
     */
    public function test_read_aula()
    {
        $aula = Aula::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/aulas/'.$aula->id
        );

        $this->assertApiResponse($aula->toArray());
    }

    /**
     * @test
     */
    public function test_update_aula()
    {
        $aula = Aula::factory()->create();
        $editedAula = Aula::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/aulas/'.$aula->id,
            $editedAula
        );

        $this->assertApiResponse($editedAula);
    }

    /**
     * @test
     */
    public function test_delete_aula()
    {
        $aula = Aula::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/aulas/'.$aula->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/aulas/'.$aula->id
        );

        $this->response->assertStatus(404);
    }
}
