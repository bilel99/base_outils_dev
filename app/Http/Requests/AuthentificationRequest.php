<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AuthentificationRequest extends Request
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
            'email.required' => 'Adresse mail obligatoire',
            'email.validation' => 'Adresse mail non valide',
            'password.required' => 'Mot de passe obligatoire'
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
            'email'=>'required|email',
            'password'=>'required'
        ];
    }
}
