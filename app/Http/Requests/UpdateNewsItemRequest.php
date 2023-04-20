<?php

namespace App\Http\Requests;

use App\Helpers\DatabaseHelper;
use App\Rules\UniqueTagsForNewsItemRule;

class UpdateNewsItemRequest extends NewsItemRequest
{
    public function rules(): array
    {
        $maxLengthForNewsArticleBody = DatabaseHelper::maxCharactersCountForMysqlMediumText();
        return [
            'title' => 'required|string|max:255|min:8',
            'body' => "required|string|min:8|max:{$maxLengthForNewsArticleBody}",
            'image' => 'image|max:2048',
            'is_active' => 'boolean',
            'tags' => ['string', new UniqueTagsForNewsItemRule($this->route('news'))],
        ];
    }
}
