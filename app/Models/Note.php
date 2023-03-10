<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'noter_id',
        'noter_type',
        'notable_id',
        'notable_type',
    ];

    protected static $allowedCommentableClasses = [
        'App\Models\Person',
    ];

    public function noter(): MorphTo
    {
        return $this->morphTo();
    }

    public function notable(): MorphTo
    {
        return $this->morphTo();
    }

    // Finds the notable object.
    // For security reasons, only the $notableTypes that have been whitelisted
    // in $allowedCommentableClasses are allowed.
    //
    // If either the $notableType is not allowed, or the $commetableId does not
    // exist in the DB, `null` is returned.
    public static function notableFindSafe(string $notableType, int|string $notableId): ?Person
    {
        if (array_search($notableType, Note::$allowedCommentableClasses) === false) {
            return null;
        } else {
            return $notableType::find($notableId);
        }
    }
}
