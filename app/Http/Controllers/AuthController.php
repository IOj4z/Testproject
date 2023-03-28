<?php

namespace App\Http\Controllers;


use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Resources\UsersResourse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        if (Auth::attempt($request->only('phone','password'))){
            $user = Auth::user();
            $scope = $request->input('scope');
            $token = $user->createToken($scope,[$scope])->accessToken;

            $coockie = cookie('jwt',$token,3600);
            return \response([
                'token'=>$token
            ])->withCookie($coockie) ;
        }

        return response([
            'error' => 'Invalid Credentials!'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function logout()
    {
        $cookie = \cookie()->forget('jwt');
        return \response([
            'message' => 'success'
        ])->withCookie($cookie);
    }


    public function user()
    {
        $user = Auth::user();
        dd($user);
        return (new UsersResourse($user))->additional([
            'data'=> [
                'permissions' => $user->permissions(),
            ],
        ]);
    }
    public function updateInfo(UpdateInfoRequest $request)
    {
        $user = Auth::user();


        $user->update($request->only('phone', 'last_name', 'email'));

        return response(new UsersResourse($user), Response::HTTP_ACCEPTED);
    }

    public function updatePassword(UpdatePasswordRequest $request)

    {
        $user = Auth::user();
        $old_password =$request->input('old_password');
        try {
            if (Hash::check($old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->input('password')),
                ]);
                return response(new UsersResourse($user), Response::HTTP_ACCEPTED);
            }else{
                throw new Exception('password was entered uncorrected');
            }



        }catch (Exception $exception){
            $msg = [
                'action' => 'msg',
                'error' => true,
                'msg' =>  $exception->getMessage(),
            ];
            return \response($msg);
        }




    }
}
