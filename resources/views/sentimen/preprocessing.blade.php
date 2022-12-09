@extends('adminlte::page')

@section('title', 'Preprocessing - WSA')

@section('adminlte_css')
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Pre-processing</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        @if (count($datas) > 0)
                        <a href="{{ route('reset-preprocessing') }}" class="btn btn-sm btn-danger"><span class="fa fa-retweet"></span> Reset</a>
                        @else
                        <a href="{{ route('preprocessing-start') }}" class="btn btn-sm btn-success" type="submit"><span class="fa fa-arrow-right"></span> Start Preprocessing</a>
                        @endif
                    </div>
                    <div style="overflow-x: auto;">
                        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>id</th>
                                    <th>username</th>
                                    <th>content</th>
                                    <th>review_tokens</th>
                                    <th>review_tokens_stemmed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->content }}</td>
                                    <td>{{ $data->review_tokens }}</td>
                                    <td>{{ $data->review_tokens_stemmed }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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