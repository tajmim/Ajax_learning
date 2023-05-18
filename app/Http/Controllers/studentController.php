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

        // validation

        $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'age' => 'required',
            'class' => 'required',

        ]);

        // validation


        $student = new Student;
        $student->fName = $request->fName;
        $student->lName = $request->lName;
        $student->age = $request->age;
        $student->class = $request->class;
        $student->save();
        return response()->json(['success' => true]);

    }
    public function editdata($id){
        $edit_student = Student::find($id);
        return response()->json($edit_student);
    }

    public function editsubmit(Request $request){

        // validation

        $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'age' => 'required',
            'class' => 'required',

        ]);

        // validation


        $student = Student::find($request->id);
        $student->fName = $request->fName;
        $student->lName = $request->lName;
        $student->age = $request->age;
        $student->class = $request->class;
        $student->save();
        return response()->json(['success' => true]);

    }
    public function deletedata($id)
    {
        $deletedata = Student::find($id);
        $deletedata->delete();
        return response()->json(['success' => true]);
    }
}
