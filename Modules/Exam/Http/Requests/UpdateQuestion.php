<?php

namespace Modules\Exam\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateQuestion extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question_id'    =>  'required',
            'question_title'    =>  'required',
            'answer1'           =>  'required',
            'answer2'           =>  'required',
            'answer3'           =>  'required',
            'answer4'           =>  'required',
            'answer_correct'    =>  'required|numeric|min:1|max:4'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->role == 1 || Auth::user()->role == 2){
            return true;
        }
        return false;
    }
}
