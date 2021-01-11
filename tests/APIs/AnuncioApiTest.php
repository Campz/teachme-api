<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Anuncio;

class AnuncioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_anuncio()
    {
        $anuncio = Anuncio::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/anuncios', $anuncio
        );

        $this->assertApiResponse($anuncio);
    }

    /**
     * @test
     */
    public function test_read_anuncio()
    {
        $anuncio = Anuncio::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/anuncios/'.$anuncio->id
        );

        $this->assertApiResponse($anuncio->toArray());
    }

    /**
     * @test
     */
    public function test_update_anuncio()
    {
        $anuncio = Anuncio::factory()->create();
        $editedAnuncio = Anuncio::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/anuncios/'.$anuncio->id,
            $editedAnuncio
        );

        $this->assertApiResponse($editedAnuncio);
    }

    /**
     * @test
     */
    public function test_delete_anuncio()
    {
        $anuncio = Anuncio::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/anuncios/'.$anuncio->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/anuncios/'.$anuncio->id
        );

        $this->response->assertStatus(404);
    }
}
