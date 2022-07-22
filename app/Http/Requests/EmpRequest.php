<?php

namespace App\Http\Requests;

class EmpRequest extends Request
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'emp_code'   => 'required',
            'emp_name'   => 'required',
            'role'       => 'required',
            'doj'        => 'required',
            'email'      => 'email',
            'mob_number' => 'required',
        ];
    }
}