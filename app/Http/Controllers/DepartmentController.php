<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

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
        $req->validate([
            'department_name' => 'required',
            'department_short_details' => 'required',
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
        $req->validate([
            'department_name' => 'required',
            'department_short_details' => 'required',
        ]);
        Department::create($req->post());

        return response()->json([
            "Message" => "Department Added Successfully",
        ]);
    }
}
