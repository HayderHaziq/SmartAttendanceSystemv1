<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students;
use Carbon\Carbon;
use App\Models\classes;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('Admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function students()
    {
        $students = students::latest()->get();
        $classes = classes::select('classes.id AS classid','classes.*','users.*')
        ->leftJoin('users', 'classes.teacher', '=', 'users.id')
        ->get();



        return view('Admin.Students',compact('students','classes'));
    }

    public function classes()
    {
        $classes = classes::select('classes.id AS classid','classes.*','users.*')
        ->leftJoin('users', 'classes.teacher', '=', 'users.id')
        ->get();

        $teachers = User::where('role','Teacher')->get();

        return view('Admin.classlist',compact('classes','teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addstudent(Request $request)
    {
        $type = $request->input('type');
        $student_name = $request->input('student_name');
        $student_id = $request->input('student_id');
        $class_id = $request->input('class_id');
        $teachers = $request->input('teachers');

        //check unique
        $studentidcheck = students::where('student_id',$student_id)->count();

        if($type == 'C'){

        if($studentidcheck > 0){
            return redirect()->back()->with('error', 'The Student ID already Exist!');
        }
        else{
            $students = new students;
            $students->student_name = $student_name;
            $students->student_id = $student_id;
            $students->class_id = $class_id;
            $students->teachers = $teachers;
            $students->updated_at = Carbon::now();
            $students->save();

            return redirect()->back()->with('success', 'Student has been successfully added!');

        }
        }
        else{
        $id = $request->input('id');

        $getstudent = students::where('id',$id)->first();

        if($studentidcheck > 0 && $getstudent->student_id != $student_id){
            return redirect()->back()->with('error', 'The Student ID already Exist!');
        }
        else{
            $getstudent->student_name = $student_name;
            $getstudent->student_id = $student_id;
            $getstudent->class_id = $class_id;
            $getstudent->teachers = $teachers;
            $getstudent->updated_at = Carbon::now();
            $getstudent->save();

            return redirect()->back()->with('success', 'Student has been successfully updated!');

        }

        }
    }


    public function addclass(Request $request)
    {
        $type = $request->input('type');
        $class = $request->input('class');
        $teacher = $request->input('teacher');
        $subject = $request->input('subject');
        $time_in = $request->input('time_in');
        $time_out = $request->input('time_out');

        //check unique
        $classcheck = classes::where('class',$class)->count();

        if($type == 'C'){

        if($classcheck > 0){
            return redirect()->back()->with('error', 'The Class already Exist!');
        }
        else{
            $classes = new classes;
            $classes->class = $class;
            $classes->teacher = $teacher;
            $classes->subject = $subject;
            $classes->time_in = $time_in;
            $classes->time_out = $time_out;
            $classes->updated_at = Carbon::now();
            $classes->save();

            return redirect()->back()->with('success', 'Class has been successfully added!');

        }
        }
        else{
        $id = $request->input('id');

        $getclass = classes::where('id',$id)->first();

        if($classcheck > 0 && $getclass->class != $class){
            return redirect()->back()->with('error', 'The Class already Exist!');
        }
        else{
            $getclass->class = $class;
            $getclass->teacher = $teacher;
            $getclass->subject = $subject;
            $getclass->time_in = $time_in;
            $getclass->time_out = $time_out;
            $getclass->updated_at = Carbon::now();
            $getclass->save();

            return redirect()->back()->with('success', 'Class has been successfully updated!');

        }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletestudent($id)
    {
        students::where('id',$id)->delete();

        return redirect()->back()->with('success', 'Student has been successfully deleted!');
    }

    public function deleteclass($id)
    {
        classes::where('id',$id)->delete();

        return redirect()->back()->with('success', 'Class has been successfully deleted!');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showReports()
    {
        $students = students::latest()->get();
        
        $classes = classes::select('classes.id AS classid','classes.*','users.*')
            ->leftJoin('users', 'classes.teacher', '=', 'users.id')
            ->get();
    
        return view('Admin.reports', compact('students', 'classes'));
    }
}
