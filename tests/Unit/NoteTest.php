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

    public function test_commenter_and_commentable_relation_settable_via_field_entry()
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

    public function test_commentableFindSafe_success()
    {
        $person = Person::factory()->create(['id' => 9999]);

        $commentable = Note::commentableFindSafe(
            commentableType: 'App\Models\Person',
            commentableId: 9999
        );

        $this->assertEquals($person->name, $commentable->name);
    }

    public function test_commentableFindSafe_fail_with_unallowed_type()
    {
        $person = Person::factory()->create(['id' => 9999]);

        $commentable = Note::commentableFindSafe(
            commentableType: 'App\Models\User',
            commentableId: 9999
        );

        $this->assertNull($commentable);
    }

    public function test_commentableFindSafe_fail_with_missing_id()
    {
        $person = Person::factory()->create(['id' => 9999]);

        $commentable = Note::commentableFindSafe(
            commentableType: 'App\Models\Person',
            commentableId: 1111
        );

        $this->assertNull($commentable);
    }

}
