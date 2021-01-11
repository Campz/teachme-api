<?php namespace Tests\Repositories;

use App\Models\Anuncio;
use App\Repositories\AnuncioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AnuncioRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AnuncioRepository
     */
    protected $anuncioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->anuncioRepo = \App::make(AnuncioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_anuncio()
    {
        $anuncio = Anuncio::factory()->make()->toArray();

        $createdAnuncio = $this->anuncioRepo->create($anuncio);

        $createdAnuncio = $createdAnuncio->toArray();
        $this->assertArrayHasKey('id', $createdAnuncio);
        $this->assertNotNull($createdAnuncio['id'], 'Created Anuncio must have id specified');
        $this->assertNotNull(Anuncio::find($createdAnuncio['id']), 'Anuncio with given id must be in DB');
        $this->assertModelData($anuncio, $createdAnuncio);
    }

    /**
     * @test read
     */
    public function test_read_anuncio()
    {
        $anuncio = Anuncio::factory()->create();

        $dbAnuncio = $this->anuncioRepo->find($anuncio->id);

        $dbAnuncio = $dbAnuncio->toArray();
        $this->assertModelData($anuncio->toArray(), $dbAnuncio);
    }

    /**
     * @test update
     */
    public function test_update_anuncio()
    {
        $anuncio = Anuncio::factory()->create();
        $fakeAnuncio = Anuncio::factory()->make()->toArray();

        $updatedAnuncio = $this->anuncioRepo->update($fakeAnuncio, $anuncio->id);

        $this->assertModelData($fakeAnuncio, $updatedAnuncio->toArray());
        $dbAnuncio = $this->anuncioRepo->find($anuncio->id);
        $this->assertModelData($fakeAnuncio, $dbAnuncio->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_anuncio()
    {
        $anuncio = Anuncio::factory()->create();

        $resp = $this->anuncioRepo->delete($anuncio->id);

        $this->assertTrue($resp);
        $this->assertNull(Anuncio::find($anuncio->id), 'Anuncio should not exist in DB');
    }
}
