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

    
    /**
     * Handle the incoming NDEF data for attendance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function receiveAttendance(Request $request)
    {
        $validatedData = $request->validate([
            'ndef_data' => 'required|string',
        ]);

        //process the ndef data
        $ndefParts = explode(',', $validatedData['ndef_data']);

        if (count($ndefParts) == 2) {
            $studentId = $ndefParts[0];
            $eventId = $ndefParts[1];

            $attendance = Attendance::where('student_id', $studentId)
                ->where('date', now()->toDateString())
                ->first();

            if ($attendance) {
                $attendance->status = 'Present';
                $attendance->time = now()->toTimeString(); // Update the time
                $attendance->save();

                return response()->json(['message' => 'Attendance updated successfully']);
            } else {
                Attendance::create([
                    'student_id' => $studentId,
                    'time' => now()->toTimeString(),
                    'date' => now()->toDateString(),
                    'status' => 'Present',
                ]);

                return response()->json(['message' => 'Attendance marked successfully']);
            }
        } else {
            return response()->json(['error' => 'Invalid NDEF data format'], 400);
        }
    }
}

