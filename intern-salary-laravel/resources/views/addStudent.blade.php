@extends('layout')

@section('title', 'เพิ่มนักศึกษาฝึกงาน')
@section('subtitle', 'เพิ่มนักศึกษาฝึกงาน')

@section('content')
@error('id')
<div class="alert alert-danger" role="alert">
    <strong>เกิดข้อผิดพลาด!</strong> รหัสซ้ำ
</div>
@enderror
<div class="card">
    <div class="card-header bg-info-50">
        <div class="card-title">กรอกข้อมูล</div>
    </div>
    <div class="card-body">
        <form action="/add-student" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">รหัส</label>
                <input type="text" class="form-control" name="id" require>
            </div>
            <div class="form-group">
                <label class="form-label">ชื่อ - สกุล</label>
                <input type="text" class="form-control" name="name" require>
            </div>
            <div class="form-group">
                <label class="form-label">แผนก</label>
                <select class="form-control" name="department">
                    @foreach ($departments as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">สังกัด</label>
                <input type="text" class="form-control" name="under">
            </div>
            <div class="form-group">
                <label class="form-label">สถาบัน</label>
                <input type="text" class="form-control" name="institution" require>
            </div>
            <div class="form-group">
                <label class="form-label">สาขาวิชา</label>
                <input type="text" class="form-control" name="field" require>
            </div>
            <div class="form-group">
                <label class="form-label">ชั้น</label>
                <input type="text" class="form-control" name="degree" require>
            </div>
            <label class="form-label ">เริ่มฝึกวันที่</label>
            <div class="form-group row">
                <div class="col-12">
                    <div class="input-daterange input-group" id="datepicker">
                        <input type="text" class="form-control" name="start">
                        <div class="input-group-append input-group-prepend">
                            <span class="input-group-text" style="font-size:0.7rem;">ถึง</span>
                        </div>
                        <input type="text" class="form-control" name="end">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">เบี้ยเลี้ยง</label>
                <input type="number" class="form-control" name="earning" require>
            </div>
            <div class="form-group">
                <label class="form-label">หมายเลขโทรศัพท์</label>
                <input type="text" class="form-control" name="tel" require>
            </div>
            <button type="submit" class="btn btn-primary waves-effect waves-themed">เพิ่ม</button>
        </form>
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

        // range picker
        $('#datepicker').datepicker({
            todayHighlight: true,
            templates: controls,
            format: 'yyyy-mm-dd'
        });
    }

    $(document).ready(function() {
        runDatePicker();
    });
</script>
@endsection