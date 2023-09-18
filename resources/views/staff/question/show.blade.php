@extends('staff/layout')
@section('title', 'Question Details | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> Question Details </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Question Details of <span class="bg-warning"> {{ $data->title }} </span> 
            <a href="{{ route('staff.question.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <tr>
                        <th>Question (প্রশ্ন)</th>
                        <td>{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <th>Subject</th>
                        <td>{{ $data->subject->title }}</td>
                    </tr>
                    <tr>
                        <th>Option 1</th>
                        <td>{{ $data->opt1 }}</td>
                    </tr>
                    <tr>
                        <th>Option 2</th>
                        <td>{{ $data->opt2 }}</td>
                    </tr>
                    <tr>
                        <th>Option 3</th>
                        <td>{{ $data->opt3 }}</td>
                    </tr>
                    <tr>
                        <th>Option 4</th>
                        <td>{{ $data->opt4 }}</td>
                    </tr>
                    <tr>
                        <th>Answer</th>
                        <td class="bg-success text-white">
                            {{ $data->ans }} : 
                            @switch($data->ans)
                                @case('opt1')
                                {{ $data->opt1 }}
                                    @break
                                @case('opt2')
                                {{ $data->opt2 }}
                                    @break
                                @case('opt3')
                                {{ $data->opt3 }}
                                    @break
                                @case('opt4')
                                {{ $data->opt4 }}
                                    @break
                                @default
                                    N/A
                            @endswitch
                        
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2">
                            <a href="{{ route('staff.question.edit',$data->id) }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Edit {{ $data->title }}  </i></a>
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

