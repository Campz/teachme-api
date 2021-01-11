<?php

namespace App\Repositories;

use App\Models\Anuncio;
use App\Repositories\BaseRepository;

/**
 * Class AnuncioRepository
 * @package App\Repositories
 * @version January 11, 2021, 4:13 pm UTC
*/

class AnuncioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'QtdAlunos',
        'Descricao',
        'CdDisciplina',
        'CdUsuario_Professor',
        'Valor'
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
        return Anuncio::class;
    }
}
