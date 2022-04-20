<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller

{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'code' => 200,
            'users' => $users,
        ]);
    }

    public function login(Request $request)
    {
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            $token = auth()->user()->createToken('token')->accessToken;

            return response()->json([
                'code' => 200,
                'user' => auth()->user(),
                'token' => $token,
                'message' => 'Success',
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Invalid Username and Password'
            ], 401);
        };
    }

    public function addUser(Request $request)
    {
        $this->validate($request, [
            'password' => 'min:6',
            'confirm_password' => 'required_with:password|same:password|min:6'
        ]);

        $addUser = new User;

        $addUser->first_name = $request->first_name;
        $addUser->last_name = $request->first_name;
        $addUser->middle_name = $request->first_name;
        $addUser->email = $request->email;
        $addUser->password = Hash::make($request->input('password'));

        $addUser->save();

        if ($addUser->save() == true) {
            return response()->json([
                'code' => 200,
                'message' => 'User Added Successfully!'
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Failed to Add User!'
            ]);
        }
    }

    public function deleteUserbyID($id)
    {
        $users = User::where('id', $id)->delete();

        if ($users == true) {
            return response()->json([
                'code' => 200,
                'message' => "User Deleted Successfully!"
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Failed to Delete User!'
            ]);
        }
    }
}
