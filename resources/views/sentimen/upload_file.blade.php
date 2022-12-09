@extends('adminlte::page')

@section('title', 'Upload File - WSA')

@section('adminlte_css')
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Upload File</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('import-file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control-file mb-2" name="excel" required>
                        <button class="btn btn-sm btn-primary" type="submit"><span class="fa fa-upload"></span> Upload</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Table Data</h4>
                    <a href="{{ route('reset-raw-data') }}" class="btn btn-sm btn-danger mb-3"><span class="fa fa-retweet"></span> Reset</a>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Score</th>
                                <th>At</th>
                                <th>Content</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->score }}</td>
                                <td>{{ $data->at }}</td>
                                <td>{{ $data->content }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('adminlte_js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function(){
            // DataTable
            $('#dataTable').DataTable();
        });
    </script>
@stop