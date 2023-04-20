<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsItemRequest extends FormRequest
{
    public function attributes(): array
    {
        return [
            'title' => 'Article Title',
            'body' => 'Article Body',
            'image' => 'Article Image File',
            'is_active' => '"Show this article on the website" checkbox',
            'tags' => 'Article Tags list',
        ];
    }
}
