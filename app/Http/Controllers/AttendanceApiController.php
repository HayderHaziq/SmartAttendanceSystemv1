<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
        try {
            DB::beginTransaction();
    
            // Process the ndef data
            $ndefParts = explode(',', $validatedData['ndef_data']);
    
            if (count($ndefParts) == 2) {
                $studentId = $ndefParts[0];
                $classId = $ndefParts[1];
    
                // Check if both user ID and class ID exist in the database
                $userExists = Student::where('id', $studentId)->exists();
                $classExists = ClassModel::where('id', $classId)->exists();
    
                if ($userExists && $classExists) {
                    // Both user and class exist, proceed with creating a new attendance record
    
                    Attendance::create([
                        'student_id' => $studentId,
                        'time' => now()->toTimeString(),
                        'date' => now()->toDateString(),
                        'status' => 'Present',
                        'class_id' => $classId,
                    ]);
    
                    DB::commit();
    
                    return response()->json(['message' => 'Attendance marked successfully']);
                } else {
                    // Either user or class does not exist, reject the attendance record
                    return response()->json(['error' => 'Invalid user ID or class ID'], 400);
                }
            } else {
                return response()->json(['error' => 'Invalid NDEF data format'], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response()->json(['error' => 'An error occurred during the transaction'], 500);
        }
    }
}    