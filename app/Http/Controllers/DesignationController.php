<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    public function getDesignations()
    {
        $designations = Designation::all();

        return response()->json([
            "designations" => $designations
        ]);
    }

    public function deleteDesignation($id)
    {
        $designation = Designation::where('id', $id);

        $designation->delete();

        return response()->json([
            "Message" => "Designation Deleted Successfully"
        ]);
    }
    public function updateDesignation(Request $req, $id)
    {
        $validator=Validator::make($req->all(), [

            'designation_name' =>'required|unique:designations',

            'designation_short_details' =>'required',

        ]);
        $designation = Designation::find($id);
        $designation->designation_name=$req->designation_name;
        $designation->designation_short_details=$req->designation_short_details;
        $designation->save();

        return response()->json([
            "Message" => "Designation Updated Successfully",
        ]);
    }
    public function addDesignation(Request $req)
    {
        $validator=Validator::make($req->all(), [

            'designation_name' =>'required|unique:designations',

            'designation_short_details' =>'required',

        ]);
        if($validator->fails()){
           
            return response()->json([
                "Message" => $validator->errors(),
                "MessageColor"=>"text-danger"
            ]);
        }
        Designation::create($req->post());

        return response()->json([
            "Message" => "Designation Added Successfully",
            "MessageColor"=>"text-success"
        ]);
    }
}
