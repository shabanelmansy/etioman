<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CourseRequest;
use App\Course;
use Carbon\Carbon;
use App\User;
use Auth;
use Session;
use App\Invoice;
use DB;
 

class CoursesController extends Controller
{
    //

    public function index($value='')
    {
    	   $courses = Course::paginate(100);
    	
    	   return view('courses.index' , compact('courses'));
    }


    public function create()
    {
    	# code...
    	$lanquage =	config('config.lanquage');
    	$certificate = config('config.certificate');
    	$organization = config('config.organization');
    	$awarding_body = config('config.awardingbody');

    	return view('courses.create',compact('lanquage','certificate','organization','awarding_body'));

    }

    public function store(CourseRequest $request)
    {
    	
 
    	# code...
    	/*Session::put('lanquageC', $request->get('lanquage'));
    	Session::put('certificateC', $request->get('certificate'));
    	Session::put('organizationC', $request->get('organization'));
    	Session::put('awarding_bodyC', $request->get('awarding_body'));
    	*/

    	 

         $course = new Course($request->all());
         Auth::user()->courses()->save($course);

         
         $courseid = $course->id;
          
         $organization = $request->organization;
         
         if($organization=='group')
         {
            $invoice = new Invoice;

            $invoice->course_id = $courseid;
            $invoice->type = 'credit';
            $invoice->price = $request->fees;
            $invoice->save();
         }

         flash('Your Course has been created', 'success')->important();


         return redirect('/courses');
    }


    public function details($id='')
    {
        # code...
        $lanquage = config('config.lanquage');
        $certificate = config('config.certificate');
        $organization = config('config.organization');
        $awarding_body = config('config.awardingbody');


        $course = Course::find($id);
        return view('courses.details',compact('course','lanquage','certificate','organization','awarding_body'));
    }

    public function edit($id='')
    {
    	# code...
    	$lanquage =	config('config.lanquage');
    	$certificate = config('config.certificate');
    	$organization = config('config.organization');
    	$awarding_body = config('config.awardingbody');


    	$course = Course::find($id);
        return view('courses.edit',compact('course','lanquage','certificate','organization','awarding_body'));
    }


     public function update($id='' , CourseRequest $request)
    {
    	# code...
    	$course = Course::find($id);
        $course->update($request->all());
        flash('Your Course has been updated', 'success')->important();
        return redirect('/courses');
    }

    public function delete( $id )
	{	
		$course = Course::findOrFail($id);
    
		$course->delete();
		flash('Your Course has been deleted', 'success')->important();
        return redirect('/courses');
 

	}




}
