<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LookStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image_url' => 'required|string',
            'description' => 'required|string',
            'target_amount' => 'nullable|numeric',
        ];
    }
}
