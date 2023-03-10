<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PersonControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_index_requires_login()
    {
        $response = $this->get('/people');

        $response->assertRedirect(route('login'));
    }

    public function test_index()
    {
        $person = Person::factory()->create(['name' => 'Taro yamada', 'email' => 'taro.yamada@example.com']);
        $response = $this->actingAs($this->user)
                         ->get('/people');

        $response->assertStatus(200);
        $response->assertSee('Taro yamada');
    }

    public function test_create()
    {
        $response = $this->actingAs($this->user)
                         ->get(route('people.create'));

        $response->assertStatus(200);
    }

    public function test_store_with_valid_paramters()
    {
        $response = $this->actingAs($this->user)
                         ->post(route('people.store'), ['name' => 'Taro Yamada',
                             'email' => 'taro.yamada@example.com', ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('people', ['name' => 'Taro Yamada']);
        $person = Person::all()->last();
        $response->assertRedirect(route('people.show', $person));
    }

    // https://tutsforweb.com/testing-file-uploads-with-laravel/
    public function test_store_with_file_upload()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test_image.jpg');
        $response = $this->actingAs($this->user)
                         ->post(route('people.store'), ['name' => 'Taro Yamada',
                             'email' => 'taro.yamada@example.com',
                             'avatar' => $file, ]);

        $this->assertDatabaseHas('people', ['name' => 'Taro Yamada']);
        $person = Person::all()->last();
        Storage::disk('public')->assertExists($person->avatar_path);
        $response->assertRedirect(route('people.show', $person));
    }

    public function test_store_with_invalid_name()
    {
        $response = $this->actingAs($this->user)
                         ->post(route('people.store'), ['name' => '',
                             'email' => 'taro.yamada@example.com', ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
        ]);
    }

    public function test_store_with_blank_email()
    {
        $response = $this->actingAs($this->user)
                         ->post(route('people.store'), ['name' => 'Taro Yamada',
                             'email' => '', ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);
    }

    public function test_store_with_invalid_email()
    {
        $response = $this->actingAs($this->user)
                         ->post(route('people.store'), ['name' => 'Taro Yamada',
                             'email' => 'invalid_email_address', ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'The email must be a valid email address.',
        ]);
    }

    public function test_show()
    {
        $person = Person::factory()->create(['name' => 'Taro Yamada', 'email' => 'taro.yamada@example.com']);
        $response = $this->actingAs($this->user)
                         ->get(route('people.show', $person));

        $response->assertStatus(200);
        $response->assertSee('Taro Yamada');
    }

    public function test_edit()
    {
        $person = Person::factory()->create(['name' => 'Taro Yamada', 'email' => 'taro.yamada@example.com']);
        $response = $this->actingAs($this->user)
                         ->get(route('people.edit', $person));

        $response->assertStatus(200);
        $response->assertSee('Taro Yamada');
    }

    public function test_update_with_valid_paramters()
    {
        $person = Person::factory()->create(['name' => 'Taro Yamada', 'email' => 'taro.yamada@example.com']);

        $response = $this->actingAs($this->user)
                         ->patch(route('people.update', $person), ['name' => 'New Name',
                             'email' => 'new.email@example.com', ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('people', ['name' => 'New Name']);
        $person = Person::all()->last();
        $response->assertRedirect(route('people.show', $person));
    }

    public function test_update_with_blank_email()
    {
        $person = Person::factory()->create(['name' => 'Taro Yamada', 'email' => 'taro.yamada@example.com']);

        $response = $this->actingAs($this->user)
                         ->patch(route('people.update', $person), ['name' => 'New Name',
                             'email' => '', ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('people', ['name' => 'Taro Yamada']);
        $this->assertDatabaseMissing('people', ['name' => 'New Name']);
        $response->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);
    }

    public function test_update_with_blank_name()
    {
        $person = Person::factory()->create(['name' => 'Taro Yamada', 'email' => 'taro.yamada@example.com']);

        $response = $this->actingAs($this->user)
                         ->patch(route('people.update', $person), ['name' => '',
                             'email' => 'taro.yamada@example.com', ]);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.',
        ]);
    }

    public function test_destroy()
    {
        $person = Person::factory()->create(['name' => 'Taro Yamada', 'email' => 'taro.yamada@example.com']);

        $response = $this->actingAs($this->user)
                         ->delete(route('people.destroy', $person));
        $this->assertModelMissing($person);
        $response->assertStatus(302);
        $response->assertRedirect(route('people.index'));
    }
}
