

{{ Form::hidden('course_id',$course_id) }}

<div class="form-group col-lg-3" {{ $errors->first('student_id' ,'has-error') }}>
<label>Student Id</label>
{!! Form::text('student_id' ,(!empty($student) ? $student->student_id :(($student_id==0) ? null : $student_id)),['id'=>'student_id','required'=>'required','class'=>'form-control',($student_id==0) ? '' : 'readonly' ]) !!}
{!! $errors->first('student_id' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="form-group col-lg-3" {{ $errors->first('certificate_no' ,'has-error') }}>
<label>Certificate No</label>

{!! Form::text('certificate_no' ,(!empty($student)? $student->certificate_no : $certificate_no),['id'=>'certificate_no','required'=>'required','class'=>'form-control','readonly']) !!}
{!! $errors->first('certificate_no' ,'<div class="label label-danger">:message</div>') !!}
</div>



<div class="form-group col-lg-3" {{ $errors->first('mobile' ,'has-error') }}>
<label>Mobile</label>
{!! Form::text('mobile' ,null,['id'=>'mobile','class'=>'form-control','readonly']) !!}
{!! $errors->first('mobile' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="clearfix"></div>
<div class="form-group col-lg-6" {{ $errors->first('name_en' ,'has-error') }}>
<label>English Name</label>
{!! Form::text('name_en' ,null,['id'=>'name_en','required'=>'required','class'=>'form-control','readonly']) !!}
{!! $errors->first('name_en' ,'<div class="label label-danger">:message</div>') !!}
</div>
<div class="clearfix"></div>


<div class="clearfix"></div>
<div class="form-group col-lg-6" {{ $errors->first('name_ar' ,'has-error') }}>
<label>Arabic Name</label>
{!! Form::text('name_ar' ,null,['id'=>'name_ar','required'=>'required','class'=>'form-control','readonly']) !!}
{!! $errors->first('name_ar' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="clearfix"></div>


<div class="form-group col-lg-3" {{ $errors->first('contact' ,'has-error') }}>
<label>Contact</label>
{!! Form::text('contact' ,null,['id'=>'contact','class'=>'form-control','readonly']) !!}
{!! $errors->first('contact' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-3" {{ $errors->first('email' ,'has-error') }}>
<label>email</label>
{!! Form::text('email' ,null,['id'=>'email','class'=>'form-control','readonly']) !!}
{!! $errors->first('email' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-6">
        {!! Form::label('Gender','Gender:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;') !!}
        
            @foreach ($gender as $key=>$value)
                {{ Form::radio('gender', $key, (!empty($student) ? null : ($key==session('gender', 'male') ? true : false)),array('disabled')) }} {{ $value }}
       
            @endforeach
 
        
</div>



@if($course->organization=='individual')
<div class="clearfix"></div>
<div class="form-group col-lg-6" {{ $errors->first('organaization' ,'has-error') }}>
<label>Organaization</label>
{!! Form::text('organaization' ,null,['id'=>'organaization','class'=>'form-control','readonly']) !!}
{!! $errors->first('organaization' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="form-group col-lg-6" {{ $errors->first('fee' ,'has-error') }}>
<label>Fee</label>
{!! Form::text('fee' ,null,['id'=>'fee','class'=>'form-control','readonly']) !!}
{!! $errors->first('fee' ,'<div clasfees="label label-danger">:message</div>') !!}
</div>
@endif


@if($course->certificate=='ministry')
<div class="clearfix"></div>
<div class="form-group col-lg-6" {{ $errors->first('level' ,'has-error') }}>
<label>Level</label>
{!! Form::text('level' ,null,['id'=>'level','class'=>'form-control','readonly']) !!}
{!! $errors->first('level' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="form-group col-lg-6" {{ $errors->first('mark' ,'has-error') }}>
<label>Mark</label>
{!! Form::text('mark' ,null,['id'=>'mark','class'=>'form-control','readonly']) !!}
{!! $errors->first('mark' ,'<div class="label label-danger">:message</div>') !!}
</div>
@endif

<div class="clearfix"></div>
<div class="form-group col-lg-4" {{ $errors->first('cips_member_id' ,'has-error') }}>
<label>Member Id</label>
{!! Form::text('cips_member_id' ,null,['id'=>'cips_member_id','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_member_id' ,'<div class="label label-danger">:message</div>') !!}
</div>



<div class="form-group col-lg-4" {{ $errors->first('cips_valed_to' ,'has-error') }}>
<label>Valed To</label>
{!! Form::text('cips_valed_to' ,null,['id'=>'cips_valed_to','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_valed_to' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-4" {{ $errors->first('cips_password' ,'has-error') }}>
<label>Password</label>
{!! Form::text('cips_password' ,null,['id'=>'cips_password','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_password' ,'<div class="label label-danger">:message</div>') !!}
</div>

@if($course->awarding_body=='cips')
<div class="clearfix"></div>
<div class="form-group col-lg-2" {{ $errors->first('cips_u1_exam_date' ,'has-error') }}>
<label>U1 ( Exam Date )</label>
{!! Form::text('cips_u1_exam_date' ,null,['id'=>'cips_u1_exam_date','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u1_exam_date' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="form-group col-lg-2" {{ $errors->first('cips_u1_exam_result' ,'has-error') }}>
<label>U1 ( Exam Result )</label>
{!! Form::text('cips_u1_exam_result' ,null,['id'=>'cips_u1_exam_result','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u1_exam_result' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-2" {{ $errors->first('cips_u2_exam_date' ,'has-error') }}>
<label>U2 ( Exam Date )</label>
{!! Form::text('cips_u2_exam_date' ,null,['id'=>'cips_u2_exam_date','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u2_exam_date' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-2" {{ $errors->first('cips_u2_exam_result' ,'has-error') }}>
<label>U2 ( Exam Result )</label>
{!! Form::text('cips_u2_exam_result' ,null,['id'=>'cips_u2_exam_result','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u2_exam_result' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="form-group col-lg-2" {{ $errors->first('cips_u3_exam_date' ,'has-error') }}>
<label>U3 ( Exam Date )</label>
{!! Form::text('cips_u3_exam_date' ,null,['id'=>'cips_u3_exam_date','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u3_exam_date' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-2" {{ $errors->first('cips_u3_exam_result' ,'has-error') }}>
<label>U3 ( Exam Result )</label>
{!! Form::text('cips_u3_exam_result' ,null,['id'=>'cips_u3_exam_result','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u3_exam_result' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="clearfix"></div>


<div class="form-group col-lg-3" {{ $errors->first('cips_u4_exam_date' ,'has-error') }}>
<label>U4 ( Exam Date )</label>
{!! Form::text('cips_u4_exam_date' ,null,['id'=>'cips_u4_exam_date','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u4_exam_date' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-3" {{ $errors->first('cips_u4_exam_result' ,'has-error') }}>
<label>U4 ( Exam Result )</label>
{!! Form::text('cips_u4_exam_result' ,null,['id'=>'cips_u4_exam_result','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u4_exam_result' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-3" {{ $errors->first('cips_u5_exam_date' ,'has-error') }}>
<label>U5 ( Exam Date )</label>
{!! Form::text('cips_u5_exam_date' ,null,['id'=>'cips_u5_exam_date','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u5_exam_date' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-3" {{ $errors->first('cips_u5_exam_result' ,'has-error') }}>
<label>U5 ( Exam Result )</label>
{!! Form::text('cips_u5_exam_result' ,null,['id'=>'cips_u5_exam_result','class'=>'form-control','readonly']) !!}
{!! $errors->first('cips_u5_exam_result' ,'<div class="label label-danger">:message</div>') !!}
</div>
<div class="clearfix"></div>

<div class="form-group col-lg-6" {{ $errors->first('cips_comments' ,'has-error') }}>
<label> Comments </label>
{!! Form::textarea('cips_comments' ,null,['id'=>'cips_comments','class'=>'form-control','readonly','rows'=>'3']) !!}
{!! $errors->first('cips_comments' ,'<div class="label label-danger">:message</div>') !!}
</div>
@endif


@if($course->awarding_body=='cm')
<div class="clearfix"></div>
<div class="form-group col-lg-2" {{ $errors->first('cm_m1_exam_date' ,'has-error') }}>
<label>M1 ( Exam Date )</label>
{!! Form::text('cm_m1_exam_date' ,null,['id'=>'cm_m1_exam_date','class'=>'form-control','readonly']) !!}
{!! $errors->first('cm_m1_exam_date' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-2" {{ $errors->first('cm_m1_exam_result' ,'has-error') }}>
<label>M1 ( Exam Result )</label>
{!! Form::text('cm_m1_exam_result' ,null,['id'=>'cm_m1_exam_result','class'=>'form-control','readonly']) !!}
{!! $errors->first('cm_m1_exam_result' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-2" {{ $errors->first('cm_m2_exam_date' ,'has-error') }}>
<label>M2 ( Exam Date )</label>
{!! Form::text('cm_m2_exam_date' ,null,['id'=>'cm_m2_exam_date','class'=>'form-control','readonly']) !!}
{!! $errors->first('cm_m2_exam_date' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-2" {{ $errors->first('cm_m2_exam_result' ,'has-error') }}>
<label>M2 ( Exam Result )</label>
{!! Form::text('cm_m2_exam_result' ,null,['id'=>'cm_m2_exam_result','class'=>'form-control','readonly']) !!}
{!! $errors->first('cm_m2_exam_result' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="form-group col-lg-2" {{ $errors->first('cm_m3_exam_date' ,'has-error') }}>
<label>M3 ( Exam Date )</label>
{!! Form::text('cm_m3_exam_date' ,null,['id'=>'cm_m3_exam_date','class'=>'form-control','readonly']) !!}
{!! $errors->first('cm_m3_exam_date' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-2" {{ $errors->first('cm_m3_exam_result' ,'has-error') }}>
<label>M3 ( Exam Result )</label>
{!! Form::text('cm_m3_exam_result' ,null,['id'=>'cm_m3_exam_result','class'=>'form-control','readonly']) !!}
{!! $errors->first('cm_m3_exam_result' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="clearfix"></div>

 
<div class="form-group col-lg-6" {{ $errors->first('cm_comments' ,'has-error') }}>
<label> Comments </label>
{!! Form::textarea('cm_comments' ,null,['id'=>'cm_comments','class'=>'form-control','readonly','rows'=>'3']) !!}
{!! $errors->first('cm_comments' ,'<div class="label label-danger">:message</div>') !!}
</div>

@endif

@if($course->awarding_body=='gafm')
<div class="clearfix"></div> 
<div class="form-group col-lg-3" {{ $errors->first('gafm_exam_date' ,'has-error') }}>
<label>GAFM/AAFM ( Exam Date )</label>
{!! Form::text('gafm_exam_date' ,null,['id'=>'gafm_exam_date','class'=>'form-control','readonly']) !!}
{!! $errors->first('gafm_exam_date' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-3" {{ $errors->first('gafm_result' ,'has-error') }}>
<label>GAFM/AAFM ( Exam Result )</label>
{!! Form::text('gafm_result' ,null,['id'=>'gafm_result','class'=>'form-control','readonly' ]) !!}
{!! $errors->first('gafm_result' ,'<div class="label label-danger">:message</div>') !!}
</div>

<div class="clearfix"></div>

 
<div class="form-group col-lg-6" {{ $errors->first('gafm_comments' ,'has-error') }}>
<label> Comments </label>
{!! Form::textarea('gafm_comments' ,null,['id'=>'gafm_comments','class'=>'form-control','readonly','rows'=>'3']) !!}
{!! $errors->first('gafm_comments' ,'<div class="label label-danger">:message</div>') !!}
</div>
@endif

<div class="clearfix"></div>
<a href="{{ Route('students.index',$course->id) }}" class='btn btn-primary btn-lg'>Close</a>


 

