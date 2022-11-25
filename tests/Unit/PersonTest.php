<?php

namespace Tests\Unit;

use App\Models\Note;
use App\Models\Person;
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
            'commenter_id' => $user->id,
            'commenter_type' => 'App\Models\User',
            'commentable_id' => $person->id,
            'commentable_type' => 'App\Models\Person',
        ]);

        $this->assertEquals(
            $note->content,
            $person->notes->first()->content
        );
    }
}
