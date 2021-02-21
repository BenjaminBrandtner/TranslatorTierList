<?php

namespace Database\Seeders;

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(
            [
                'name' => 'Hololive',

                'children' => [
                    [
                        'name' => 'Hololive JP',

                        'children' => [
                            ['name' => 'Gen 0'],
                            ['name' => 'Gen 1'],
                            ['name' => 'Gen 2'],
                            ['name' => 'Gamers'],
                            ['name' => 'Gen 3'],
                            ['name' => 'Gen 4'],
                            ['name' => 'Gen 5'],
                        ],
                    ],
                    [
                        'name' => 'Hololive ID',

                        'children' => [
                            ['name' => 'Gen 1'],
                            ['name' => 'Gen 2'],
                        ],
                    ],
                    [
                        'name' => 'Hololive CN',

                        'children' => [
                            ['name' => 'Gen 1'],
                            ['name' => 'Gen 2'],
                        ],
                    ],
                    [
                        'name' => 'Hololive EN',

                        'children' => [
                            ['name' => 'Gen 1'],
                            ['name' => 'Gen 2'],
                        ],
                    ],
                    [
                        'name' => 'Holostars',

                        'children' => [
                            ['name' => 'Gen 1'],
                            ['name' => 'Gen 2'],
                            ['name' => 'Gen 3'],
                        ],
                    ],
                ],
            ],
        );

        Category::create(
            [
                'name' => 'Nijisanji',

                'children' => [
                    // TODO
                ],
            ]
        );

        Category::create(
            [
                'name' => 'VOMS',
            ]
        );

        Category::create(
            [
                'name' => 'Independent',
            ]
        );
    }
}
