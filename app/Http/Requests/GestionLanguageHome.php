<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GestionLanguageHome extends Request
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
     * Custom messages error
     */
    public function messages(){
        return[
            'francais.required' => 'Champs obligatoire',
            'english.required' => 'Champs obligatoire'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'francais'=>'required',
            'english'=>'required'
        ];
    }
}

