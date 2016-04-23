<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LanguageRequest extends Request
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
            'nom.required' => 'Champs obligatoire',
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
            'nom'=>'required',
            'francais'=>'required',
            'english'=>'required'
        ];
    }
}
