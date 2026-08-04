<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'=>'required|string|max:55',
            'description'=>'nullable|string',
            'price' => 'required|numeric|max:999999.99|min:0',
            'stock'=>'required|integer',
        ];
    }
}
