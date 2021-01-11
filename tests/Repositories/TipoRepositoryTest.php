<?php namespace Tests\Repositories;

use App\Models\Tipo;
use App\Repositories\TipoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TipoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoRepository
     */
    protected $tipoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipoRepo = \App::make(TipoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipo()
    {
        $tipo = Tipo::factory()->make()->toArray();

        $createdTipo = $this->tipoRepo->create($tipo);

        $createdTipo = $createdTipo->toArray();
        $this->assertArrayHasKey('id', $createdTipo);
        $this->assertNotNull($createdTipo['id'], 'Created Tipo must have id specified');
        $this->assertNotNull(Tipo::find($createdTipo['id']), 'Tipo with given id must be in DB');
        $this->assertModelData($tipo, $createdTipo);
    }

    /**
     * @test read
     */
    public function test_read_tipo()
    {
        $tipo = Tipo::factory()->create();

        $dbTipo = $this->tipoRepo->find($tipo->id);

        $dbTipo = $dbTipo->toArray();
        $this->assertModelData($tipo->toArray(), $dbTipo);
    }

    /**
     * @test update
     */
    public function test_update_tipo()
    {
        $tipo = Tipo::factory()->create();
        $fakeTipo = Tipo::factory()->make()->toArray();

        $updatedTipo = $this->tipoRepo->update($fakeTipo, $tipo->id);

        $this->assertModelData($fakeTipo, $updatedTipo->toArray());
        $dbTipo = $this->tipoRepo->find($tipo->id);
        $this->assertModelData($fakeTipo, $dbTipo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipo()
    {
        $tipo = Tipo::factory()->create();

        $resp = $this->tipoRepo->delete($tipo->id);

        $this->assertTrue($resp);
        $this->assertNull(Tipo::find($tipo->id), 'Tipo should not exist in DB');
    }
}
