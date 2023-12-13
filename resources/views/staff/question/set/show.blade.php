@extends('staff/layout')
@section('title', 'Question Set Details | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> Question Set Details </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Question Set Details of <span class="bg-warning"> {{ $data->title }} </span> 
            <a href="{{ route('staff.qset.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th>Question Set</th>
                        <td>{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{{ $data->subject->title }}</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>{{ $data->time }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td> @if ($data->status==1) Active @else Disabled @endif</td>
                    </tr>
                    <tr>
                        <th>Number of Questions</th>
                        <td>{{ $count }} 
                            <a href="{{ route('staff.quesset.show',$data->id) }}" class="float-right btn btn-success btn-sm"><i class="fa fa-eye"> View Questions of {{ $data->title }}  </i></a>
                            @if ($count==0)
                            <a href="{{ route('staff.quesset.create',$data->id) }}" class="mr-1 float-right btn btn-danger btn-sm"><i class="fa fa-edit"> Add Questions To {{ $data->title }}  </i></a>
                            @else
                            <a href="{{ route('staff.quesset.edit',$data->id) }}" class="mr-1 float-right btn btn-warning btn-sm"><i class="fa fa-edit"> Add Questions To {{ $data->title }}  </i></a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="{{ route('staff.qset.edit',$data->id) }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit {{ $data->title }}  </i></a>
                        </td>
                        
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

