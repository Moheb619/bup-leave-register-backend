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

        response()->json([
            "Message" => "Department Deleted Successfully"
        ]);
    }
    public function updateDepartment(Request $req, $id)
    {
        $department = Department::where('id', $id);
        $department->department_details=$req->department_name
        $department->save();

        response()->json([
            "Message" => "Department Updated Successfully"
        ]);
    }
}
