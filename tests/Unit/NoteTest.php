<?php

namespace Tests\Unit;

use App\Models\Note;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_commenter_and_commentable_association_via_field_entry()
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

        $this->assertEquals($user->name, $note->commenter->name);
        $this->assertEquals($person->name, $note->commentable->name);
    }
}
