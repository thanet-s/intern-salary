@extends('layout')

@section('title', 'แอดมิน')
@section('subtitle', 'แอดมิน')

@section('content')

@error('addsuccess')
<div class="alert alert-success" role="alert">
    <strong>เพิ่มแอดมินสำเร็จ!</strong>
</div>
@enderror
@error('remove')
<div class="alert alert-success" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
@error('selfremove')
<div class="alert alert-danger" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
<div class="row">
    <div class="col-lg-12">
        <div id="panel-4" class="panel">
            <div class="panel-hdr">
                <h2>
                    แอดมิน
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100">
                        <thead class="bg-warning-200">
                            <tr>
                                <th>UserID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Controls</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>UserID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Controls</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>1</td>
                            </tr>
                            <div class="modal fade" id="remove{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ลบแอดมิน</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            คุณต้องการลบ {{ $user->name }} หรือไม่
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ไม่</button>
                                            <form action="/admins" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $user->name }}" name="name">
                                                <input type="hidden" value="{{ $user->id }}" name="id">
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
                            <button type='button' class='btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1' title='ลบแอดมิน' data-toggle="modal" data-target="#remove${row[0]}">
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