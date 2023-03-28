<?php

namespace App\Http\Controllers\API\V1\USER;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function index()
    {

        return response(Auth::user());
    }

    public function show($id)
    {

        $user = User::find($id);
        return response($user);
    }
}
