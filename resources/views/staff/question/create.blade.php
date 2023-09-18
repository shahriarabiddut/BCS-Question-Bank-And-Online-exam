@extends('staff/layout')
@section('title', 'Add Question | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Add Question </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Question Data
            <a href="{{ route('staff.question.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                @if(Session::has('error'))
                <div class="p-3 mb-2 bg-danger text-white">
                    <p>{{ session('error') }} </p>
                </div>
                @endif
            <form method="POST" action="{{ route('staff.question.store') }}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Question Title</th>
                        <td><input required name="title" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Select Subject <span class="text-danger">*</span></th>
                        <td>
                            <select required name="subject_id" class="form-control">
                                <option value="0">--- Select Subject ---</option>
                                @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->title}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Option 1</th>
                        <td><input required id="opt1" name="opt1" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Option 2</th>
                        <td><input required id="opt2" name="opt2" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Option 3</th>
                        <td><input required id="opt3" name="opt3" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Option 4</th>
                        <td><input required id="opt4" name="opt4" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Correct Answer</th>
                        <td>
                            <select required name="ans" class="form-control">
                                <option value="0">--- Select Answer ---</option>
                                <option value="opt1" id="optresult1"> </option>
                                <option value="opt2" id="optresult2"> Option 2</option>
                                <option value="opt3" id="optresult3"> Option 3</option>
                                <option value="opt4" id="optresult4"> Option 4</option>
                            </select>
                        </td>
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

