<?php

namespace Database\Seeders;

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use LogicException;
use Symfony\Component\Yaml\Yaml;

class CategoriesAndVTubersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Yaml::parseFile(__DIR__ . '/vtubers.yaml');

        $this->createCategoryOrVTubers($data);
    }

    private function createCategory(string $name, Category $parent = null): Category
    {
        //print("creating Category $name, appending to " . optional($parent)->name . "\n");
        return Category::create(['name' => $name], $parent);
    }

    private function createVTuber(array $attributes, Category $parent): void
    {
        //print("creating VTuber " . $attributes['name'] . " in $parent->name\n");
        $parent->VTubers()->create($attributes);
    }

    private function createCategoryOrVTubers($data, $lastNode = null)
    {
        if (Arr::isAssoc($data)) { //categories
            collect($data)->each(
                function ($data, $key) use ($lastNode)
                {
                    $newNode = $this->createCategory($key, $lastNode);
                    if ($data === null) return;
                    $this->createCategoryOrVTubers($data, $newNode);
                }
            );
        } elseif (is_array($data)) { //vtubers
            collect($data)->each(fn($data) => $this->createVTuber($data, $lastNode));
        } else {
            throw new LogicException();
        }
    }
}
