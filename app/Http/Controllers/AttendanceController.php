<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Get the attendance data for the specified student.
     *
     * @param  int  $studentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAttendance($studentId)
    {
        // Example logic to fetch attendance data based on $studentId
        $attendance = Attendance::where('student_id', $studentId)->first();

        if ($attendance) {
            // If attendance data is found, return it as JSON
            return response()->json(['attendance' => $attendance]);
        } else {
            // If no attendance data is found, return a 404 response
            return response()->json(['error' => 'Attendance data not found.']);
        }
    }

    /**
     * Update the attendance status for the specified student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $studentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $studentId)
    {
        // Validate the request data as needed

        // Find the attendance record for the specified student
        $attendance = Attendance::where('student_id', $studentId)->first();

        if ($attendance) {
            // Update the attendance status
            $attendance->status = $request->status;
            $attendance->save();

            // Additional logic...

            return response()->json(['message' => 'Status updated successfully']);
        } else {
            // If no attendance data is found, return a 404 response
            return response()->json(['error' => 'Attendance data not found.']);
        }
    }
}
