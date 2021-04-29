@extends('layout')

@section('title', 'แผนก')
@section('subtitle', 'แผนก')

@section('content')

@error('addsuccess')
<div class="alert alert-success" role="alert">
    <strong>เพิ่มแผนกสำเร็จ!</strong>
</div>
@enderror
@error('remove')
<div class="alert alert-success" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
@error('edit')
<div class="alert alert-success" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
@error('name')
<div class="alert alert-danger" role="alert">
    <strong>เกิดข้อผิดพลาด แผนกซ้ำ!</strong>
</div>
@enderror
<div class="row">
    <div class="col-lg-12">
        <div id="panel-4" class="panel">
            <div class="panel-hdr">
                <h2>
                    เพิ่มแผนก
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <form action="/add-department" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">ชื่อแผนก</label>
                            <input type="text" class="form-control" name="name" require>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-themed">เพิ่ม</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="panel-4" class="panel">
            <div class="panel-hdr">
                <h2>
                    รายการแผนก
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                        <thead class="bg-warning-200">
                            <tr>
                                <th>ID</th>
                                <th>ชื่อแผนก</th>
                                <th>Controls</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อแผนก</th>
                                <th>Controls</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->id }}</td>
                                <td>{{ $department->name }}</td>
                                <td>1</td>
                            </tr>
                            <div class="modal fade" id="remove{{ $department->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ลบแผนก</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            คุณต้องการลบ {{ $department->name }} หรือไม่
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ไม่</button>
                                            <form action="/remove-department" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $department->name }}" name="name">
                                                <input type="hidden" value="{{ $department->id }}" name="id">
                                                <button type="submit" class="btn btn-danger">ลบ</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="edit{{ $department->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">แก้ไขแผนก</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <form action="/edit-department" method="POST">
                                            <div class="modal-body">
                                                @csrf
                                                <input type="text" class="form-control" value="{{ $department->name }}" name="name">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                                <input type="hidden" value="{{ $department->id }}" name="id">
                                                <button type="submit" class="btn btn-danger">แก้ไข</button>
                                            </div>
                                        </form>
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
                            <button type='button' class='btn btn-sm btn-icon btn-outline-info rounded-circle mr-1' title='แก้ไข' data-toggle="modal" data-target="#edit${row[0]}">
                                <i class='fal fa-edit'></i>
                            </button>
                        `;
                    },
                },

            ]

        });

    });
</script>
@endsection