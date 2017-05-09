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
            'Answers'    =>  'required',
            'AnswerKey'    =>  'required'
        ];
    }
}
