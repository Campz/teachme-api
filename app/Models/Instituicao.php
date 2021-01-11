<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Instituicao",
 *      required={"NmInstituicao", "Endereco"},
 *      @SWG\Property(
 *          property="CdInstituicao",
 *          description="CdInstituicao",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="NmInstituicao",
 *          description="NmInstituicao",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="Endereco",
 *          description="Endereco",
 *          type="string"
 *      )
 * )
 */
class Instituicao extends Model
{

    use HasFactory;

    public $table = 'instituicao';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $connection = "mysql";

    public $fillable = [
        'NmInstituicao',
        'Endereco'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'CdInstituicao' => 'integer',
        'NmInstituicao' => 'string',
        'Endereco' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'NmInstituicao' => 'required|string|max:200',
        'Endereco' => 'required|string|max:200'
    ];

    
}
