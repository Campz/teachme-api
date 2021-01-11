<?php

namespace App\Repositories;

use App\Models\Aula;
use App\Repositories\BaseRepository;

/**
 * Class AulaRepository
 * @package App\Repositories
 * @version January 11, 2021, 4:15 pm UTC
*/

class AulaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'CdUsuario_Aluno',
        'CdAnuncio',
        'Horario'
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
        return Aula::class;
    }
}
