@extends('staff/layout')
@section('title', 'Question Set Details | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"> Question Set </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> SET : {{ $data->title }} 
            <a href="{{ route('staff.quesset.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-bordered text-center" width="100%">
                    @foreach ($questions as $key => $question)
                    <tr>
                        <th colspan="2">{{ $key+1 }}. {{ $question->title }}</th>
                    </tr>
                    <tr>
                        <th colspan="2"> 
                            <span class="m-1">i.{{ $question->opt1 }}</span>
                            <span class="m-1">ii.{{ $question->opt2 }} </span>
                            <span class="m-1">iii.{{ $question->opt3 }} </span>
                            <span class="m-1">iv.{{ $question->opt4 }}</span>
                        </th>
                    </tr>
                    <tr>
                        <th>Answer</th>
                        <td class="bg-success text-white"> 
                            @switch($question->ans)
                                @case('opt1')
                                ; : {{ $question->opt1 }}
                                    @break
                                @case('opt2')
                                ii : {{ $question->opt2 }}
                                    @break
                                @case('opt3')
                                iii : {{ $question->opt3 }}
                                    @break
                                @case('opt4')
                                iv : {{ $question->opt4 }}
                                    @break
                                @default
                                    N/A
                            @endswitch
                        
                        </td>
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="2">
                            <a href="{{ route('staff.quesset.edit',$data->id) }}" class="float-right btn btn-info btn-sm"><i class="fa fa-edit"> Add Questions {{ $data->title }}  </i></a>
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

