<?php

//PATH = C:\laragon\www\SmartAttendanceSystemv1\app\Http\Controllers\AttendanceController.php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * 
     *
     * @param  int  $studentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAttendance($studentId)
    {
        $attendance = Attendance::where('student_id', $studentId)->get();

        if ($attendance->isNotEmpty()) {
            return response()->json(['data' => $attendance]);
        } else {
            return response()->json(['error' => 'Attendance data not found.'], 404);
        }
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $studentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:Present,Absent',
        ]);

        $attendance = Attendance::find($id);

        if ($attendance) {
            $attendance->status = $validatedData['status'];
            $attendance->save();

            return response()->json(['message' => 'Status updated successfully']);
        } else {
            return response()->json(['error' => 'Attendance data not found.'], 404);
        }
    }
}

