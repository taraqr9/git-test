<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'look_id' => ['required', 'exists:looks,id'],
            'parent_comment_id' => ['required', 'numeric'],
            'content' => 'required|string',
        ];
    }
}
