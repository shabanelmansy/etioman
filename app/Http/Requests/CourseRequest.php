<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CourseRequest extends Request
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
           'title' => 'required',
           'instructor'  => 'required',
           'start_at' =>'required|date',
           'end_at' =>'required|after:start_at|date_format:Y-m-d'
        ];
    }
}
