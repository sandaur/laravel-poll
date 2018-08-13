<?php

namespace App\Http\Requests;

use Carbon;
use Illuminate\Validation\Rule;
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
        $dateTimeFormat = 'd/m/Y h:i A';
        $endDateRestriction = '';

        if ($this->get('start_datetime')) {
            $endDateRestriction = '|after:start_datetime';
        }

        return [ // coordinar restricciones con frontend
            'subdomain'     => 'required|unique:votations,subdom|min:4|max:18|alpha_num',
            'title'         => 'required|min:5|max:40',
            'description'   => 'required|min:40|max:350',
            'admition'      => ['required', Rule::in(['all', 'whitelist'])],
            'user_enc'      => 'required|boolean',
            'auth_cu'       => 'required|boolean',
            'auth_email'    => 'required|boolean',
            'auth_rut'      => 'required|boolean',
            'start_active'  => 'required|boolean',
            'end_active'    => 'required|boolean',
            'start_datetime'=> 'nullable|required_if:start_active,true|date_format:'.$dateTimeFormat,
            'end_datetime'  => 'nullable|required_if:end_active,true|date_format:'.$dateTimeFormat.$endDateRestriction,
        ];
    }

    public function messages()
    {
        return [
            //'vote-from.date_format' => 'La fecha ":input" no coincide con el formato :format.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();
            if ($data['end_active']){
                $data['end_datetime'] = Carbon\Carbon::createFromFormat('d/m/Y h:i A', $data['end_datetime']);
            }
            if ($data['start_active']){
                $data['start_datetime'] = Carbon\Carbon::createFromFormat('d/m/Y h:i A', $data['start_datetime']);
            }
            $this->getInputSource()->replace($data);
        });
    }
}
