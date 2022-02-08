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

            //return categories from cache or database

            $categories = Cache::rememberForever('db-categories',function(){
                return Category::select('name','slug')->get();
            });

        } catch (GuardianCredentialNotDefined $e){
            return \response()->json('Not available',503);
        }

        return response(CategoryResource::collection($categories),Response::HTTP_OK);
    }


}