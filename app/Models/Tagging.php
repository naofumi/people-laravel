<?php

declare(strict_types=1);
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Tagging extends Model
{
    use HasFactory;

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function taggable(): morphTo
    {
        return $this->morphTo();
    }
}
