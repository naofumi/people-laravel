<?php

namespace Tests\Unit;

use App\Models\Person;
use App\Models\Tag;
use App\Models\Tagging;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaggingTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_tag()
    {
        $tag = Tag::factory()->create(['name' => 'Test Tag']);
        $person = Person::factory()->create();

        $tagging = Tagging::factory()->create([
            'tag_id' => $tag->id,
            'taggable_id' => $person->id,
            'taggable_type' => get_class($person),
        ]);

        $this->assertEquals(
            'Test Tag',
            $tagging->tag->name
        );
    }

    public function test_has_taggable()
    {
        $tag = Tag::factory()->create(['name' => 'Test Tag']);
        $person = Person::factory()->create(['name' => 'Mr Bean']);

        $tagging = Tagging::factory()->create([
            'tag_id' => $tag->id,
            'taggable_id' => $person->id,
            'taggable_type' => get_class($person),
        ]);

        $this->assertEquals(
            'Mr Bean',
            $tagging->taggable->name
        );
    }
}
