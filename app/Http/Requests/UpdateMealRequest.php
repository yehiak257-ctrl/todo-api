<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMealRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'=>'sometimes|string|max:55',
            'description'=>'nullable|string',
            'price' => 'sometimes|numeric|max:999999.99|min:0',
            'stock'=>'sometimes|integer',
        ];
    }
}
