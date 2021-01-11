<?php

namespace App\Models;

use Eloquent as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Usuario",
 *      required={"NmUsuario", "Email", "Login", "Senha", "DtNascimento", "CdInstituicao"},
 *      @SWG\Property(
 *          property="CdUsuario",
 *          description="CdUsuario",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="NmUsuario",
 *          description="NmUsuario",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="Email",
 *          description="Email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="Login",
 *          description="Login",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="Senha",
 *          description="Senha",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="DtNascimento",
 *          description="DtNascimento",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="Avaliacao",
 *          description="Avaliacao",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="Descricao",
 *          description="Descricao",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="Foto",
 *          description="Foto",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="CdInstituicao",
 *          description="CdInstituicao",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Usuario extends Model
{

    use HasFactory;

    public $table = 'usuario';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $connection = "mysql";

    public $fillable = [
        'NmUsuario',
        'Email',
        'Login',
        'Senha',
        'DtNascimento',
        'Avaliacao',
        'Descricao',
        'Foto',
        'CdInstituicao'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'CdUsuario' => 'integer',
        'NmUsuario' => 'string',
        'Email' => 'string',
        'Login' => 'string',
        'Senha' => 'string',
        'DtNascimento' => 'date',
        'Avaliacao' => 'decimal:2',
        'Descricao' => 'string',
        'Foto' => 'string',
        'CdInstituicao' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'NmUsuario' => 'required|string|max:200',
        'Email' => 'required|string|max:200',
        'Login' => 'required|string|max:200',
        'Senha' => 'required|string|max:100',
        'DtNascimento' => 'required',
        'Avaliacao' => 'nullable|numeric',
        'Descricao' => 'nullable|string|max:240',
        'Foto' => 'nullable|string|max:65535',
        'CdInstituicao' => 'required|integer'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cdinstituicao()
    {
        return $this->belongsTo(\App\Models\Instituicao::class, 'CdInstituicao');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function disciplinas()
    {
        return $this->belongsToMany(\App\Models\Disciplina::class, 'anuncio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function anuncios()
    {
        return $this->belongsToMany(\App\Models\Anuncio::class, 'aula');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function disciplina1s()
    {
        return $this->belongsToMany(\App\Models\Disciplina::class, 'disciplina_leciona');
    }
}
