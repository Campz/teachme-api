<?php namespace Tests\Repositories;

use App\Models\Instituicao;
use App\Repositories\InstituicaoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class InstituicaoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var InstituicaoRepository
     */
    protected $instituicaoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->instituicaoRepo = \App::make(InstituicaoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_instituicao()
    {
        $instituicao = Instituicao::factory()->make()->toArray();

        $createdInstituicao = $this->instituicaoRepo->create($instituicao);

        $createdInstituicao = $createdInstituicao->toArray();
        $this->assertArrayHasKey('id', $createdInstituicao);
        $this->assertNotNull($createdInstituicao['id'], 'Created Instituicao must have id specified');
        $this->assertNotNull(Instituicao::find($createdInstituicao['id']), 'Instituicao with given id must be in DB');
        $this->assertModelData($instituicao, $createdInstituicao);
    }

    /**
     * @test read
     */
    public function test_read_instituicao()
    {
        $instituicao = Instituicao::factory()->create();

        $dbInstituicao = $this->instituicaoRepo->find($instituicao->id);

        $dbInstituicao = $dbInstituicao->toArray();
        $this->assertModelData($instituicao->toArray(), $dbInstituicao);
    }

    /**
     * @test update
     */
    public function test_update_instituicao()
    {
        $instituicao = Instituicao::factory()->create();
        $fakeInstituicao = Instituicao::factory()->make()->toArray();

        $updatedInstituicao = $this->instituicaoRepo->update($fakeInstituicao, $instituicao->id);

        $this->assertModelData($fakeInstituicao, $updatedInstituicao->toArray());
        $dbInstituicao = $this->instituicaoRepo->find($instituicao->id);
        $this->assertModelData($fakeInstituicao, $dbInstituicao->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_instituicao()
    {
        $instituicao = Instituicao::factory()->create();

        $resp = $this->instituicaoRepo->delete($instituicao->id);

        $this->assertTrue($resp);
        $this->assertNull(Instituicao::find($instituicao->id), 'Instituicao should not exist in DB');
    }
}
