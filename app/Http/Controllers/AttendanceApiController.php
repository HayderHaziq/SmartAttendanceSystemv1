<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceApiController extends Controller
{
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

        // Process the ndef data
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
