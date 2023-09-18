@extends('staff/layout')
@section('title', 'Edit Question Set | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editing Question Set : {{ $data->title }}</h1>
    @if(Session::has('error'))
    <div class="p-3 mb-2 bg-danger text-white">
        <p>{{ session('error') }} </p>
    </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Question Set
            <a href="{{ route('staff.qset.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
            <form method="POST" action="{{ route('staff.qset.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Question Set Title</th>
                        <td><input name="title" value="{{ $data->title }}" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Select Subject <span class="text-danger">*</span></th>
                        <td>
                            <input type="hidden" name="old_subject_id" value="{{ $data->subject_id }}">
                            <input type="hidden" name="type" value="{{ $data->type }}">
                            <select required name="subject_id" class="form-control">
                                <option value="0">--- Select Subject ---</option>
                                @foreach ($subjects as $subject)
                                <option 
                                @if ($subject->id==$data->subject_id)
                                    @selected(true)
                                @endif
                                value="{{$subject->id}}">{{$subject->title}}</option>
                                @endforeach
                            </select>
                        </td>
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
        // Get the input element by its ID
    const inputElement1 = document.getElementById('opt1');
    const inputElement2 = document.getElementById('opt2');
    const inputElement3 = document.getElementById('opt3');
    const inputElement4 = document.getElementById('opt4');

    // Get the result element where you want to display the value
    const resultElement1 = document.getElementById('optresult1');
    const resultElement2 = document.getElementById('optresult2');
    const resultElement3 = document.getElementById('optresult3');
    const resultElement4 = document.getElementById('optresult4');

    // Add an event listener to the input element
    inputElement1.addEventListener('input', function() {
    const inputValue1 = inputElement1.value;
    resultElement1.textContent = `${inputValue1}`;
    });
    inputElement2.addEventListener('input', function() {
    const inputValue2 = inputElement2.value;
    resultElement2.textContent = `${inputValue2}`;
    });
    inputElement3.addEventListener('input', function() {
    const inputValue3 = inputElement3.value;
    resultElement3.textContent = `${inputValue3}`;
    });
    inputElement4.addEventListener('input', function() {
    const inputValue4 = inputElement4.value;
    resultElement4.textContent = `${inputValue4}`;
    });
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

