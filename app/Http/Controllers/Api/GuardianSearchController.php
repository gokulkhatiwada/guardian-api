<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GuardianCredentialNotDefined;
use App\Http\Controllers\Controller;
use App\Services\Requests\GuardianSearch;
use App\Services\Requests\GuardianSingleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GuardianSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->queryString;
        try{
            return Cache::remember('search'.$query?$query:'',10*60,function()use($query){
                return (new GuardianSearch($query))->doRequest();
            });
        } catch (GuardianCredentialNotDefined $e){
            return \response()->json('Not available',503);
        }

    }


}