<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $attributes = [
        'isActive' => false,
    ];

    public function tags(): HasMany
    {
        return $this->hasMany(Tags::class);
    }
}
