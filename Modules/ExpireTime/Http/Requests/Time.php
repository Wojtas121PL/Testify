<?php

namespace Modules\ExpireTime\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Time extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'examId' => 'required',
            'userId' => 'required',
            'data' => 'required|date_format:Y-m-d H:i:s'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
