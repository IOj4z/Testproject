<?php

namespace App\Http\Controllers\API\V1\USER;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResourse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function user()
    {
        $user = Auth::user();
        return (new UsersResourse($user))->additional([
            'data'=> [
                'permissions' => $user->permissions()
            ]
        ]);
    }

    public function show($id)
    {

        $user = User::find($id);
        return response($user);
    }
}
