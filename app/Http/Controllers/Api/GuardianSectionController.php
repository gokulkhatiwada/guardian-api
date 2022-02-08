<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\GuardianCredentialNotDefined;
use App\Http\Controllers\Controller;
use App\Services\Requests\GuardianSection;
use Illuminate\Support\Facades\Cache;

class GuardianSectionController extends Controller
{
    public function getAll()
    {
        try{
            return Cache::remember('guardian-sections',10*60,function(){
                return (new GuardianSection())->doRequest();
            });
        } catch (GuardianCredentialNotDefined $e){
            return \response()->json('Not available',503);
        }

    }
}