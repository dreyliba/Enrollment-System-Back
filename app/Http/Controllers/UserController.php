<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller

{
    public function index(Request $request)
    {
        $query = User::query();

        if (!empty($request->search)) {
            $query->where(function ($query) use ($request) {
                $value = $request->search;

                $query->where('first_name', 'like', "%$value%")
                    ->orWhere('last_name', 'like', "%$value%")
                    ->orWhere('email', 'like', "%$value%")
                    ->orWhere('middle_name', 'like', "%$value%");
            });
        }

        return response()->json([
            'code' => 200,
            'users' => $query->get(),
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
                'code' => 422,
                'message' => 'Invalid Username and Password'
            ], 422);
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

    public function editUserbyID(Request $request, $id)
    {
        $user = User::find($id);

        $user->first_name = $request->input('first_name');
        $user->middle_name = $request->input('middle_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');

        $user->save();

        if ($user->save() == 'true') {
            return response()->json([
                'code' => 200,
                'message' => 'Updated successfully',
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'Error updating user',
            ]);
        }
    }

    public function loginUserChangePass(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'min:6',
            'confirmPassword' => 'required_with:password|same:password|min:6'
        ]);
        $user = User::findOrFail($id);

        $user->password = Hash::make($request->password);

        if ($user->save() == 'true') {
            return response()->json([
                'code' => 200,
                'message' => 'Password Updated Successfully!',
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Password Update Failed!',
            ]);
        }
    }

    public function getLoginUser()
    {
        return auth()->user();
    }
}
