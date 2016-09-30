

<div class="form-group col-lg-6" {{ $errors->first('start_at' ,'has-error') }}>
<label>Start Date</label>
{!! Form::text('start_at' ,null,['id'=>'start_at','required'=>'required','class'=>'form-control','disabled']) !!}
{!! $errors->first('start_at' ,'<div class="label label-danger">:message</div>') !!}
</div>
<div class="clearfix"></div>

<div class="form-group col-lg-6" {{ $errors->first('end_at' ,'has-error') }}>
<label>Ending Date</label>
{!! Form::text('end_at' ,null,['id'=>'end_at','required'=>'required','class'=>'form-control','disabled']) !!}
{!! $errors->first('end_at' ,'<div class="label label-danger">:message</div>') !!}
</div>
<div class="clearfix"></div>

<div class="form-group col-lg-6" {{ $errors->first('title' ,'has-error') }}>
<label>Title</label>
{!! Form::text('title' ,null,['id'=>'title','required'=>'required','class'=>'form-control','disabled']) !!}
{!! $errors->first('title' ,'<div class="label label-danger">:message</div>') !!}
</div>
<div class="clearfix"></div>
 
<div class="form-group col-lg-6" {{ $errors->first('venue' ,'has-error') }}>
<label>Venue</label>
{!! Form::text('venue' ,null,['class'=>'form-control','disabled']) !!}
{!! $errors->first('venue' ,'<div class="label label-danger">:message</div>') !!}
</div>
<div class="clearfix"></div>

<div class="form-group col-lg-6" {{ $errors->first('instructor' ,'has-error') }}>
<label>Instructor</label>
{!! Form::text('instructor' ,null,['id'=>'instructor','required'=>'required','class'=>'form-control','disabled']) !!}
{!! $errors->first('instructor' ,'<div class="label label-danger">:message</div>') !!}
</div>
<div class="clearfix"></div>

<div class="form-group col-lg-6">
        {!! Form::label('lanquage','Lanquage:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;') !!}
        
            @foreach ($lanquage as $key=>$value)
                {{ Form::radio('lanquage', $key, (!empty($course) ? null : ($key==session('lanquageC', 'en') ? true : false)),array('disabled')) }} {{ $value }}
       
            @endforeach
 
        
</div>
<div class="clearfix"></div>


<div class="form-group col-lg-4">
        {!! Form::label('certificate','Certificate: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;') !!}
         
           @foreach ($certificate as $key=>$value)
                {{ Form::radio('certificate', $key, (!empty($course) ? null : ($key==session('certificateC', 'institute') ? true : false)),array('disabled')) }} {{ $value }}
       
            @endforeach
 
        
</div>

<div class="form-group col-lg-2" {{ $errors->first('duration' ,'has-error') }}>
<label>Duration</label>
 
{!! Form::text('duration' ,null,['class'=>'form-control','disabled']) !!}
{!! $errors->first('duration' ,'<div class="label label-danger">:message</div>') !!}
</div>
<div class="clearfix"></div>

 
<div class="form-group col-lg-4">
        {!! Form::label('organization','Organization : &nbsp;&nbsp;&nbsp;&nbsp;') !!}
         
            @foreach ($organization as $key=>$value)
                {{ Form::radio('organization', $key, (!empty($course) ? null : ($key==session('organizationC', 'individual') ? true : false)),array('disabled')) }} {{ $value }}
       
            @endforeach
 
        
</div>

<div class="form-group col-lg-2" {{ $errors->first('org_name' ,'has-error') }}>
<label>Organization Name</label>
{!! Form::text('org_name' ,null,['class'=>'form-control','disabled']) !!}
{!! $errors->first('org_name' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-2" {{ $errors->first('fees' ,'has-error') }}>
<label>Fees</label>
{!! Form::text('fees' ,null,['class'=>'form-control','disabled']) !!}
{!! $errors->first('fees' ,'<div class="label label-danger">:message</div>') !!}
</div>


<div class="form-group col-lg-8">
        {!! Form::label('awarding_body','Awarding Body : ') !!}
         
            @foreach ($awarding_body as $key=>$value)
                {{ Form::radio('awarding_body', $key, (!empty($course) ? null : ($key==session('awarding_bodyC', 'local') ? true : false)),array('disabled')) }} {{ $value }}
       
            @endforeach
 
        
</div>

<div class="clearfix"></div>
<a href="{{ Route('courses.index',$course->id) }}" class='btn btn-primary btn-lg'>Close</a>