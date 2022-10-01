<?php

namespace App\Http\Controllers\guests;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Services\ResponseService;
use App\Services\UserSerivce;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function login(LoginUserRequest $request)
    {
        $login = UserSerivce::login($request->all());
        if ($login)
            return ResponseService::json($login, "تم تسجيل الدخول بنجاح");
        else
            return ResponseService::json(false, "عفوا البيانات غير صحيحة", 401);
    }
}
