<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Tipo;

class TipoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo()
    {
        $tipo = Tipo::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tipos', $tipo
        );

        $this->assertApiResponse($tipo);
    }

    /**
     * @test
     */
    public function test_read_tipo()
    {
        $tipo = Tipo::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/tipos/'.$tipo->id
        );

        $this->assertApiResponse($tipo->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo()
    {
        $tipo = Tipo::factory()->create();
        $editedTipo = Tipo::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tipos/'.$tipo->id,
            $editedTipo
        );

        $this->assertApiResponse($editedTipo);
    }

    /**
     * @test
     */
    public function test_delete_tipo()
    {
        $tipo = Tipo::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tipos/'.$tipo->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tipos/'.$tipo->id
        );

        $this->response->assertStatus(404);
    }
}
