<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Note;
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
}
