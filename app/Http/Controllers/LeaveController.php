<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{
    public function getLeaves()
    {
        $leaves = Leave::all();

        return response()->json([
            "leaves" => $leaves
        ]);
    }

    public function deleteLeave($id)
    {
        $leave = Leave::where('id', $id);

        $leave->delete();

        return response()->json([
            "Message" => "Leave Deleted Successfully"
        ]);
    }
    public function updateLeave(Request $req, $id)
    {
        $validator=Validator::make($req->all(), [
            'leave_name' => 'required|unique:leaves',
            'leave_description' => 'required',
            'number_of_days_allowed' => 'required',

        ]);
        $leave = Leave::find($id);
        $leave->leave_name = $req->leave_name;
        $leave->leave_description = $req->leave_description;
        $leave->number_of_days_allowed = $req->number_of_days_allowed;
        $leave->save();

        return response()->json([
            "Message" => "Leave Updated Successfully",
        ]);
    }
    public function addLeave(Request $req)
    {
        $validator=Validator::make($req->all(), [
            'leave_name' => 'required|unique:leaves',
            'leave_description' => 'required',
            'number_of_days_allowed' => 'required',

        ]);
        if($validator->fails()){
           
            return response()->json([
                "Message" => $validator->errors(),
                "MessageColor"=>"text-danger"
            ]);
        }
        Leave::create($req->post());

        return response()->json([
            "Message" => "Leave Added Successfully",
            "MessageColor"=>"text-success"
        ]);
    }
}
