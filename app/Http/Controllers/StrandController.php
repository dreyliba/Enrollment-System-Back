<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Strand;

class StrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Strand::query();

        if ($request->track_id) {
            $query->where('track_id', $request->track_id);
        }

        return response()->json([
            'code' => 200,
            'strands' => $query->get(),
        ]);
    }

    public function addStrand(Request $request)
    {

        $addStrand = new Strand;

        $addStrand->name = $request->name;
        $addStrand->description = $request->description;
        $addStrand->track_id = $request->track_id;

        $addStrand->save();

        if ($addStrand->save() == true) {
            return response()->json([
                'code' => 200,
                'message' => 'Strand Added Successfully!'
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Failed to Add Strand!'
            ]);
        }
    }

    public function editStrandbyID(Request $request, $id)
    {
        $strand = Strand::find($id);

        $strand->name = $request->input('name');
        $strand->description = $request->input('description');

        $strand->save();

        if ($strand->save() == 'true') {
            return response()->json([
                'code' => 200,
                'message' => 'Updated successfully',
                'strand' => $strand,
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Error updating strand',
            ]);
        }
    }

    public function deleteStrandbyID($id)
    {
        $strand = Strand::where('id', $id)->delete();

        if ($strand == true) {
            return response()->json([
                'code' => 200,
                'message' => "Strand Deleted Successfully!"
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Failed to Delete Strand!'
            ]);
        }
    }
}
