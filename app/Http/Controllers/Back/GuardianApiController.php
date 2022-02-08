<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\ApiCredentialUpdateRequest;
use App\Models\Guardian;
use Illuminate\Routing\Controller;

class GuardianApiController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $credentials = Guardian::firstOrCreate(array());
        return view('back.api-credentials.index',compact('credentials'));
    }

    /**
     * @param ApiCredentialUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ApiCredentialUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {

        $credentials = Guardian::firstOrCreate(array());
        $credentials->update([
           'api_key'=>$request->key,
           'base_url'=>$request->url
       ]);
       return redirect()->route('guardian.api')->with('success','API credentials updated successfully');
    }
}