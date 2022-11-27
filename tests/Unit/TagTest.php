<?php

namespace Tests\Unit;

use App\Models\Person;
use App\Models\Tag;
use App\Models\Tagging;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_taggings()
    {
        $tag = Tag::factory()->create(['name' => 'Test Tag']);
        $person = Person::factory()->create(['name' => 'Mr Bean']);

        $tagging = Tagging::factory()->create([
            'tag_id' => $tag->id,
            'taggable_id' => $person->id,
            'taggable_type' => get_class($person),
            'memo' => 'Tagging Memo',
        ]);

        $this->assertContains(
            'Tagging Memo',
            $tag->taggings->map(fn ($t) => $t->memo)->toArray()
        );
    }

    public function test_has_people()
    {
        $tag = Tag::factory()->create(['name' => 'Test Tag']);
        $person = Person::factory()->create(['name' => 'Mr Bean']);

        $tagging = Tagging::factory()->create([
            'tag_id' => $tag->id,
            'taggable_id' => $person->id,
            'taggable_type' => get_class($person),
            'memo' => 'Tagging Memo',
        ]);

        $this->assertContains(
            'Mr Bean',
            $tag->people->map(fn ($t) => $t->name)->toArray()
        );
    }
}
