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
                                            <th>Reports</th>

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
                                            <td>
                                            	
                                                <a href="{{ Route('reports.absants',$course->id) }}" class="btn btn-info btn-sm"><i class="fa fa-calendar"></i> Absants </a>
                                            	<a href="{{ Route('reports.list',$course->id) }}" class='btn btn btn-info btn-sm'> <i class="fa fa-th-list"></i> List </a>
                                                <a href="{{ Route('reports.invoice',$course->id) }}" class='btn btn btn-info btn-sm'><i class="fa fa-file-text-o"></i> Invoice </a>
                                                <a href="{{ Route('reports.certificate',$course->id) }}" class='btn btn btn-info btn-sm'><i class="fa fa-graduation-cap"></i> Certificate </a>
                                                <a href="{{ Route('reports.allinfo',$course->id) }}" class='btn btn btn-info btn-sm'><i class="fa fa-table"></i> All-Info </a>


                                                
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

 