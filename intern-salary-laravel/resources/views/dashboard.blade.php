@extends('layout')

@section('title', 'นักศึกษาฝึกงาน')
@section('subtitle', 'นักศึกษาฝึกงาน')

@section('content')
@error('addsuccess')
<div class="alert alert-success" role="alert">
    <strong>เพิ่มนักศึกษาสำเร็จ!</strong>
</div>
@enderror
@error('success')
<div class="alert alert-success" role="alert">
    <strong>เพิ่มเวลาการทำงานแล้ว!</strong>
</div>
@enderror
@error('edit')
<div class="alert alert-success" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
@error('remove')
<div class="alert alert-success" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
@error('leave')
<div class="alert alert-success" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
<div class="row">
    <div class="col-lg-12">
        <div id="panel-4" class="panel">
            <div class="panel-hdr">
                <h2>
                    นักศึกษา <span class="fw-300"><i>ทั้งหมด</i></span>
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                        <thead class="bg-warning-200">
                            <tr>
                                <th>รหัส</th>
                                <th>ชื่อ</th>
                                <th>แผนก</th>
                                <th>สถาบัน</th>
                                <th>สาขาวิชา</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>สถานะ</th>
                                <th>Controls</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>รหัส</th>
                                <th>ชื่อ</th>
                                <th>แผนก</th>
                                <th>สถาบัน</th>
                                <th>สาขาวิชา</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>สถานะ</th>
                                <th>Controls</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($interners as $i)
                            <tr>
                                <td>{{ $i->id }}</td>
                                <td>{{ $i->name }}</td>
                                <td>{{ $i->department }}</td>
                                <td>{{ $i->institution }}</td>
                                <td>{{ $i->field }}</td>
                                <td>{{ $i->tel }}</td>
                                @if (!$i->pass)
                                <td>กำลังฝึกงาน</td>
                                @else
                                <td>ฝึกงานจบแล้ว</td>
                                @endif
                                <td>1</td>
                            </tr>
                            <div class="modal fade" id="remove{{ $i->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ลบนักศึกษา</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ต้องการลบ <strong>{{ $i->name }}</strong> หรือไม่
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ไม่</button>
                                            <form action="/remove-interner" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $i->name }}" name="name">
                                                <input type="hidden" value="{{ $i->id }}" name="id">
                                                <button type="submit" class="btn btn-danger">ลบ</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="edit{{ $i->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">แก้ไขรายละเอียดของ {{ $i->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/edit-student" method="POST">
                                                @csrf
                                                <input type="hidden" name="oid" value="{{ $i->id }}">
                                                <div class="form-group">
                                                    <label class="form-label">รหัส</label>
                                                    <input type="text" class="form-control" name="id" value="{{ $i->id }}" require>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">ชื่อ - สกุล</label>
                                                    <input type="text" class="form-control" name="name" value="{{ $i->name }}" require>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">แผนก</label>
                                                    <select class="form-control" name="department">
                                                        @foreach ($departments as $d)
                                                        <option value="{{ $d->id }}" {{ ( $i->department == $d->name) ? 'selected' : '' }}>{{ $d->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">สังกัด</label>
                                                    <input type="text" class="form-control" value="{{ $i->under }}" name="under">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">สถาบัน</label>
                                                    <input type="text" class="form-control" value="{{ $i->institution }}" name="institution" require>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">สาขาวิชา</label>
                                                    <input type="text" class="form-control" name="field" value="{{ $i->field }}" require>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">ชั้น</label>
                                                    <input type="text" class="form-control" name="degree" value="{{ $i->degree }}" require>
                                                </div>
                                                <label class="form-label ">เริ่มฝึกวันที่</label>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <div class="input-daterange input-group" id="datepicker{{$i->id}}">
                                                            <input type="text" class="form-control" name="start" value="{{ $i->start }}">
                                                            <div class="input-group-append input-group-prepend">
                                                                <span class="input-group-text" style="font-size:0.7rem;">ถึง</span>
                                                            </div>
                                                            <input type="text" class="form-control" name="end" value="{{ $i->end }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">เบี้ยเลี้ยง</label>
                                                    <input type="number" class="form-control" name="earning" value="{{ $i->earning }}" require>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">หมายเลขโทรศัพท์</label>
                                                    <input type="text" class="form-control" name="tel" value="{{ $i->tel }}" require>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">สถานะการฝึก</label>
                                                    <select class="form-control" name="pass">
                                                        <option value="0" {{ ( 0 == $i->pass) ? 'selected' : '' }}>กำลังฝึกงาน</option>
                                                        <option value="1" {{ ( 1 == $i->pass) ? 'selected' : '' }}>ฝึกงานจบแล้ว</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-themed">แก้ไข</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="leave{{ $i->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">เพิ่มการลาของ {{ $i->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/leave-student" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $i->id }}">
                                                <input type="hidden" name="name" value="{{ $i->name }}">
                                                <div class="form-group">
                                                    <label class="form-label" for="example-date">วันที่</label>
                                                    <input class="form-control" id="example-date" type="date" name="date">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="example-time-3">เวลา</label>
                                                    <input class="form-control" id="example-time-3" type="time" name="checkin">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="example-time-3">ถึง</label>
                                                    <input class="form-control" id="example-time-3" type="time" name="checkout">
                                                </div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-themed">เพิ่ม</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
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
    </div>
</div>
@endsection

@section('tableSetting')
<script src="js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script>
    // Class definition

    var controls = {
        leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
        rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
    }

    var runDatePicker = function() {
        @foreach ($interners as $i)
        // range picker
        $('#datepicker{{$i->id}}').datepicker({
            todayHighlight: true,
            templates: controls,
            format: 'yyyy-mm-dd'
        });
        @endforeach
    }

    $(document).ready(function() {
        runDatePicker();

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
                            <div class='dropdown d-inline-block dropleft'>
                                <a href='#'' class='btn btn-sm btn-icon btn-outline-primary rounded-circle shadow-0' data-toggle='dropdown' aria-expanded='true' title='More options'>
                                    <i class=\"fal fa-ellipsis-v\"></i>
                                </a>
                                <div class='dropdown-menu'>
                                    <a class='dropdown-item' href="/admin/interner/${row[0]}" target="_blank">รายละเอียด</a>
                                    <a class='dropdown-item' data-toggle="modal" data-target="#edit${row[0]}"'>แก้ไขข้อมูล</a>
                                    <a class='dropdown-item' data-toggle="modal" data-target="#leave${row[0]}" '>เพิ่มการลา</a>
                                </div>
                            </div>
                        `;
                    },
                },

            ]

        });

    });
</script>
@endsection