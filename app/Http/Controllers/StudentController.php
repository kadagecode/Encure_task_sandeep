<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students=Student::all();


      return view('index' , compact('students'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

       return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //



        $student = new Student();
        $student->full_name = $request->input('full_name');
        $student->email = $request->input('email');
        $student->password = $request->input('password');
        $student->state = $request->input('state');
        $student->city = $request->input('city');
        $student->branch = $request->input('branch');
        $student->gender = $request->input('gender');
        $student->save();


        $studentdata=Student::all();

        return response()->json([
            'student' => $studentdata
        ]);
    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $student = Student::findOrFail($id);
        return view('edit' , compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

       // dd($request);
        //
        $student = Student::findOrFail($id);

        $student->update([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'branch' => $request->input('branch'),
            'gender' => $request->input('gender'),
        ]);

        
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index');
        //
    }

    public function deleteMultiple(Request $request)
    {
        $selectedStudents = $request->input('selectedStudents');

        if (!empty($selectedStudents)) {
            Student::whereIn('id', $selectedStudents)->delete();
            return response()->json(['success' => true, 'message' => 'Selected students deleted successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'No students selected for deletion.'], 400);
    }
}
