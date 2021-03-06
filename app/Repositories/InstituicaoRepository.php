<?php

namespace App\Repositories;

use App\Models\Instituicao;
use App\Repositories\BaseRepository;

/**
 * Class InstituicaoRepository
 * @package App\Repositories
 * @version January 11, 2021, 4:17 pm UTC
*/

class InstituicaoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'NmInstituicao',
        'Endereco'
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
        return Instituicao::class;
    }
}
