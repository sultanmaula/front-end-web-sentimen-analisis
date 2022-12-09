@extends('adminlte::page')

@section('title', 'KNN - WSA')

@section('adminlte_css')
@stop

@section('content_header')
    <h1 class="m-0 text-dark">KNN</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        @if (count($datas) > 0)
                        <a href="{{ route('reset-knn') }}" class="btn btn-sm btn-danger"><span class="fa fa-retweet"></span> Reset</a>
                        @else
                        <a href="{{ route('knn-start') }}" class="btn btn-sm btn-warning" type="submit"><span class="fa fa-arrow-right"></span> Start KNN</a>
                        @endif
                    </div>
                    <div class="mt-4">
                        <h5>Precision</h5>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>0</th>
                                    <th>1</th>
                                    <th>Accuracy</th>
                                    <th>Macro Avg</th>
                                    <th>Weighted Avg</th>
                                </tr>
                            </thead>
                            @php
                                $data_precision = $datas[0]->precision ?? '';
                            @endphp
                            @if ($data_precision)
                            <tbody>
                                @php
                                    $precisions = json_decode($datas[0]->precision);
                                    $nol = '0';
                                    $satu = '1';
                                    $macro_avg = 'macro avg';
                                    $weighted_avg = 'weighted avg';
                                @endphp
                                <tr>
                                    <td>{{ $precisions->$nol }}</td>
                                    <td>{{ $precisions->$satu }}</td>
                                    <td>{{ $precisions->accuracy }}</td>
                                    <td>{{ $precisions->$macro_avg }}</td>
                                    <td>{{ $precisions->$weighted_avg }}</td>
                                </tr>
                            </tbody>
                            @else
                            <tbody>
                                <td colspan="5" style="text-align: center">No data</td>
                            </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="mt-4">
                        <h5>Recall</h5>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>0</th>
                                    <th>1</th>
                                    <th>Accuracy</th>
                                    <th>Macro Avg</th>
                                    <th>Weighted Avg</th>
                                </tr>
                            </thead>
                            @php
                                $data_recall = $datas[0]->recall ?? '';
                            @endphp
                            @if ($data_recall)
                            <tbody>
                                @php
                                    $recalls = json_decode($datas[0]->recall);
                                    $nol = '0';
                                    $satu = '1';
                                    $macro_avg = 'macro avg';
                                    $weighted_avg = 'weighted avg';
                                @endphp
                                <tr>
                                    <td>{{ $recalls->$nol }}</td>
                                    <td>{{ $recalls->$satu }}</td>
                                    <td>{{ $recalls->accuracy }}</td>
                                    <td>{{ $recalls->$macro_avg }}</td>
                                    <td>{{ $recalls->$weighted_avg }}</td>
                                </tr>
                            </tbody>
                            @else
                            <tbody>
                                <td colspan="5" style="text-align: center">No data</td>
                            </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="mt-4">
                        <h5>F1-Score</h5>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>0</th>
                                    <th>1</th>
                                    <th>Accuracy</th>
                                    <th>Macro Avg</th>
                                    <th>Weighted Avg</th>
                                </tr>
                            </thead>
                            @php
                                $f1score = 'f1-score';
                                $data_f1score = $datas[0]->$f1score ?? '';
                            @endphp
                            @if ($data_f1score)
                            <tbody>
                                @php
                                    $f1scores = json_decode($datas[0]->$f1score);
                                    $nol = '0';
                                    $satu = '1';
                                    $macro_avg = 'macro avg';
                                    $weighted_avg = 'weighted avg';
                                @endphp
                                <tr>
                                    <td>{{ $f1scores->$nol }}</td>
                                    <td>{{ $f1scores->$satu }}</td>
                                    <td>{{ $f1scores->accuracy }}</td>
                                    <td>{{ $f1scores->$macro_avg }}</td>
                                    <td>{{ $f1scores->$weighted_avg }}</td>
                                </tr>
                            </tbody>
                            @else
                            <tbody>
                                <td colspan="5" style="text-align: center">No data</td>
                            </tbody>
                            @endif
                        </table>
                    </div>
                    <div class="mt-4">
                        <h5>Support</h5>
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>0</th>
                                    <th>1</th>
                                    <th>Accuracy</th>
                                    <th>Macro Avg</th>
                                    <th>Weighted Avg</th>
                                </tr>
                            </thead>
                            @php
                                $data_support = $datas[0]->support ?? '';
                            @endphp
                            @if ($data_support)
                            <tbody>
                                @php
                                    $supports = json_decode($datas[0]->support);
                                    $nol = '0';
                                    $satu = '1';
                                    $macro_avg = 'macro avg';
                                    $weighted_avg = 'weighted avg';
                                @endphp
                                <tr>
                                    <td>{{ $supports->$nol }}</td>
                                    <td>{{ $supports->$satu }}</td>
                                    <td>{{ $supports->accuracy }}</td>
                                    <td>{{ $supports->$macro_avg }}</td>
                                    <td>{{ $supports->$weighted_avg }}</td>
                                </tr>
                            </tbody>
                            @else
                            <tbody>
                                <td colspan="5" style="text-align: center">No data</td>
                            </tbody>
                            @endif
                        </table>
                    </div>
                    @if (count($datas) == 0)
                    <h5>Accuracy : 0</h5>
                    @else
                    <h5>Accuracy : <b style="color: crimson">{{ $datas[0]->accuracy }}</b></h5>
                    @endif
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