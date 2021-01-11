<?php namespace Tests\Repositories;

use App\Models\Aula;
use App\Repositories\AulaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AulaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AulaRepository
     */
    protected $aulaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->aulaRepo = \App::make(AulaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_aula()
    {
        $aula = Aula::factory()->make()->toArray();

        $createdAula = $this->aulaRepo->create($aula);

        $createdAula = $createdAula->toArray();
        $this->assertArrayHasKey('id', $createdAula);
        $this->assertNotNull($createdAula['id'], 'Created Aula must have id specified');
        $this->assertNotNull(Aula::find($createdAula['id']), 'Aula with given id must be in DB');
        $this->assertModelData($aula, $createdAula);
    }

    /**
     * @test read
     */
    public function test_read_aula()
    {
        $aula = Aula::factory()->create();

        $dbAula = $this->aulaRepo->find($aula->id);

        $dbAula = $dbAula->toArray();
        $this->assertModelData($aula->toArray(), $dbAula);
    }

    /**
     * @test update
     */
    public function test_update_aula()
    {
        $aula = Aula::factory()->create();
        $fakeAula = Aula::factory()->make()->toArray();

        $updatedAula = $this->aulaRepo->update($fakeAula, $aula->id);

        $this->assertModelData($fakeAula, $updatedAula->toArray());
        $dbAula = $this->aulaRepo->find($aula->id);
        $this->assertModelData($fakeAula, $dbAula->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_aula()
    {
        $aula = Aula::factory()->create();

        $resp = $this->aulaRepo->delete($aula->id);

        $this->assertTrue($resp);
        $this->assertNull(Aula::find($aula->id), 'Aula should not exist in DB');
    }
}
