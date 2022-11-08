<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_number' => 'required|unique:App\Models\User',
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'email' => 'required|email|unique:App\Models\User',
            'contact' => 'required|unique:App\Models\User',
            'profile' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'department_id' => 'required',
            'designation_id' => 'required',
            'user_name' => 'required|unique:App\Models\User',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $profile_image_path = $request->file('profile')->store('profile_image', 'public');

        $input = $request->all();
        $input["profile"] = $profile_image_path;
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('BUPLEAVEREGISTERBYMOHEB')->plainTextToken;
        $success['full_name'] =  $user->first_name . " " . $user->last_name;

        return response()->json([
            "success" => "User Registered Successfully",
            "message" => $success
        ]);
    }

    // Login
    public function login(Request $request)
    {
        if (Auth::attempt(['user_name' => $request->user_name, 'password' => $request->password])) {
            $user = Auth::user();
            $success['full_name'] =  $user->name;
            $success['token'] =  $user->createToken('BUPLEAVEREGISTERBYMOHEB')->plainTextToken;

            return response()->json([
                "status" => "User Logged In",
                "message" => $success
            ], 200);
        } else {
            return "Unauthorized";
        }
    }



    public function all_user()
    {
        $user = User::all();
        return response()->json([
            'user' => $user,
        ]);
    }
    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            return response()->json([
                "message" => "User Deleted Successfully",
                "user" => $user
            ], 200);
        } else {
            return "Delete Failed";
        }
    }

    public function department_user()
    {
        $user = Department::find(1)->users;

        return response()->json([
            'user' => $user,
        ], 200);
    }
    public function designation_user()
    {
        $user = Designation::find(1)->users;

        return response()->json([
            'user' => $user,
        ], 200);
    }
}
