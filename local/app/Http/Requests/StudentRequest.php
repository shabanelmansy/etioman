<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StudentRequest extends Request
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
            //
           'course_id' => 'required',
           'student_id'  => 'required',
           'name_en'  => 'required',
           'name_ar'  => 'required',
           'gender'  => 'required'
        ];
    }
}
