<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function taggings()
    {
        return $this->hasMany(Tagging::class);
    }

    // Note:
    // In a Polymorphic Laravel Many To Many relationship like
    // A <- join table -> B (consists of object of class Alpha and Beta),
    // when you try to access B directly from A,
    // you cannot retrieve the results as a collection of Alpha and Beta
    // type objects. You can only retrieve either objects of type A or type B,
    // not a mix.
    //
    // That is to say, `morphedByMany` can only return an Array
    // consisting of a single class.
    //
    // On the other hand, in a One To Many relationship where
    // A(one) <--> B(many) and A can be many different classes,
    // retrieving A from B can return any object.
    public function people()
    {
        return $this->morphedByMany(related: Person::class,
            name: 'taggable',
            table: 'taggings');
    }
}
