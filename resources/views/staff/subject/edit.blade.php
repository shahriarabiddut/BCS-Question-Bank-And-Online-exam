@extends('staff/layout')
@section('title', 'Edit Subject | Staff Dashboard')
@section('content')


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Editing Subject : {{ $data->title }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Subject
            <a href="{{ route('staff.subject.index') }}" class="float-right btn btn-success btn-sm"> <i class="fa fa-arrow-left"></i> View All </a> </h6>
        </div>
        <div class="card-body">
            
            <div class="table-responsive">
            <form method="POST" action="{{ route('staff.subject.update',$data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                    <tr>
                        <th>Title</th>
                        <td><input name="title" value="{{ $data->title }}" type="text" class="form-control"></td>
                    </tr>
                    <tr>
                        <th>Photo</th>
                        <td><input name="photo" type="file">
                            <input name="prev_photo" type="hidden" value="{{ $data->photo }}">
                            <img width="100" src="{{$data->photo ? asset('storage/'.$data->photo) : ''}}" >
                        </td>
                    </tr>
                    <tr>
                        <th>Select Language <span class="text-danger">*</span></th>
                        <td>
                            <select required name="language_id" class="form-control">
                                <option value="0">--- Select Language ---</option>
                                @foreach ($languages as $language)
                                <option 
                                @if ($language->id==$data->language_id)
                                    @selected(true)
                                @endif
                                value="{{$language->id}}">{{$language->title}}</option>
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

