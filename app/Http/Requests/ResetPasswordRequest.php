<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class ResetPasswordRequest extends Request
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
            'email.required' => Lang::get('global.emailRequis'),
            'old_password.required' => Lang::get('global.oldPasswordRequis'),
            'password.required' => Lang::get('global.passwordRequis'),
            'password_confirm.required' => Lang::get('global.confirmationPasswordRequis'),
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
            'email'=>'required|max:50|email',
            'old_password'=>'required|max:100|alpha_dash',
            'password'=>'required|max:100|alpha_dash',
            'password_confirm'=>'required|max:100|alpha_dash',
        ];
    }
}
