<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Disciplina_Leciona",
 *      required={"CdDisciplina", "CdUsuario_Professor"},
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
 *      )
 * )
 */
class Disciplina_Leciona extends Model
{

    use HasFactory;

    public $table = 'disciplina_leciona';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $connection = "mysql";

    public $fillable = [
        'CdDisciplina',
        'CdUsuario_Professor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'CdDisciplina' => 'integer',
        'CdUsuario_Professor' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'CdDisciplina' => 'required|integer',
        'CdUsuario_Professor' => 'required|integer'
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
}
