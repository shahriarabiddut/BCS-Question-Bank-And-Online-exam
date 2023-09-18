@extends('staff/layout')
@section('title', 'Edit Question Set | Staff Dashboard')
@section('content')


    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
    <h1 class="h3 text-gray-800 d-inline">Update Question Set : {{ $data->title }}</h1>
    <h6 class="m-0 font-weight-bold text-primary d-inline"> 
            <a href="{{ route('staff.quesset.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
            <form method="POST" action="{{ route('staff.quesset.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <td>Subject<span class="text-danger">*</span></td>
                        <td>{{ $subject->title }}</td>
                    </tr>
                
                    <tr>
                        <td>Question Set<span class="text-danger">*</span></td>
                        <td>{{ $data->title }}
                        <input type="hidden" name="set_id" value="{{ $data->id }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Questions <span class="text-danger">*</span></td>
                        <td><select name="question[]" class="form-select" id="question-field" data-placeholder="Choose Question" multiple>
                            @foreach ($questions as $ct)
                            <option
                            @foreach ($data->questions as $question) 
                            @if ($question->question->id == $ct->id)
                            @selected(true)
                            @endif
                            @endforeach
                            value="{{$ct->id}}">{{$ct->title}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
            </div>
        </div>
    </div>
    <script>
        $( '#question-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '50%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
</script>
    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

