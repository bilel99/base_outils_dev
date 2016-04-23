<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class UsersRequest extends Request
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
            'id_role.required'          => Lang::get('global.roleRequis'),
            'nom.required'              => Lang::get('global.nomRequis'),
            'prenom.required'           => Lang::get('global.prenomRequis'),
            'email.required'            => Lang::get('global.emailRequis'),
            'id_ville.required'         => Lang::get('global.villeRequis')
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
            'id_role'           => 'required',
            'nom'               => 'required',
            'prenom'            => 'required',
            'email'             => 'required|email',
            'id_ville'          => 'required'
        ];
    }
}
