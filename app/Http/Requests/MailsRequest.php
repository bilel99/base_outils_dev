<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class MailsRequest extends Request
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
            'id_langues.required'       => Lang::get('global.champRequis'),
            'type.required'              => Lang::get('global.champRequis'),
            'nom.required'           => Lang::get('global.champRequis'),
            'exp_nom.required'            => Lang::get('global.champRequis'),
            'exp_email.required'         => Lang::get('global.champRequis'),
            'sujet.required'    => Lang::get('global.champRequis'),
            'contenue.required'         => Lang::get('global.champRequis')
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
            'id_langues'            => 'required',
            'type'                  => 'required',
            'nom'                   => 'required',
            'exp_nom'               => 'required',
            'exp_email'             => 'required',
            'sujet'                 => 'required',
            'contenue'              => 'required'
        ];
    }
}
