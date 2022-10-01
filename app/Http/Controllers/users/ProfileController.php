<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Services\FileHandleService;
use App\Services\ProfileService;
use App\Services\ResponseService;
use Auth;
use File;
use Response;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = ProfileService::getProfileWithRelations(Auth::user()->profile->id);

        // return ResponseService::json($profile);
        return view("welcome", compact("profile"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = ProfileService::getProfileWithRelations($id);

        // return ResponseService::json($profile);
        return view("welcome", compact("profile"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = ProfileService::getProfileOnly($id);

        // return ResponseService::json($profile);
        return view("welcome", compact("profile"));
    }
    public function showProfileByUsername($username)
    {
        $profile = ProfileService::getProfileWithRelationsByUsername($username);

        // return ResponseService::json($profile);
        return view("welcome", compact("profile"));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {

        $data = $request->all();
        if ($request->file("avatar")) {
            if (FileHandleService::deleteImageIfExists($profile->avatar))
                $data["avatar"] = FileHandleService::uploadImage($request->file("avatar"), "/images/profiles");
        }

        $profile->update($data);

        return ResponseService::json($profile, "تم تحديث الملف الشخصي بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
