<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'avatar_path'];

    public function notes(): MorphMany
    {
        return $this->morphMany(related: Note::class,
            name: 'notable');
    }

    public function scopeSearch(Builder $query, ?string $searchString): Builder
    {
        if ($searchString) {
            return $query->where('name', 'LIKE', "%{$searchString}%")
                         ->orWhere('email', 'LIKE', "%{$searchString}%");
        } else {
            return $query;
        }
    }

    public function taggings(): MorphMany
    {
        return $this->morphMany(
            related: Tagging::class,
            name: 'taggable'
        );
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(
            related: Tag::class,
            name: 'taggable',
            table: 'taggings'
        );
    }
}
