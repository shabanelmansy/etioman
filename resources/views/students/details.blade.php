@extends('app')

@section('content')

 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Students</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Details Student
                        </div>
                        <div class="panel-body">
                        <div class="row">
                        <div class="col-lg-12">
                        
                        {!! Form::model($student,['route'=>['students.update',$student->id]]) !!}
                        
                        @include('students._details')

                        {!! Form::close() !!}

						 </div>
					    </div>
					    </div>
					</div>
				</div>
			 </div>		

</div>
@stop

@section('footer')
 
 <!-- daterangepicker -->
<script type="text/javascript" src="{{ asset('template/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/js/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/js/parsley/ar.js') }}"></script>
 <!-- icheck -->
<!-- daterangepicker -->
<script type="text/javascript" src="{{ asset('template/js/moment.min.js') }}"></script>

@stop