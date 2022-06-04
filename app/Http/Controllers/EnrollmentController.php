<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnrollmentResource;
use App\Models\Strand;
use App\Models\Track;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        return EnrollmentResource::collection(Enrollment::paginate());
    }

    public function editStudentnyID(Request $request, $id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment = tap($enrollment)->update($request->all());

            Log::info('Student information has been updated by ' . auth()->user()->full_name . ' -- at ' . Carbon::now()->format('Y-m-d h:i:s'));

            return response()->json([
                'code' => 200,
                'message' => 'Updated successfully',
                'student' => new EnrollmentResource($enrollment),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $params = $request->all();
            $params['user_id'] = auth()->user()->id;

            $enrollment = Enrollment::create($params);

            return response()->json([
                'code' => 200,
                'message' => 'Created successfully',
                'student' => new EnrollmentResource($enrollment),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment->delete();

            Log::info('Student information with ' . $id . ' has been delete by ' . auth()->user()->full_name . ' -- at ' . Carbon::now()->format('Y-m-d h:i:s'));

            return response()->json([
                'code' => 200,
                'message' => "Student Deleted Successfully!"
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => 'Failed to Delete Student!'
            ], 500);
        }
    }

    public function options()
    {
        return response()->json([
            'tracks' => Track::all(),
            'strands' => Strand::all(),
        ]);
    }
}
