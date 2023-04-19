<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsItemRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'required|image|max:2048',
            'is_active' => 'required|boolean',
            'tags' => 'string'
        ];
    }
}
