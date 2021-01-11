<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Instituicao;

class InstituicaoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_instituicao()
    {
        $instituicao = Instituicao::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/instituicaos', $instituicao
        );

        $this->assertApiResponse($instituicao);
    }

    /**
     * @test
     */
    public function test_read_instituicao()
    {
        $instituicao = Instituicao::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/instituicaos/'.$instituicao->id
        );

        $this->assertApiResponse($instituicao->toArray());
    }

    /**
     * @test
     */
    public function test_update_instituicao()
    {
        $instituicao = Instituicao::factory()->create();
        $editedInstituicao = Instituicao::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/instituicaos/'.$instituicao->id,
            $editedInstituicao
        );

        $this->assertApiResponse($editedInstituicao);
    }

    /**
     * @test
     */
    public function test_delete_instituicao()
    {
        $instituicao = Instituicao::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/instituicaos/'.$instituicao->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/instituicaos/'.$instituicao->id
        );

        $this->response->assertStatus(404);
    }
}
