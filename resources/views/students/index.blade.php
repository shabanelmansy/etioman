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
                           Students
                        </div>
                        
                        <div class="panel-body">
                          
                            <a href="{{ Route('students.create',$course_id) }}" class='btn btn-primary'> Add Student </a>
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
                                            <th>Name(EN)</th>
                                            <th>Name(AR)</th>
                                            <th>Student_Id</th>
                                            <th>Mobile</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php $i=1; ?>

                                    @foreach($students as $student)

                                        <tr class="odd gradeX">
                                            <td>{{ $i }}</td>
                                            <td> {{ $student->name_en }}</td>
                                            <td> {{ $student->name_ar }}</td>
                                            <td> {{ $student->student_id }}</td>
                                            <td> {{ $student->mobile }}</td>
                                            <td>
                                            	<a href="{{ Route('students.details',$student->id) }}" class="btn btn-info btn-sm"><i class="fa fa-file-text-o"></i> Details </a>
                                            	<a href="{{ Route('students.edit',[$course_id,$student->id]) }}" class='btn btn-sm btn-success'> <i class="fa fa-edit"></i> Edit </a>
                                                <a href="#" data-href="{{ Route('students.delete',[$course_id,$student->id]) }}" data-toggle="modal" data-target="#confirm-delete" class='btn btn btn-danger btn-sm'><i class="fa fa-trash"></i> Delete </a>

                                                 
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

                                <div class="pagination"> {{ $students->links() }} </div>

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

 