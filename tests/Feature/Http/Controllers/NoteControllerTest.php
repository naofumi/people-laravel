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

}
