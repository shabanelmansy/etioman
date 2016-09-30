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
                           Courses
                        </div>

                         
        				<div class="panel-body">
					       @include('flash::message')
				        </div>
				       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Start Date</th>
                                            <th>Ending Date</th>
                                            <th>Venue</th>
                                            <th>Instructor</th>
                                            <th>Awarding Body</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php $i=1; ?>

                                    @foreach($courses as $course)

                                        <tr class="odd gradeX">
                                            <td>{{ $i }}</td>
                                            <td> {{ $course->title }}</td>
                                            <td> {{ $course->start_at }}</td>
                                            <td> {{ $course->end_at }}</td>
                                            <td> {{ $course->venue }}</td>
                                            <td> {{ $course->instructor }}</td>
                                            <td> {{ $course->awarding_body }}</td>
                                            <td>
                                            	<a href="{{ Route('courses.details',$course->id) }}" class="btn btn-info btn-sm"><i class="fa fa-file-text-o"></i> Details </a>
                                            	<a href="{{ Route('courses.edit',$course->id) }}" class='btn btn-sm btn-success'> <i class="fa fa-edit"></i> Edit </a>
                                                 
                                                <a href="#" data-href="{{ Route('courses.delete',$course->id) }}" data-toggle="modal" data-target="#confirm-delete" class='btn btn btn-danger btn-sm'><i class="fa fa-trash"></i> Delete </a>

                                                <a href="{{ Route('students.index',$course->id) }}" class='btn btn btn-info btn-sm'><i class="fa fa-user"></i> Students </a>


                                                <!--  delete confirm ---->
                                                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                Delete
                                                            </div>
                                                            <div class="modal-body">
                                                                Do you want to delete this record ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                <a class="btn btn-danger btn-ok">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                

                             
                         



                                            </td>

                                        </tr>

                                      <?php $i++ ?>
                                     @endforeach   
                                       
                                    </tbody>
                                </table>

                                  <div class="pagination"> {{ $courses->links() }} </div>
                            </div>
 
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

</div>
<!-- /#page-wrapper -->



@endsection

 