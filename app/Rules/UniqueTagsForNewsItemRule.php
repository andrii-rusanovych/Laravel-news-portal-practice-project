<?php

namespace App\Rules;

use App\Models\Tags;
use Illuminate\Contracts\Validation\Rule;

class UniqueTagsForNewsItemRule implements Rule
{
    protected $newsItemId;
    private $message = '';

    public function __construct($newsItemId)
    {
        $this->newsItemId = $newsItemId;
    }

    public function passes($attribute, $value): bool
    {
        $submittedTags = array_map('trim', explode(',', $value));

        // Check for duplicates in the submitted tags.
        $duplicates = array_diff_assoc($submittedTags, array_unique($submittedTags));
        if (count($duplicates) > 0) {
            $this->message = 'The following tags are duplicated: ' . implode(', ', $duplicates);
            return false;
        }

        // Check for global uniqueness, excluding the current news item.
        $nonUniqueTags = [];
        foreach ($submittedTags as $tag) {
            if (Tags::query()->where('tag', $tag)->where('news_id', '<>', $this->newsItemId)->exists()) {
                $nonUniqueTags[] = $tag;
            }
        }

        if (count($nonUniqueTags) > 0) {
            $this->message = 'The following tags are not globally unique: ' . implode(', ', $nonUniqueTags);
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
