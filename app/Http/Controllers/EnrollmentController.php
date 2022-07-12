<?php

namespace App\Http\Controllers;

use App\DisabilityCategory;
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
        $limit = 15;

        if (!empty($request->limit)) {
            $limit = $request->limit;
        }

        $query = Enrollment::query();

        if (!empty($request->search)) {
            $query->where(function ($query) use ($request) {
                $value = $request->search;

                $query->where('first_name', 'like', "%$value%")
                    ->orWhere('last_name', 'like', "%$value%")
                    ->orWhere('middle_name', 'like', "%$value%");
            });
        }

        if (!empty($request->date_from)) {
            $query->where('enrolled_date', '>=', $request->date_from);
        }

        if (!empty($request->date_to)) {
            $query->where('enrolled_date', '<=', $request->date_to);
        }

        if (!empty($request->school_year)) {
            $query->where('school_year', $request->school_year);
        }

        if (!empty($request->semester)) {
            $query->where('semester', $request->semester);
        }

        if (!empty($request->level)) {
            $query->where('grade_level_to_enroll', $request->level);
        }

        if (!empty($request->track_id)) {
            $query->where('track_id', $request->track_id);
        }

        if (!empty($request->strand_id)) {
            $query->where('strand_id', $request->strand_id);
        }

        return EnrollmentResource::collection($query->orderBy('id', 'desc')->paginate($limit));
    }

    public function show($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return new EnrollmentResource($enrollment);
    }

    public function editStudentnyID(UpdateEnrollmentRequest $request, $id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);

            $params = $request->all();

            $params['household_member'] = $this->getArrayValue($request->household_member);
            $params['available_device'] = $this->getArrayValue($request->available_device);
            $params['internet_connection'] = $this->getArrayValue($request->internet_connection);
            $params['distance_learning'] = $this->getArrayValue($request->distance_learning);
            $params['learning_challenges'] = $this->getArrayValue($request->learning_challenges);

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

            $params['household_member'] = $this->getArrayValue($request->household_member);
            $params['available_device'] = $this->getArrayValue($request->available_device);
            $params['internet_connection'] = $this->getArrayValue($request->internet_connection);
            $params['distance_learning'] = $this->getArrayValue($request->distance_learning);
            $params['learning_challenges'] = $this->getArrayValue($request->learning_challenges);

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
            'disability_categories' => DisabilityCategory::all(),
        ]);
    }
}
