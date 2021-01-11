<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Anuncio",
 *      required={"QtdAlunos", "CdDisciplina", "CdUsuario_Professor", "Valor"},
 *      @SWG\Property(
 *          property="CdAnuncio",
 *          description="CdAnuncio",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="QtdAlunos",
 *          description="QtdAlunos",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="Descricao",
 *          description="Descricao",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="CdDisciplina",
 *          description="CdDisciplina",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="CdUsuario_Professor",
 *          description="CdUsuario_Professor",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="Valor",
 *          description="Valor",
 *          type="number",
 *          format="number"
 *      )
 * )
 */
class Anuncio extends Model
{

    use HasFactory;

    public $table = 'anuncio';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $connection = "mysql";

    public $fillable = [
        'QtdAlunos',
        'Descricao',
        'CdDisciplina',
        'CdUsuario_Professor',
        'Valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'CdAnuncio' => 'integer',
        'QtdAlunos' => 'integer',
        'Descricao' => 'string',
        'CdDisciplina' => 'integer',
        'CdUsuario_Professor' => 'integer',
        'Valor' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'QtdAlunos' => 'required|integer',
        'Descricao' => 'nullable|string|max:200',
        'CdDisciplina' => 'required|integer',
        'CdUsuario_Professor' => 'required|integer',
        'Valor' => 'required|numeric'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cddisciplina()
    {
        return $this->belongsTo(\App\Models\Disciplina::class, 'CdDisciplina');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cdusuarioProfessor()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'CdUsuario_Professor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function usuario1s()
    {
        return $this->belongsToMany(\App\Models\Usuario::class, 'aula');
    }
}
