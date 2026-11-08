<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'image_src' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'card_id' => 'nullable|string|max:255',
        ];
    }
}
