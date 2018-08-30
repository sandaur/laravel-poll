<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionRequest extends FormRequest
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
        return [
            'poll_id' => 'required',
            'name'  => 'required|min:3|max:25',
            'description'  => 'required|min:30|max:350',
            'image'   => 'required|image|dimensions:ratio=1/1,max_width=780',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
