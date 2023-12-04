<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\students;
use Carbon\Carbon;
use App\Models\classes;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Teacher.index');
    }

    public function students()
    {
        $students = students::leftJoin('classes', 'students.class_id', '=', 'classes.id')
            ->where('classes.teacher', auth()->user()->id)
            ->get();
    
        $justIds = students::pluck('id')->toArray();
    
        $classes = classes::select('classes.id AS classid', 'classes.*', 'users.*')
            ->leftJoin('users', 'classes.teacher', '=', 'users.id')
            ->get();
    
        return view('Teacher.Students', compact('students', 'classes', 'justIds'));
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatereports()
    {
        return view('Teacher.reports');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function printAttendanceReport(\Illuminate\Http\Request $request)
    {
       
     
        $htmlContent = '
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                h1 {
                    color: #333;
                    text-align:center;
                }
                .content {
           
                    padding: 20px;
                    margin: 20px 0;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                table, th, td {
                    border: 1px solid #333;
                    padding: 8px;
                    text-align: left;
                }
                .page-break {
                    page-break-after: always;
                }
            </style>
        ';

        $htmlContent .= "
        <center><h1>REPORT STUDENT ATTENDANCE</h1></center>

        <b>Teacher Name:</b> <br><br>
        <b>Subject:</b> <br><br>
        <b>Class:</b> <br><br>
        <b>Weeks:</b> <br><br>


        <b>Attendance Report<br>

         <div class='content'>
         

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Student Name</th>
                    <th>Student Id</th>
                    <th>Class</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <tr>
            <td>1</td>
            <td>Student 1</td>
            <td>ABC 123</td>
            <td>SET2</td>
            <td>2/2/2023</td>
            <td>Attend</td>
            </tr>
            <tr>
            <td>2</td>
            <td>Student 2</td>
            <td>ABC 123</td>
            <td>SET3</td>
            <td>3/2/2023</td>
            <td>Attend</td>
            </tr>

            </tbody>
        </table>


    </div>



";
        $htmlContent = "<div style='padding: 20px;'>{$htmlContent}</div>";


        
        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'arial narrow',
            'format' => 'A4-P',
            'margin_top' => 0,
            'setAutoBottomMargin' => 'pad'
        ]);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->keep_table_proportions = true;
        $mpdf->SetDisplayMode('fullwidth');
        $mpdf->SetProtection(array('print'));

        $mpdf->SetTitle('AttendanceReport');

        $mpdf->WriteHTML($htmlContent);
        $mpdf->SetHTMLFooter('
        <b>Teacher Signature,</b> <br><br><br><br><br><br>


        <b>Date :</b>');
        $mpdf->Output('example.pdf', 'I');
    
    }

}
