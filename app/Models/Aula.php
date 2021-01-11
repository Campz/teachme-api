<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Aula",
 *      required={"CdUsuario_Aluno", "CdAnuncio", "Horario"},
 *      @SWG\Property(
 *          property="CdAula",
 *          description="CdAula",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="CdUsuario_Aluno",
 *          description="CdUsuario_Aluno",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="CdAnuncio",
 *          description="CdAnuncio",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="Horario",
 *          description="Horario",
 *          type="string"
 *      )
 * )
 */
class Aula extends Model
{

    use HasFactory;

    public $table = 'aula';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $connection = "mysql";

    public $fillable = [
        'CdUsuario_Aluno',
        'CdAnuncio',
        'Horario'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'CdAula' => 'integer',
        'CdUsuario_Aluno' => 'integer',
        'CdAnuncio' => 'integer',
        'Horario' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'CdUsuario_Aluno' => 'required|integer',
        'CdAnuncio' => 'required|integer',
        'Horario' => 'required|string|max:45'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cdusuarioAluno()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'CdUsuario_Aluno');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cdanuncio()
    {
        return $this->belongsTo(\App\Models\Anuncio::class, 'CdAnuncio');
    }
}
