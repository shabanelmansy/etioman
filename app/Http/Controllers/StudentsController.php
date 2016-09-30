<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StudentRequest;
use App\Student;
use Carbon\Carbon;
use App\User;
use Auth;
use Session;
use App\Course;
 


class StudentsController extends Controller
{
    //
    public function index($course_id=0)
    {
    	   
    	   $students = Course::findOrFail($course_id)->students()->paginate(100);
    	
    	   return view('students.index' , compact('students','course_id'));
    }


    public function create($course_id=0)
    {
    	# code...
    	$gender =	config('config.gender');
        $course = Course::findOrFail($course_id);
        $last_id = Student::orderBy('id', 'desc')->first()->id;

        
        if($course->awarding_body =='local'){
            $student_id = '2016'.$last_id;
        }else{
            $student_id = 0;
        }

         
    	$certificate_no = Carbon::now()->year.str_pad($last_id, 3, '0', STR_PAD_LEFT);

    	return view('students.create',compact('gender','course_id','student_id','course','certificate_no'));

    }

    public function store(StudentRequest $request)
    {
    	
 

    	 $student = new Student($request->all());
         $course_id = $request->input('course_id');
         Auth::user()->students()->save($student);
         flash('Your Student has been created', 'success')->important();
         return redirect()->route('students.index', ['course_id' => $course_id]);
    }


    public function details($course_id=0,$id=0)
    {
        
        $gender =   config('config.gender');


        $student = Student::find($id);
        return view('courses.details',compact('course','lanquage','certificate','organization','awarding_body'));
    }

    public function edit($course_id=0,$id=0)
    {
    	
        # code...
        $gender =   config('config.gender');
        $course = Course::findOrFail($course_id);
       
        $student_id = -1;
        $certificate_no = -1;
        $student = Student::findOrFail($id);
     
        return view('students.edit',compact('student','gender','course_id','student_id','course','certificate_no'));
    }


     public function update($id='' , StudentRequest $request)
    {
    	# code...
    	$student = Student::find($id);
        $student->update($request->all());
        $course_id = $request->input('course_id');
        flash('Your Student has been updated', 'success')->important();
        return redirect()->route('students.index', ['course_id' => $course_id]);
    }

    public function delete($course_id=0,$id=0)
	{	
		$student = Student::findOrFail($id);
        $student->delete();
		flash('Your Student has been deleted', 'success')->important();
        return redirect()->route('students.index', ['course_id' => $course_id]);
 

	}

}
