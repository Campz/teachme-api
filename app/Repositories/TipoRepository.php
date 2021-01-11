<?php

namespace App\Repositories;

use App\Models\Tipo;
use App\Repositories\BaseRepository;

/**
 * Class TipoRepository
 * @package App\Repositories
 * @version January 11, 2021, 4:18 pm UTC
*/

class TipoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'NmTipo'
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
        return Tipo::class;
    }
}
