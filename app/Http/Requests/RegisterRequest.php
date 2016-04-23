<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class RegisterRequest extends Request
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
            'email.required' => Lang::get('general.email_required'),
            'email.unique' => Lang::get('general.email_unique'),
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
            'nom'=>'required|max:50',
            'prenom'=>'required|max:50',
            'email'=>'required|max:50|email|unique:users',
            'password'=>'required|max:100|alpha_dash',
            'conf_password'=>'required|max:100|alpha_dash',
            'id_roles_users'=>'required|numeric'
        ];
    }
}
