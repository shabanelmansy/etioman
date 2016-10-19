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
                           Edit Student
                        </div>
                        <div class="panel-body">
                        <div class="row">
                        <div class="col-lg-12">
                        
                        {!! Form::model($student,['route'=>['students.update',$student->id]]) !!}
                        
                        @include('students._fields')

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
<script type="text/javascript" src="{{ asset('template/js/datepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        
        $('#cips_valed_to').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });

        
        $('#cips_u1_exam_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });


        $('#cips_u2_exam_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });


        $('#cips_u3_exam_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });


        $('#cips_u4_exam_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });




        $('#cips_u5_exam_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });


        $('#cm_m1_exam_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });


        $('#cm_m2_exam_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });


        $('#cm_m3_exam_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });


        $('#gafm_exam_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            },

        });



        
    });

    
</script>


  


@stop