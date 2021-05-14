<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct('user', 1);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $defaultPassword = $this->getDefaultPassword();
        $request['password'] = Hash::make("$defaultPassword");

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $user = User::create($request->except(['role']));
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $user->update($request->except(['password', 'role']));
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return new UserResource($user);
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        $users = User::where('name', 'like', '%'.$name.'%')->get();
        return UserResource::collection($users);
    }
}