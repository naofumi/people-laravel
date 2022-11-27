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
    protected $user;

    protected function setUp() : void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_create_requires_login()
    {
        $response = $this->get(route('notes.create'));

        $response->assertRedirect(route('login'));
    }

    public function test_create()
    {
        $person = Person::factory()->create();
        $response = $this->actingAs($this->user)
                         ->get(route('notes.create', [
            'notable_id' => $person->id,
            'notable_type' => get_class($person)
        ]));

        $response->assertStatus(200)
                 ->assertSee('Create Note');
    }

    public function test_store_with_valid_paramters()
    {
        $person = Person::factory()->create();

        $response = $this->actingAs($this->user)
                         ->post(route('notes.store'), [
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
        $person = Person::factory()->create();

        $response = $this->actingAs($this->user)
                         ->post(route('notes.store'), [
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
        $person = Person::factory()->create();
        $note = Note::factory()
            ->for(User::factory(), 'noter')
            ->for(Person::factory(), 'notable')
            ->create([
                'content' => 'Some Note content',
            ]);

        $response = $this->actingAs($this->user)
                         ->get(route('notes.edit', $note));

        $response->assertStatus(200);
        $response->assertSee('Some Note content');
    }

    public function test_update()
    {
        $noter = User::factory()->create();
        $person = Person::factory()->create();
        $note = Note::factory()
                ->for(User::factory(), 'noter')
                ->for(Person::factory(), 'notable')
                ->create([
                    'content' => 'Some Note content',
                ]);

        $response = $this->actingAs($this->user)
                         ->patch(route('notes.update', $note), [
            'content' => 'Update Note content',
        ]);

        $this->assertDatabaseHas('notes', ['content' => 'Update Note content']);
        $response->assertRedirect(route('notes.show', $note->id))
                 ->assertSessionHas('success', 'Note was successfully updated.');
    }

    public function test_show()
    {
        $note = Note::factory()
                    ->for(User::factory(), 'noter')
                    ->for(Person::factory(), 'notable')
                    ->create([
                        'content' => 'Some Note content'
                    ]);

        $response = $this->actingAs($this->user)
                         ->get(route('notes.show', $note));

        $response->assertStatus(200);
        $response->assertSee('Some Note content');
    }

    public function test_destroy()
    {
        $note = Note::factory()
                    ->for(User::factory(), 'noter')
                    ->for(Person::factory(), 'notable')
                    ->create([
                        'content' => 'Some Note content'
                    ]);

        $response = $this->actingAs($this->user)
                         ->delete(route('notes.destroy', $note));
        $this->assertModelMissing($note);
        $response->assertRedirect(route('people.show', $note->notable))
            ->assertSessionHas('success', 'Note was successfully deleted.');
    }

}
