<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnrollmentResource;
use App\Models\Enrollment;
use App\Models\Strand;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function enrollmentReports(Request $request)
    {
        $query = Enrollment::query();

        if (!empty($request->search)) {
            $query->where(function ($query) use ($request) {
                $value = $request->search;

                $query->where('first_name', 'like', "%$value%")
                    ->orWhere('last_name', 'like', "%$value%")
                    ->orWhere('middle_name', 'like', "%$value%");
            });
        }

        if (!empty($request->level)) {
            $query->where('grade_level_to_enroll', $request->level);
        }

        if (!empty($request->school_year)) {
            $query->where('school_year', $request->school_year);
        }

        if (!empty($request->semester)) {
            $query->where('semester', $request->semester);
        }

        if (!empty($request->track_id)) {
            $query->where('track_id', $request->track_id);
        }

        if (!empty($request->strand_id)) {
            $query->where('strand_id', $request->strand_id);
        }

        if (!empty($request->date_from)) {
            $query->where('enrolled_date', '>=', $request->date_from);
        }

        if (!empty($request->date_to)) {
            $query->where('enrolled_date', '<=', $request->date_to);
        }

        return EnrollmentResource::collection($query->get());
    }

    public function getDailyReport(Request $request)
    {
        $query = Enrollment::query();

        if (!empty($request->level)) {
            $query->where('grade_level_to_enroll', $request->level);
        }

        if (!empty($request->school_year)) {
            $query->where('school_year', $request->school_year);
        }

        if (!empty($request->semester)) {
            $query->where('semester', $request->semester);
        }

        if (!empty($request->date_from)) {
            $query->where('enrolled_date', '>=', $request->date_from);
        }

        if (!empty($request->date_to)) {
            $query->where('enrolled_date', '<=', $request->date_to);
        }

        return EnrollmentResource::collection($query->get());
    }

    public function options()
    {
        return response()->json([
            'strands' => Strand::all(),
        ]);
    }
}
