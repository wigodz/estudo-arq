<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GiftRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:250',
            'url' => 'required|string|max:250',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
