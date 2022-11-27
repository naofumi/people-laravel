<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstWhere('name', 'Test User');
        $person = Person::firstWhere('name', 'Taro Yamada');
        Note::factory()->create([
            'content' => 'Sample Note Content',
            'noter_id' => $user->id,
            'noter_type' => get_class($user),
            'notable_id' => $person->id,
            'notable_type' => get_class($person),
        ]);
    }
}
