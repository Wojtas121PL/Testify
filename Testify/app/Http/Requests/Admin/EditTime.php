<?php

namespace Testify\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class EditTime extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->role == 1){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'edits.*.user' => 'required',
            'edits.*.exam' => 'required',
            'edits.*.data' => 'required|date_format:Y-m-d H:i:s'
        ];
    }
}
