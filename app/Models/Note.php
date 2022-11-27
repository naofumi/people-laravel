<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function noter()
    {
        return $this->morphTo();
    }

    public function notable()
    {
        return $this->morphTo();
    }

    // Finds the notable object.
    // For security reasons, only the $notableTypes that have been whitelisted
    // in $allowedCommentableClasses are allowed.
    //
    // If either the $notableType is not allowed, or the $commetableId does not
    // exist in the DB, `null` is returned.
    public static function notableFindSafe($notableType, $notableId)
    {
        if (array_search($notableType, Note::$allowedCommentableClasses) === false) {
            return null;
        } else {
            return $notableType::find($notableId);
        }
    }
}
