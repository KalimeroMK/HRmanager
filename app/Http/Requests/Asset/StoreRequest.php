<?php

namespace App\Http\Requests\Asset;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'string|required|unique:',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}