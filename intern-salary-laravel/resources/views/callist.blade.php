@extends('layout')

@section('title', 'สรุปยอดเบี้ยเลี้ยง')
@section('subtitle', 'สรุปยอดเบี้ยเลี้ยง')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div id="panel-4" class="panel">
            <div class="panel-hdr">
                <h2>
                    สรุปยอดเบี้ยเลี้ยง
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                        <thead class="bg-warning-200">
                            <tr>
                                <th>ปี-เดือน</th>
                                <th>กลางเดือน</th>
                                <th>สิ้นเดือน</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ปี-เดือน</th>
                                <th>กลางเดือน</th>
                                <th>สิ้นเดือน</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($yms as $ym)
                            <tr>
                                <td>{{ $ym->ym }}</td>
                                <td><a href="/salary/{{ $ym->year }}/{{ $ym->month }}/1" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-danger waves-effect waves-themed">ดู</button></a></td>
                                <td><a href="/salary/{{ $ym->year }}/{{ $ym->month }}/2" target="_blank" rel="noopener noreferrer"><button type="button" class="btn btn-danger waves-effect waves-themed">ดู</button></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('tableSetting')
<script>
    $(document).ready(function() {

        /* init datatables */
        $('#dt-basic-example').dataTable({
            order: [
                [0, "desc"]
            ],
            pageLength: 20,
            responsive: true,
            dom: "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [{
                    extend: 'colvis',
                    text: 'เลือกคอลัมน์',
                    titleAttr: 'Col visibility',
                    className: 'btn-outline-default'
                }

            ]

        });

    });
</script>
@endsection