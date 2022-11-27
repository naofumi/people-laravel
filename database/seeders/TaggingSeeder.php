<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Tag;
use App\Models\Tagging;
use Illuminate\Database\Seeder;

class TaggingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = Person::firstWhere('name', 'Taro Yamada');
        $tag = Tag::firstWhere('name', 'Test Tag');

        Tagging::factory()->create([
            'tag_id' => $tag->id,
            'taggable_id' => $person->id,
            'taggable_type' => get_class($person),
            'memo' => 'Test Tagging Memo'
        ]);
    }
}
