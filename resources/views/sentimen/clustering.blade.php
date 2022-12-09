@extends('adminlte::page')

@section('title', 'Clustering - WSA')

@section('adminlte_css')
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Clustering</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (count($charts) > 0)
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Cluster Chart</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>                        
                    @endif
                    <div class="mb-3">
                        @if (count($datas) > 0)
                        <a href="{{ route('reset-clustering') }}" class="btn btn-sm btn-danger"><span class="fa fa-retweet"></span> Reset</a>
                        @else
                        <a href="{{ route('clustering-start') }}" class="btn btn-sm btn-info" type="submit"><span class="fa fa-arrow-right"></span> Start Clustering</a>
                        @endif
                    </div>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>content</th>
                                <th>cluster</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->content }}</td>
                                <td>{{ $data->cluster }}</td>
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

    <script>
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
        labels: [
            {{ $charts[0]->cluster ?? 'No Data' }},
            {{ $charts[1]->cluster ?? 'No Data' }}
        ],
        datasets: [
            {
                data: [{{ $charts[0]->count ?? 0 }}, {{ $charts[1]->count ?? 0 }}],
                backgroundColor : ['#f56954', '#00a65a'],
            }
        ]
        }
        var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        })
    </script>
@stop