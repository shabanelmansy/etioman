@extends('app')

@section('content')

 <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Courses</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Edit Course
                        </div>
                        <div class="panel-body">
                        <div class="row">
                        <div class="col-lg-12">
                        
                        {!! Form::model($course , ['route'=>['courses.update',$course->id]]) !!}

                        @include('courses._fields')

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
<script>
	
 $(document).ready(function() {
    $('input[type=radio][name=certificate]').change(function() {
          
        if (this.value == 'ministry') {
         	$("input[type=text][name=duration]").prop('disabled', false);   
        }
        else if (this.value == 'institute') {

        	$("input[type=text][name=duration]").prop('disabled', true);
             
        }
    });


    $('input[type=radio][name=organization]').change(function() {
          
        if (this.value == 'group') {
         	$("input[type=text][name=org_name]").prop('disabled', false);
         	$("input[type=text][name=fees]").prop('disabled', false);   
        }
        else if (this.value == 'individual') {

        	$("input[type=text][name=org_name]").prop('disabled', true);
        	$("input[type=text][name=fees]").prop('disabled', true);
             
        }
    });


   });

 
</script>


 <!-- daterangepicker -->
<script type="text/javascript" src="{{ asset('template/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/js/parsley/parsley.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/js/parsley/ar.js') }}"></script>
 <!-- icheck -->
<!-- daterangepicker -->
<script type="text/javascript" src="{{ asset('template/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('template/js/datepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#start_at').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });


        $('#end_at').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });

        
    });

    
</script>


  


@stop