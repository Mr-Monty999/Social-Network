<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserSerivce.
 */
class UserSerivce
{

    public static function register($data)
    {
        $data["password"] = Hash::make($data["password"]);
        $user = User::create($data);
        $data["user_id"] = $user->id;
        Profile::create($data);
        self::login($data);

        return $data;
    }

    public static function login($data)
    {
        if (Auth::attempt(["username" => $data["username"], "password" => $data["password"]], true))
            return true;
        else
            return false;
    }
    public static function deleteUser($userId)
    {
        User::findOrFail($userId)->delete();
        return true;
    }
}
