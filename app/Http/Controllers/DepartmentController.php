<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function getDepartments()
    {
        $departments = Department::all();

        return response()->json([
            "departments" => $departments
        ]);
    }

    public function deleteDepartment($id)
    {
        $department = Department::where('id', $id);

        $department->delete();

        return response()->json([
            "Message" => "Department Deleted Successfully"
        ]);
    }
    public function updateDepartment(Request $req, $id)
    {
        $validator=Validator::make($req->all(), [

            'department_name' =>'required|unique:departments',

            'department_short_details' =>'required',

        ]);
        $department = Department::find($id);
        $department->department_name=$req->department_name;
        $department->department_short_details=$req->department_short_details;
        $department->save();

        return response()->json([
            "Message" => "Department Updated Successfully",
        ]);
    }
    public function addDepartment(Request $req)
    {
        $validator=Validator::make($req->all(), [

            'department_name' =>'required|unique:departments',

            'department_short_details' =>'required',

        ]);
        if($validator->fails()){
           
            return response()->json([
                "Message" => $validator->errors(),
                "MessageColor"=>"text-danger"
            ]);
        }
        Department::create($req->post());

        return response()->json([
            "Message" => "Department Added Successfully",
            "MessageColor"=>"text-success"
        ]);
    }
}
