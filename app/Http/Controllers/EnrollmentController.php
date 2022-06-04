<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
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

    public function editStudentnyID(UpdateEnrollmentRequest $request, $id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);

            $params = $request->all();

            if (is_array($request->household_member)) {
                $params['household_member'] = implode(",", $request->household_member);
            }

            if (is_array($request->available_device)) {
                $params['available_device'] = implode(",", $request->available_device);
            }

            if (is_array($request->internet_connection)) {
                $params['internet_connection'] = implode(",", $request->internet_connection);
            }

            if (is_array($request->distance_learning)) {
                $params['distance_learning'] = implode(",", $request->distance_learning);
            }

            if (is_array($request->learning_challenges)) {
                $params['learning_challenges'] = implode(",", $request->learning_challenges);
            }

            if (is_array($request->limited_face_to_face)) {
                $params['limited_face_to_face'] = implode(",", $request->limited_face_to_face);
            }

            $enrollment = tap($enrollment)->update($params);

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

    public function store(CreateEnrollmentRequest $request)
    {
        try {
            $params = $request->all();
            $params['user_id'] = auth()->user()->id;

            if (is_array($request->household_member)) {
                $params['household_member'] = implode(",", $request->household_member);
            }

            if (is_array($request->available_device)) {
                $params['available_device'] = implode(",", $request->available_device);
            }

            if (is_array($request->internet_connection)) {
                $params['internet_connection'] = implode(",", $request->internet_connection);
            }

            if (is_array($request->distance_learning)) {
                $params['distance_learning'] = implode(",", $request->distance_learning);
            }

            if (is_array($request->learning_challenges)) {
                $params['learning_challenges'] = implode(",", $request->learning_challenges);
            }

            if (is_array($request->limited_face_to_face)) {
                $params['limited_face_to_face'] = implode(",", $request->limited_face_to_face);
            }

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
