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
            'id' => 'required|unique:App\Models\User',
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'email' => 'required|email|unique:App\Models\User',
            'contact' => 'required|unique:App\Models\User',
            'profile' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'user_name' => 'required|unique:App\Models\User',
            'password' => 'required'
        ]);
        $department=Department::where('department_name', '=', $request->department_id)->firstOrFail();
        $designation=Designation::where('designation_name', '=', $request->designation_id)->firstOrFail();
        $department_id=$department->id;
        $designation_id=$designation->id;
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $profile_image_path = $request->file('profile')->store('profile_image', 'public');

        $input = $request->all();
        $input['department_id']=$department_id;
        $input['designation_id']=$designation_id;
        $input['profile'] = $profile_image_path;
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('BUPLEAVEREGISTERBYMOHEB')->plainTextToken;
        $success['full_name'] =  $user->first_name . " " . $user->last_name;
        return response()->json([
            "Message" => "User Registered Successfully",
            "success" => $success
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



    public function getUsers()
    {
        $user = User::all();
        return response()->json([
            'user' => $user,
        ]);
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            return response()->json([
                "message" => "User Deleted Successfully",
            ], 200);
        } else {
            return response()->json([
                "message" => "Deletation Failed",
            ], 200);
        }
    }
    public function updateUser(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'id' => 'required|unique:App\Models\User',
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'age' => 'required',
            'email' => 'required|email|unique:App\Models\User',
            'contact' => 'required|unique:App\Models\User',
            'profile' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'user_name' => 'required|unique:App\Models\User',
            'password' => 'required'
        ]);
        $user = User::find($id);
        $user->id = $req->id;
        $user->gender = $req->gender;
        $user->first_name = $req->first_name;
        $user->last_name = $req->last_name;
        $user->age = $req->age;
        $user->email = $req->email;
        $user->contact = $req->contact;
        $user->profile = $req->profile;
        $user->department_id = $req->department_id;
        $user->designation_id = $req->designation_id;
        $user->user_name = $req->user_name;
        $user->password = $req->password;
        $user->save();

        return response()->json([
            "Message" => "Leave Updated Successfully",
        ]);
    }
}
