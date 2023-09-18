@extends('staff/layout')
@section('title', 'Edit Book | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editing Book : {{ $data->title }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Book
            <a href="{{ route('staff.book.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
            <form method="POST" action="{{ route('staff.book.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Title</th>
                        <td><input name="title" value="{{ $data->title }}" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td><input name="author" value="{{ $data->author }}" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Book Cover </th>
                        <td><input name="photo" type="file">
                            <input name="prev_photo" type="hidden" value="{{ $data->photo }}">
                            <img width="100" src="{{$data->photo ? asset('storage/'.$data->photo) : ''}}" >
                        </td>
                    </tr>
                    <tr>
                        <th>Book File (PDF Only)</th>
                        <input name="prev_file" type="hidden" value="{{ $data->file }}"> 
                        <td><input name="file" type="file"  accept="application/pdf" >  : 1 File Found (New Upload will replace previous)</td>
                    </tr>
                    <tr>
                        <th>Select Subject <span class="text-danger">*</span></th>
                        <td>
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
                        <th>Info</th>
                        <td><textarea name="info" id="" rows="3" class="form-control">{{$data->info}}</textarea></td>
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

    @section('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection
@endsection

