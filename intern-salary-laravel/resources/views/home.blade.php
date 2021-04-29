@extends('layout')

@section('title', 'นักศึกษาฝึกงาน')
@section('subtitle', 'นักศึกษาฝึกงาน')

@section('content')
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
                            <tr>
                                <td>268410636</td>
                                <td>นายอนุสิทธิ์ ทองดีนอก</td>
                                <td>Factory Support</td>
                                <td>วิทยาลัยเทคนิคนางรอง</td>
                                <td>เชื่อมโลหะ</td>
                                <td>061-060-3641</td>
                                <td>ฝึกงานแล้ว</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>077610947</td>
                                <td>นายอนุชา หาญกล้า</td>
                                <td>Production2</td>
                                <td>วิทยาลัยเทคนิคนางรอง</td>
                                <td>เชื่อมโลหะ</td>
                                <td>092-912-3641</td>
                                <td>ฝึกงานแล้ว</td>
                                <td>1</td>
                            </tr>
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
                    render: function(data, type, full, meta) {
                        return "\n\t\t\t\t\t\t<a href='javascript:void(0);' class='btn btn-sm btn-icon btn-outline-danger rounded-circle mr-1' title='Delete Record'>\n\t\t\t\t\t\t\t<i class=\"fal fa-times\"></i>\n\t\t\t\t\t\t</a>\n\t\t\t\t\t\t<div class='dropdown d-inline-block dropleft'>\n\t\t\t\t\t\t\t<a href='#'' class='btn btn-sm btn-icon btn-outline-primary rounded-circle shadow-0' data-toggle='dropdown' aria-expanded='true' title='More options'>\n\t\t\t\t\t\t\t\t<i class=\"fal fa-ellipsis-v\"></i>\n\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t<div class='dropdown-menu'>\n\t\t\t\t\t\t\t\t<a class='dropdown-item' href='javascript:void(0);'>Change Status</a>\n\t\t\t\t\t\t\t\t<a class='dropdown-item' href='javascript:void(0);'>Generate Report</a>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>";
                    },
                },

            ]

        });

    });
</script>
@endsection