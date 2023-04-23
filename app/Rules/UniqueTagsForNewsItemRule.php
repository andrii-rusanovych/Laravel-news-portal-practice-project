<?php

namespace App\Rules;

use App\Models\Tags;
use Illuminate\Contracts\Validation\Rule;
use function Webmozart\Assert\Tests\StaticAnalysis\length;

class UniqueTagsForNewsItemRule implements Rule
{
    protected $newsItemId;
    private $message = '';

    public function __construct($newsItemId = null)
    {
        $this->newsItemId = $newsItemId;
    }

    public function passes($attribute, $value): bool
    {
        //for case when value is null
        if ( empty($value) ) return true;

        $submittedTags = array_map('trim', explode(',', $value));

        // Check for tag minimum length
        foreach ($submittedTags as $tag) {
            if(strlen($tag) == 1) {
                $this->message = "Tag - ".$tag." is incorrect, tag must have minimum length of 2 characters";
                return false;
            }
        }

        // Check for duplicates in the submitted tags.
        $duplicates = array_diff_assoc($submittedTags, array_unique($submittedTags));
        if (count($duplicates) > 0) {
            $this->message = 'The following tags are duplicated: ' . implode(', ', $duplicates);
            return false;
        }

        // Check for global uniqueness, including the current news item if it exists.
        $nonUniqueTags = [];
        foreach ($submittedTags as $tag) {
            $query = Tags::query()->where('tag', $tag);
            if ($this->newsItemId) {
                $query->where('news_id', '<>', $this->newsItemId);
            }
            if ($query->exists()) {
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
