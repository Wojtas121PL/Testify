<?php

namespace Testify\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class AddQuestion extends FormRequest
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
            'question_title'    =>  'required',
            'answer1'    =>  'required',
            'answer2'    =>  'required',
            'answer3'    =>  'required',
            'answer4'    =>  'required',
            'answer_correct'    =>  'required'
        ];
    }
}
