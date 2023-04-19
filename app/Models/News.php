<?php

namespace App\Models;

use ImageStorage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $attributes = [
        'is_active' => false,
    ];

    public function tags(): HasMany
    {
        return $this->hasMany(Tags::class);
    }

    public function getImageUrlAttribute(): string {
        return ImageStorage::getUrl($this->image_file_path);
    }

    public function getTagsListAttribute(): string
    {
        $tags = $this->tags->pluck('tag')->toArray();
        return implode(', ', $tags);
    }
}
