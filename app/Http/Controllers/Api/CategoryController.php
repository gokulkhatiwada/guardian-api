<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GuardianCredentialNotDefined;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        try{
            $this->checkCacheHasEmptyValue('db-categories');

            //return categories from cache or database

            $categories = Cache::rememberForever('db-categories',function(){
                return Category::select('name','slug')->get();
            });

            if($categories->count() < 1) {
                $categories = $this->generateStaticCategories();
            }

        } catch (GuardianCredentialNotDefined $e){
            return \response()->json('Not available',503);
        }

        return response(CategoryResource::collection($categories),Response::HTTP_OK);
    }

    protected function generateStaticCategories()
    {
        return Category::hydrate( [
            [
                'name'=>'News',
                'slug'=>'news',
            ],
            [
                'name'=>'Sport',
                'slug'=>'sport'
            ],
            [
                'name'=>'Business',
                'slug'=>'business'
            ]
        ]);
    }


}