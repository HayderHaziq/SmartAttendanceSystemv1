<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use App\Models\classes;

class CheckAbsentStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:absent-students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Get classes that have ended
        $endedClasses = classes::where('time_out', '<', now())->get();
    
        foreach ($endedClasses as $class) {
            // Get students enrolled in the class
            $students = $class->students;
    
            // Check if $students is not null before iterating
            if (!is_null($students)) {
                foreach ($students as $student) {
                    // Check if there's no attendance record for today
                    if (!$this->hasAttendanceToday($student, $class)) {
                        // Create absent attendance record
                        Attendance::create([
                            'student_id' => $student->id,
                            'time' => now()->toTimeString(),
                            'date' => now()->toDateString(),
                            'status' => 'Absent',
                            'class_id' => $class->id,
                        ]);
                    }
                }
            }
        }
    
        $this->info('Absent students checked successfully.');
    }
    
    private function hasAttendanceToday($student, $class)
    {
        return Attendance::where([
            'student_id' => $student->id,
            'class_id' => $class->id,
            'date' => now()->toDateString(),
        ])->exists();
    }
}
