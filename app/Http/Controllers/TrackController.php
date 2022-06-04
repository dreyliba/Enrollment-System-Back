<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;

class TrackController extends Controller
{
    public function index()
    {
        $track = Track::all();
        return response()->json([
            'code' => 200,
            'tracks' => $track,
        ]);
    }

    public function getTrack($id)
    {
        $track = Track::findOrFail($id);
        return response()->json([
            'code' => 200,
            'track' => $track,
        ]);
    }

    public function addTrack(Request $request)
    {

        $addTrack = new Track;

        $addTrack->code = $request->code;
        $addTrack->name = $request->name;
        $addTrack->description = $request->description;

        $addTrack->save();

        if ($addTrack->save() == true) {
            return response()->json([
                'code' => 200,
                'message' => 'Track Added Successfully!'
            ]);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'Failed to Add Track!'
            ]);
        }
    }

    public function editTrackbyID(Request $request, $id)
    {
        $track = Track::find($id);

        $track->code = $request->input('code');
        $track->name = $request->input('name');
        $track->description = $request->input('description');

        $track->save();

        if ($track->save() == 'true') {
            return response()->json([
                'code' => 200,
                'message' => 'Updated successfully',
                'track' => $track,
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Error updating track',
            ]);
        }
    }

    public function deleteTrackbyID($id)
    {
        $track = Track::where('id', $id)->delete();

        if ($track == true) {
            return response()->json([
                'code' => 200,
                'message' => "Track Deleted Successfully!"
            ]);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'Failed to Delete Track!'
            ]);
        }
    }
}
