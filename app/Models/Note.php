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

    public function commenter()
    {
        return $this->morphTo();
    }

    public function commentable()
    {
        return $this->morphTo();
    }

}
