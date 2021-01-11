<?php

namespace App\Repositories;

use App\Models\Disciplina;
use App\Repositories\BaseRepository;

/**
 * Class DisciplinaRepository
 * @package App\Repositories
 * @version January 11, 2021, 4:15 pm UTC
*/

class DisciplinaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'NmDisciplina',
        'CdTipo'
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
        return Disciplina::class;
    }
}
