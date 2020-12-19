<?php

namespace Database\Seeders;

use App\VTuber;
use Illuminate\Database\Seeder;

class VTuberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vtubers = [
            [
                'name' => 'Usada Pekora',
                'focus_name' => '👯',
            ],
            [
                'name' => 'Sakura Miko',
                'focus_name' => '🌸',
            ],
            [
                'name' => 'Inugami Korone',
                'focus_name' => '🥐',
            ],
            [
                'name' => 'Yuzuki Choco',
                'focus_name' => '🍫💋',
            ],
        ];

        foreach ($vtubers as $vtuber) {
            VTuber::create($vtuber);
        }
    }
}
