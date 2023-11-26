<?php

//PATH = C:\laragon\www\SmartAttendanceSystemv1\app\Http\Controllers\AttendanceController.php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Get all attendance records for the specified student.
     *
     * @param  int  $studentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAttendance($studentId)
    {
        // Example logic to fetch all attendance records based on $studentId
        $attendance = Attendance::where('student_id', $studentId)->get();

        if ($attendance->isNotEmpty()) {
            // If attendance data is found, return it as JSON
            return response()->json(['data' => $attendance]);
        } else {
            // If no attendance data is found, return a 404 response
            return response()->json(['error' => 'Attendance data not found.'], 404);
        }
    }

    /**
     * Update the attendance status for the specified student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $studentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'status' => 'required|in:Present,Absent', // Adjust validation rules as needed
        ]);

        // Find the attendance record for the specified ID
        $attendance = Attendance::find($id);

        if ($attendance) {
            // Update the attendance status
            $attendance->status = $validatedData['status'];
            $attendance->save();

            // Additional logic...

            return response()->json(['message' => 'Status updated successfully']);
        } else {
            // If no attendance data is found, return a 404 response
            return response()->json(['error' => 'Attendance data not found.'], 404);
        }
    }
}

