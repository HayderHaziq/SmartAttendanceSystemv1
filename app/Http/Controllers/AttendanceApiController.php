<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\students;
use App\Models\CardReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceApiController extends Controller
{
    /**
     * 
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

            $ndefParts = explode(',', $validatedData['ndef_data']);

            if (count($ndefParts) == 2) {
                $studentId = $ndefParts[0];
                $readerId = $ndefParts[1];

                $userExists = students::where('id', $studentId)->exists();

                $cardReader = CardReader::where('reader_id', $readerId)->first();

                if ($userExists && $cardReader) {

                    Attendance::create([
                        'student_id' => $studentId,
                        'time' => now()->toTimeString(),
                        'date' => now()->toDateString(),
                        'status' => 'Present',
                        'class_id' => $cardReader->class_id,
                    ]);

                    DB::commit();

                    return response()->json(['message' => 'Attendance marked successfully']);
                } else {
                    return response()->json(['error' => 'Invalid user ID or reader ID'], 400);
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
