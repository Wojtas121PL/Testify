<?php

namespace Testify\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SelectUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::guest()){
            return false;
        }
        return true;
    }

    public function rules()
    {
        return [
            'SelectedUser'    =>  'required',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
}
