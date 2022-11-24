<?php

namespace Tests\Feature;

use App\Models\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PersonControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index()
    {
        $person = Person::factory()->create(['name' => 'Taro yamada', 'email' => 'taro.yamada@example.com']);
        $response = $this->get('/people');

        $response->assertStatus(200);
        $response->assertSee('Taro yamada');
    }

    public function test_create()
    {
        $response = $this->get(route('people.create'));

        $response->assertStatus(200);
    }

    public function test_store_with_valid_paramters()
    {
        $response = $this->post(route('people.store'), ['name' => 'Taro Yamada',
                                                       'email' => 'taro.yamada@example.com']);

        $response->assertStatus(302);
        $this->assertDatabaseHas('people', ['name' => 'Taro Yamada']);
        $person = Person::all()->last();
        $response->assertRedirect(route('people.show', $person->id));
    }

    public function test_store_with_invalid_name()
    {
        $response = $this->post(route('people.store'), ['name' => '',
                                                       'email' => 'taro.yamada@example.com']);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
    }

    public function test_store_with_blank_email()
    {
        $response = $this->post(route('people.store'), ['name' => 'Taro Yamada',
                                                       'email' => '']);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'The email field is required.'
        ]);
    }

    public function test_store_with_invalid_email()
    {
        $response = $this->post(route('people.store'), ['name' => 'Taro Yamada',
                                                       'email' => 'invalid_email_address']);

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'The email must be a valid email address.'
        ]);
    }

    public function test_show()
    {
        $person = Person::factory()->create(['name' => 'Taro Yamada', 'email' => 'taro.yamada@example.com']);
        $response = $this->get(route('people.show', $person->id));

        $response->assertStatus(200);
        $response->assertSee('Taro Yamada');
    }

}
