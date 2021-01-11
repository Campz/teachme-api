<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Tipo",
 *      required={"NmTipo"},
 *      @SWG\Property(
 *          property="CdTipo",
 *          description="CdTipo",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="NmTipo",
 *          description="NmTipo",
 *          type="string"
 *      )
 * )
 */
class Tipo extends Model
{

    use HasFactory;

    public $table = 'tipo';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $connection = "mysql";

    public $fillable = [
        'NmTipo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'CdTipo' => 'integer',
        'NmTipo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'NmTipo' => 'required|string|max:100'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function disciplinas()
    {
        return $this->hasMany(\App\Models\Disciplina::class, 'CdTipo');
    }
}
