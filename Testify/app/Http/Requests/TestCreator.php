<?php

namespace Testify\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TestCreator extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'TestId'    =>  'required',
            'QuestionId'    =>  'required',
            'QuestionType'    =>  'required',
            'Question'    =>  'required',
            'Answer1'    =>  'required',
            'Answer2'    =>  'required',
            'Answer3'    =>  'required',
            'Answer4'    =>  'required',
            'AnswerKey'    =>  'required'
        ];
    }
}
