<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;

/**
 * Class ProfileService.
 */
class ProfileService
{
    public static function getProfileWithRelations($id)
    {
        $profile = Profile::with("posts")->findOrFail($id);
        return $profile;
    }
    public static function getProfileOnly($id)
    {
        $profile = Profile::findOrFail($id);
        return $profile;
    }
    public static function getProfileWithRelationsByUsername($username)
    {

        $profile = User::where("username", "=", $username)->profile->with("posts")->get();
        return $profile;
    }
}
