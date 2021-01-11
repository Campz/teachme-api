<?php

namespace App\Repositories;

use App\Models\Disciplina_Leciona;
use App\Repositories\BaseRepository;

/**
 * Class Disciplina_LecionaRepository
 * @package App\Repositories
 * @version January 11, 2021, 4:16 pm UTC
*/

class Disciplina_LecionaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'CdDisciplina',
        'CdUsuario_Professor'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Disciplina_Leciona::class;
    }
}
