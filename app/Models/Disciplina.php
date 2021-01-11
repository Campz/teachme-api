<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Disciplina",
 *      required={"NmDisciplina", "CdTipo"},
 *      @SWG\Property(
 *          property="CdDisciplina",
 *          description="CdDisciplina",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="NmDisciplina",
 *          description="NmDisciplina",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="CdTipo",
 *          description="CdTipo",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Disciplina extends Model
{

    use HasFactory;

    public $table = 'disciplina';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $connection = "mysql";

    public $fillable = [
        'NmDisciplina',
        'CdTipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'CdDisciplina' => 'integer',
        'NmDisciplina' => 'string',
        'CdTipo' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'NmDisciplina' => 'required|string|max:100',
        'CdTipo' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cdtipo()
    {
        return $this->belongsTo(\App\Models\Tipo::class, 'CdTipo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function usuarios()
    {
        return $this->belongsToMany(\App\Models\Usuario::class, 'anuncio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function usuario1s()
    {
        return $this->belongsToMany(\App\Models\Usuario::class, 'disciplina_leciona');
    }
}
