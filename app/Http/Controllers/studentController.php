<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function student_data()
    {
        $data = Student::orderBy('id','desc')->get();
        return response()->json($data);
        
    }
    public function addstudent(Request $request){
        $student = new Student;
        $student->fName = $request->fName;
        $student->lName = $request->lName;
        $student->age = $request->age;
        $student->class = $request->class;
        $student->save();
        return response()->json(['success' => true]);

    }
}
