<?php namespace Tests\Repositories;

use App\Models\Disciplina;
use App\Repositories\DisciplinaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class DisciplinaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var DisciplinaRepository
     */
    protected $disciplinaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->disciplinaRepo = \App::make(DisciplinaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_disciplina()
    {
        $disciplina = Disciplina::factory()->make()->toArray();

        $createdDisciplina = $this->disciplinaRepo->create($disciplina);

        $createdDisciplina = $createdDisciplina->toArray();
        $this->assertArrayHasKey('id', $createdDisciplina);
        $this->assertNotNull($createdDisciplina['id'], 'Created Disciplina must have id specified');
        $this->assertNotNull(Disciplina::find($createdDisciplina['id']), 'Disciplina with given id must be in DB');
        $this->assertModelData($disciplina, $createdDisciplina);
    }

    /**
     * @test read
     */
    public function test_read_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $dbDisciplina = $this->disciplinaRepo->find($disciplina->id);

        $dbDisciplina = $dbDisciplina->toArray();
        $this->assertModelData($disciplina->toArray(), $dbDisciplina);
    }

    /**
     * @test update
     */
    public function test_update_disciplina()
    {
        $disciplina = Disciplina::factory()->create();
        $fakeDisciplina = Disciplina::factory()->make()->toArray();

        $updatedDisciplina = $this->disciplinaRepo->update($fakeDisciplina, $disciplina->id);

        $this->assertModelData($fakeDisciplina, $updatedDisciplina->toArray());
        $dbDisciplina = $this->disciplinaRepo->find($disciplina->id);
        $this->assertModelData($fakeDisciplina, $dbDisciplina->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_disciplina()
    {
        $disciplina = Disciplina::factory()->create();

        $resp = $this->disciplinaRepo->delete($disciplina->id);

        $this->assertTrue($resp);
        $this->assertNull(Disciplina::find($disciplina->id), 'Disciplina should not exist in DB');
    }
}
