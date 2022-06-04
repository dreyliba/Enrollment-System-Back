<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Exception;

class EnrollmentController extends Controller
{
    public function editStudentnyID(Request $request, $id)
    {
        try {
            $enrollment = Enrollment::findOrFail($id);
            $enrollment = tap($enrollment)->update($request->all());

            return response()->json([
                'code' => 200,
                'message' => 'Updated successfully',
                'student' => $enrollment,
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
            $enrollment = Enrollment::create($request->all());

            return response()->json([
                'code' => 200,
                'message' => 'Created successfully',
                'student' => $enrollment,
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
        $enrollment = Enrollment::findOrFail($id);

        if ($enrollment == true) {
            return response()->json([
                'code' => 200,
                'message' => "Student Deleted Successfully!"
            ]);
        } else {
            return response()->json([
                'code' => 401,
                'message' => 'Failed to Delete Student!'
            ]);
        }
    }
}
