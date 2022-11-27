<?php

namespace Tests\Unit;

use App\Models\Note;
use App\Models\Person;
use App\Models\Tag;
use App\Models\Tagging;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_notes()
    {
        $user = User::factory()->create();

        $person = Person::factory()->create();

        $note = Note::factory()->create([
            'content' => 'Some Note content',
            'noter_id' => $user->id,
            'noter_type' => 'App\Models\User',
            'notable_id' => $person->id,
            'notable_type' => 'App\Models\Person',
        ]);

        $this->assertEquals(
            $note->content,
            $person->notes->first()->content
        );
    }

    public function test_search_scope()
    {
        $user1 = Person::factory()->create(['name' => 'Taro Yamada']);
        $user2 = Person::factory()->create(['name' => 'Hanako Sato']);

        $search1 = Person::search('Taro')->get();
        $this->assertCount(1, $search1);
        $this->assertEquals('Taro Yamada', $search1[0]->name);

        // type insensitive
        $search2 = Person::search('taro')->get();
        $this->assertCount(1, $search2);
        $this->assertEquals('Taro Yamada', $search2[0]->name);

        $search3 = Person::search('a')->get();
        $this->assertCount(2, $search3);

        // blank query
        $search4 = Person::search('')->get();
        $this->assertCount(2, $search4);
    }

    public function test_taggings()
    {
        $person = Person::factory()->create(['name' => 'Mr Bean']);
        $tag = Tag::factory()->create();

        $tagging = Tagging::factory()->create([
            'tag_id' => $tag->id,
            'taggable_id' => $person->id,
            'taggable_type' => get_class($person),
            'memo' => 'Tagging Memo',
        ]);

        $this->assertContains(
            'Tagging Memo',
            $person->taggings->map(fn ($tg) => $tg->memo)
        );
    }

    public function test_tags()
    {
        $person = Person::factory()->create(['name' => 'Mr Bean']);
        $tag = Tag::factory()->create(['name' => 'Test Tag']);

        $tagging = Tagging::factory()->create([
            'tag_id' => $tag->id,
            'taggable_id' => $person->id,
            'taggable_type' => get_class($person),
        ]);

        $this->assertContains(
            'Test Tag',
            $person->tags->map(fn ($tg) => $tg->name)
        );
    }
}
