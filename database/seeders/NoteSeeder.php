<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'commenter_id' => $user->id,
            'commenter_type' => get_class($user),
            'commentable_id' => $person->id,
            'commentable_type' => get_class($person)
        ]);
    }
}
