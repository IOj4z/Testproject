<?php

namespace App\Http\Controllers\API\V1\SUPER_USER;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UsersResourse;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        Gate::authorize('edit', "users");
        $users = User::paginate();
        return UsersResourse::collection($users);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        Gate::authorize('edit', "users");
       $phone =  rand(1111111111,9999999999);
       $pass =  Hash::make(1234);

       $user = User::create([
           'phone'=>$phone,
           'last_name'=>$phone,
           'password'=>$pass,
           'file'=>$request->file('image'),
           'role_id'=>3]);
       return response(new UsersResourse($user),Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('view', "users");
        $user = User::find($id);
        return response(new UsersResourse($user));
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
        Gate::authorize('edit', "users");
       $user = User::find($id);

        $user->update([
            'phone' => $request->input('phone'),
            'file' => $request->input('image'),
            'email' => $request->input('email'),
            'last_name' => $request->input('last_name'),
        ]);

        return response(new UsersResourse($user),Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('edit', "users");
        User::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
