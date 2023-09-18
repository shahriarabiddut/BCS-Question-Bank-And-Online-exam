@extends('staff/layout')
@section('title', 'Add Question Set | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Add Question Set </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Question Set Data
            <a href="{{ route('staff.quesset.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                @if(Session::has('error'))
                <div class="p-3 mb-2 bg-danger text-white">
                    <p>{{ session('error') }} </p>
                </div>
                @endif
            <form method="POST" action="{{ route('staff.quesset.store') }}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <td>Subject<span class="text-danger">*</span></td>
                        <td>{{ $subject->title }}</td>
                    </tr>
                
                    <tr>
                        <td>Question Set<span class="text-danger">*</span></td>
                        <td>{{ $set->title }}
                        <input type="hidden" name="set_id" value="{{ $set->id }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Questions <span class="text-danger">*</span></td>
                        <td><select name="question[]" class="form-select" id="question-field" data-placeholder="Choose Question" multiple>
                            @foreach ($questions as $ct)
                            <option value="{{$ct->id}}">{{$ct->title}}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary">Submit</button>
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

