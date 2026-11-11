<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:text,image,html',
            'show' => 'boolean',
        ];

        $type = $this->input('type');

        if ($type === 'image') {
            $item = $this->route('profileItem');
            $rule = ($item && $item->content) ? 'nullable' : 'required';
            $rules['content_image'] = [$rule, 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'];
        } elseif ($type === 'text') {
            $rules['content_text'] = 'required|string';
        } elseif ($type === 'html') {
            $rules['body'] = 'required|string';
        }

        return $rules;
    }
}
