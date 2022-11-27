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

    public function test_noter_and_notable_relation_settable_via_field_entry()
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

        $this->assertEquals($user->name, $note->noter->name);
        $this->assertEquals($person->name, $note->notable->name);
    }

    public function test_notableFindSafe_success()
    {
        $person = Person::factory()->create(['id' => 9999]);

        $notable = Note::notableFindSafe(
            notableType: 'App\Models\Person',
            notableId: 9999
        );

        $this->assertEquals($person->name, $notable->name);
    }

    public function test_notableFindSafe_fail_with_unallowed_type()
    {
        $person = Person::factory()->create(['id' => 9999]);

        $notable = Note::notableFindSafe(
            notableType: 'App\Models\User',
            notableId: 9999
        );

        $this->assertNull($notable);
    }

    public function test_notableFindSafe_fail_with_missing_id()
    {
        $person = Person::factory()->create(['id' => 9999]);

        $notable = Note::notableFindSafe(
            notableType: 'App\Models\Person',
            notableId: 1111
        );

        $this->assertNull($notable);
    }
}
