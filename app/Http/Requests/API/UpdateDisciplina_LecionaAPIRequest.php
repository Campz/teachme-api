<?php

namespace App\Http\Requests\API;

use App\Models\Disciplina_Leciona;
use InfyOm\Generator\Request\APIRequest;

class UpdateDisciplina_LecionaAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Disciplina_Leciona::$rules;
        
        return $rules;
    }
}
