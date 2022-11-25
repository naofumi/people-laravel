<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Note;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class NoteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_create()
    {
        $person = Person::factory()->create();
        $response = $this->get(route('notes.create', [
            'notable_id' => $person->id,
            'notable_type' => get_class($person)
        ]));

        $response->assertStatus(200);
        $response->assertSee('Create Note');
    }

    public function test_store_with_valid_paramters()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $response = $this->post(route('notes.store'), [
            'content' => 'Note Content',
            'notable_id' => $person->id,
            'notable_type' => get_class($person)
        ]);

        $this->assertDatabaseHas('notes', ['content' => 'Note Content']);
        $response->assertRedirect(route('people.show', $person))
                 ->assertSessionHas('success', 'Note was successfully created.');
    }

    public function test_store_with_invalid_paramters()
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $response = $this->post(route('notes.store'), [
            'content' => '',
            'notable_id' => $person->id,
            'notable_type' => get_class($person)
        ]);

        $this->assertDatabaseMissing('notes', ['content' => '']);
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'content' => 'The content field is required.'
        ]);
    }

    public function test_edit()
    {
        $noter = User::factory()->create();
        $person = Person::factory()->create();
        $note = Note::factory()->create([
            'content' => 'Some Note content',
            'notable_id' => $person->id,
            'notable_type' => get_class($person),
            'noter_id' => $noter->id,
            'noter_type' => get_class($noter)
        ]);

        $response = $this->get(route('notes.edit', $note));

        $response->assertStatus(200);
        $response->assertSee('Some Note content');
    }

    public function test_update()
    {
        $noter = User::factory()->create();
        $person = Person::factory()->create();
        $note = Note::factory()->create([
            'content' => 'Some Note content',
            'notable_id' => $person->id,
            'notable_type' => get_class($person),
            'noter_id' => $noter->id,
            'noter_type' => get_class($noter)
        ]);

        $response = $this->patch(route('notes.update', $note), [
            'content' => 'Update Note content',
        ]);

        $this->assertDatabaseHas('notes', ['content' => 'Update Note content']);
        $response->assertRedirect(route('notes.show', $note->id))
                 ->assertSessionHas('success', 'Note was successfully updated.');
    }
}
