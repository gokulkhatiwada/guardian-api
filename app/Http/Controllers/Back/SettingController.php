<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\Back\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Routing\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::firstOrCreate(array());
        return view('back.settings.index',compact('settings'));
    }

    public function update(SettingUpdateRequest $request)
    {
        $settings = Setting::firstOrCreate();

        $settings->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'meta_title'=>$request->metaTitle,
            'meta_description'=>$request->metaDescription,
            'email'=>$request->email,
            'contact'=>$request->contact,
            'address'=>$request->address,
        ]);

        return redirect()->route('setting')->with('success','Settings updated successfully');
    }
}