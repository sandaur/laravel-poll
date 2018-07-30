<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePollRequest extends FormRequest
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
        $dateToRules = 'nullable|date_format:Y-m-d H:i';

        if ($this->get('vote-from')) {
            $dateToRules .= '|after:vote-from';
        }

        return [
            'vote-subdom'   => 'required|unique:votations,subdom|min:3|max:12|alpha_num',
            'vote-title'    => 'required|min:3|max:35',
            'vote-desc'     => 'required|min:40|max:350',
            'vote-from'     => 'nullable|date_format:Y-m-d H:i',
            'vote-to'       => $dateToRules,
        ];
    }

    public function messages()
    {
        return [
            'vote-from.date_format' => 'La fecha ":input" no coincide con el formato :format.',
        ];
    }
}
