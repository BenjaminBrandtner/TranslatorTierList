<?php


namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryTreeResource;
use Cache;


class CategoriesController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function tree()
    {
        return Cache::remember(
            'categoriesResponse',
            now()->addHours(2),
            function () {
                $rootCategories = collect();
                $rootIds = Category::whereIsRoot()->pluck('id');

                foreach ($rootIds as $id) {
                    $rootCategories->push(Category::descendantsAndSelf($id)->toTree());
                }

                return CategoryTreeResource::collection($rootCategories->flatten());
            }
        );
    }
}
