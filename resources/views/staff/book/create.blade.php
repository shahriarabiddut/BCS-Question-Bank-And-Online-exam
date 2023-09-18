@extends('staff/layout')
@section('title', 'Add Book | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Add Book </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Book Data
            <a href="{{ route('staff.book.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
                @if(Session::has('error'))
                <div class="p-3 mb-2 bg-danger text-white">
                    <p>{{ session('error') }} </p>
                </div>
                @endif
                @error('file')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            <form method="POST" action="{{ route('staff.book.store') }}" enctype="multipart/form-data">
                @csrf
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Book Cover</th>
                        <td><input name="photo" type="file" ></td>
                    </tr>
                    <tr>
                        <th>Book File (PDF Only)</th>
                        <td><input required name="file" type="file"  accept="application/pdf" ></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td><input required name="title" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td><input required name="author" type="text" class="form-control"></td>
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
                        <th>Info</th>
                        <td><textarea name="info" id="" rows="3" class="form-control"></textarea></td>
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

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

