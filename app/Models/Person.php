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
        return $this->morphMany(Note::class, 'notable');
    }
}
