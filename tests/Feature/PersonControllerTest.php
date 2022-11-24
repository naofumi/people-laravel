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
}
