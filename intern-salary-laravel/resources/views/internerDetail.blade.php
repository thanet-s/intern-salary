@extends('layout')

@section('title', 'รายละเอียดของ '.$user->name)
@section('subtitle', 'รายละเอียดของ '.$user->name)

@section('content')
@error('remove')
<div class="alert alert-success" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
<div class="row">
    <div class="col-lg-12">
        <div id="panel-4" class="panel">
            <div class="panel-hdr">
                <h2>
                    รายละเอียด
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table class="table table-striped m-0">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <th>ชื่อ</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>แผนก</th>
                                <td>{{ $user->department }}</td>
                            </tr>
                            <tr>
                                <th>สังกัด</th>
                                <td>{{ $user->under }}</td>
                            </tr>
                            <tr>
                                <th>สถาบัน</th>
                                <td>{{ $user->institution }}</td>
                            </tr>
                            <tr>
                                <th>สาขาวิชา</th>
                                <td>{{ $user->field }}</td>
                            </tr>
                            <tr>
                                <th>ชั้น</th>
                                <td>{{ $user->degree }}</td>
                            </tr>
                            <tr>
                                <th>วันที่เริ่มฝึก</th>
                                <td>{{ $user->start }}</td>
                            </tr>
                            <tr>
                                <th>ถึง</th>
                                <td>{{ $user->end }}</td>
                            </tr>
                            <tr>
                                <th>เบี้ยเลี้ยง</th>
                                <td>{{ $user->earning }}</td>
                            </tr>
                            <tr>
                                <th>หมายเลขโทรศัพท์</th>
                                <td>{{ $user->tel }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="panel-4" class="panel">
            <div class="panel-hdr">
                <h2>
                    บันทึกการทำงาน
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                        <thead class="bg-warning-200">
                            <tr>
                                <th>ID</th>
                                <th>date</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th>Time</th>
                                <th>Controls</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>date</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th>Time</th>
                                <th>Controls</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($working as $w)
                            <tr>
                                <td>{{ $w->id }}</td>
                                <td>{{ $w->date }}</td>
                                <td>{{ $w->checkin }}</td>
                                <td>{{ $w->checkout }}</td>
                                <td>{{ $w->time }}</td>
                                <td>1</td>
                            </tr>
                            <div class="modal fade" id="remove{{ $w->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ลบ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            คุณต้องการลบ {{ $w->date }} - {{ $w->checkin }} - {{ $w->checkout }} หรือไม่
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ไม่</button>
                                            <form action="/remove-work-record" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $w->id }}" name="id">
                                                <button type="submit" class="btn btn-danger">ลบ</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="panel-4" class="panel">
            <div class="panel-hdr">
                <h2>
                    บันทึกการลา
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table id="dt-basic-example1" class="table table-bordered table-hover table-striped w-100">
                        <thead class="bg-warning-200">
                            <tr>
                                <th>ID</th>
                                <th>date</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th>Time</th>
                                <th>Controls</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>date</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th>Time</th>
                                <th>Controls</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($leave as $l)
                            <tr>
                                <td>{{ $l->id }}</td>
                                <td>{{ $l->date }}</td>
                                <td>{{ $l->checkin }}</td>
                                <td>{{ $l->checkout }}</td>
                                <td>{{ $l->time }}</td>
                                <td>1</td>
                                <div class="modal fade" id="remove{{ $l->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">ลบ</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                คุณต้องการลบ {{ $l->date }} - {{ $l->checkin }} - {{ $l->checkout }} หรือไม่
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ไม่</button>
                                                <form action="/remove-work-record" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $l->id }}" name="id">
                                                    <button type="submit" class="btn btn-danger">ลบ</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                },
                {
                    extend: 'csvHtml5',
                    text: 'ส่งออก CSV',
                    titleAttr: 'Generate CSV',
                    exportOptions: {
                        columns: ':visible(.export-col)'
                    },
                    className: 'btn-outline-default'
                },
                {
                    extend: 'print',
                    text: '<i class="fal fa-print"></i>',
                    titleAttr: 'Print Table',
                    exportOptions: {
                        columns: ':visible(.export-col)'
                    },
                    className: 'btn-outline-default'
                }

            ],
            columnDefs: [{
                    targets: -1,
                    title: 'Controls',
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <button type='button' class='btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1' title='ลบ' data-toggle="modal" data-target="#remove${row[0]}">
                                <i class='fal fa-times'></i>
                            </button>
                        `;
                    },
                },

            ]

        });

        $('#dt-basic-example1').dataTable({
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
                },
                {
                    extend: 'csvHtml5',
                    text: 'ส่งออก CSV',
                    titleAttr: 'Generate CSV',
                    exportOptions: {
                        columns: ':visible(.export-col)'
                    },
                    className: 'btn-outline-default'
                },
                {
                    extend: 'print',
                    text: '<i class="fal fa-print"></i>',
                    titleAttr: 'Print Table',
                    exportOptions: {
                        columns: ':visible(.export-col)'
                    },
                    className: 'btn-outline-default'
                }

            ],
            columnDefs: [{
                    targets: -1,
                    title: 'Controls',
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <button type='button' class='btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1' title='ลบ' data-toggle="modal" data-target="#remove${row[0]}">
                                <i class='fal fa-times'></i>
                            </button>
                        `;
                    },
                },

            ]

        });

    });
</script>
@endsection