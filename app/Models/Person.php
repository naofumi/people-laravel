<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'avatar_path'];

    public function notes()
    {
        return $this->morphMany(related: Note::class,
            name: 'notable');
    }

    public function scopeSearch($query, $searchString)
    {
        if ($searchString) {
            return $query->where('name', 'LIKE', "%{$searchString}%")
                         ->orWhere('email', 'LIKE', "%{$searchString}%");
        } else {
            return $query;
        }
    }

    public function taggings()
    {
        return $this->morphMany(
            related: Tagging::class,
            name: 'taggable'
        );
    }

    public function tags()
    {
        return $this->morphToMany(
            related: Tag::class,
            name: 'taggable',
            table: 'taggings'
        );
    }
}
