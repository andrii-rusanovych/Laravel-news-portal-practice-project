<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tags extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function newsItem(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    protected $fillable = [
        'tag'
    ];
}
