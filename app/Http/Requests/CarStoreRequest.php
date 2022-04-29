<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
            'automaker_id' => ['required'],
            'name' => ['required'],
            'model' => ['nullable'],
            'engine' => ['required'],
            'initial_year' => ['required'],
            'final_year' => ['required']
        ];
    }
}
