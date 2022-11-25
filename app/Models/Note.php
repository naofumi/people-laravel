<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'commenter_id',
        'commenter_type',
        'commentable_id',
        'commentable_type',
    ];

    protected static $allowedCommentableClasses = [
        'App\Models\Person'
    ];

    public function commenter()
    {
        return $this->morphTo();
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    // Finds the commentable object.
    // For security reasons, only the $commentableTypes that have been whitelisted
    // in $allowedCommentableClasses are allowed.
    //
    // If either the $commentableType is not allowed, or the $commetableId does not
    // exist in the DB, `null` is returned.
    public static function commentableFindSafe($commentableType, $commentableId)
    {
        if (array_search($commentableType, Note::$allowedCommentableClasses) === false) {
            return null;
        } else {
            return $commentableType::find($commentableId);
        }
    }
}
