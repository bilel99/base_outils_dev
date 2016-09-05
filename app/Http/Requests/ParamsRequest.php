<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class ParamsRequest extends Request
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
            'code.required' => Lang::get('general.code_required'),
            'code.unique'   => Lang::get('general.code_unique'),
            'libelle.required' => Lang::get('general.libelle_required')
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
            'id_langues'=>'required',
            'code'=>'required|unique:params',
            'libelle'=>'required'
        ];
    }
}
