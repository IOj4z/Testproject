<?php

namespace App\Http\Controllers\API\V1\SUPER_USER;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResourse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DependencyInjection\ResettableServicePass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response(UsersResourse::collection(User::all()));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $phone =  rand(1111111111,9999999999);
       $pass =  Hash::make(1234);

       $user = User::create(['phone'=>$phone,'last_name'=>$phone,'password'=>$pass]);
       return response($user,Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $user = User::find($id);

        $user->update([
            'phone' => $request->input('phone'),
            'file' => $request->input('file'),
            'email' => $request->input('email'),
            'last_name' => $request->input('last_name'),
        ]);

        return response($user,Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
