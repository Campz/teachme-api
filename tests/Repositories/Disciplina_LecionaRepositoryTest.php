<?php namespace Tests\Repositories;

use App\Models\Disciplina_Leciona;
use App\Repositories\Disciplina_LecionaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Disciplina_LecionaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Disciplina_LecionaRepository
     */
    protected $disciplinaLecionaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->disciplinaLecionaRepo = \App::make(Disciplina_LecionaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_disciplina__leciona()
    {
        $disciplinaLeciona = Disciplina_Leciona::factory()->make()->toArray();

        $createdDisciplina_Leciona = $this->disciplinaLecionaRepo->create($disciplinaLeciona);

        $createdDisciplina_Leciona = $createdDisciplina_Leciona->toArray();
        $this->assertArrayHasKey('id', $createdDisciplina_Leciona);
        $this->assertNotNull($createdDisciplina_Leciona['id'], 'Created Disciplina_Leciona must have id specified');
        $this->assertNotNull(Disciplina_Leciona::find($createdDisciplina_Leciona['id']), 'Disciplina_Leciona with given id must be in DB');
        $this->assertModelData($disciplinaLeciona, $createdDisciplina_Leciona);
    }

    /**
     * @test read
     */
    public function test_read_disciplina__leciona()
    {
        $disciplinaLeciona = Disciplina_Leciona::factory()->create();

        $dbDisciplina_Leciona = $this->disciplinaLecionaRepo->find($disciplinaLeciona->id);

        $dbDisciplina_Leciona = $dbDisciplina_Leciona->toArray();
        $this->assertModelData($disciplinaLeciona->toArray(), $dbDisciplina_Leciona);
    }

    /**
     * @test update
     */
    public function test_update_disciplina__leciona()
    {
        $disciplinaLeciona = Disciplina_Leciona::factory()->create();
        $fakeDisciplina_Leciona = Disciplina_Leciona::factory()->make()->toArray();

        $updatedDisciplina_Leciona = $this->disciplinaLecionaRepo->update($fakeDisciplina_Leciona, $disciplinaLeciona->id);

        $this->assertModelData($fakeDisciplina_Leciona, $updatedDisciplina_Leciona->toArray());
        $dbDisciplina_Leciona = $this->disciplinaLecionaRepo->find($disciplinaLeciona->id);
        $this->assertModelData($fakeDisciplina_Leciona, $dbDisciplina_Leciona->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_disciplina__leciona()
    {
        $disciplinaLeciona = Disciplina_Leciona::factory()->create();

        $resp = $this->disciplinaLecionaRepo->delete($disciplinaLeciona->id);

        $this->assertTrue($resp);
        $this->assertNull(Disciplina_Leciona::find($disciplinaLeciona->id), 'Disciplina_Leciona should not exist in DB');
    }
}
