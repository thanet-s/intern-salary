@extends('layout')

@section('title', 'นำเข้าข้อมูลการทำงาน')
@section('subtitle', 'นำเข้าข้อมูลการทำงาน')

@section('content')
@error('error')
<div class="alert alert-danger" role="alert">
    <strong>{{ $message }}</strong>
</div>
@enderror
@error('success')
<div class="alert alert-success" role="alert">
    <strong>เพิ่มข้อมูลเรียบร้อย</strong>
</div>
@enderror
<div class="card">
    <div class="card-header bg-info-50">
        <div class="card-title">อัพโหลดไฟล์</div>
    </div>
    <div class="card-body">
        <form action="/import-data" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label">ไฟล์</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" accept=".xlsx" onchange="filename()" name="file">
                    <label class="custom-file-label" for="customFile" id="ll">เลือกไฟล์</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary waves-effect waves-themed">อัพโหลด</button>
        </form>
    </div>
</div>
@endsection
@section('tableSetting')
<script>
    function filename() {
        var x = document.getElementById("customFile");
        if ('files' in x) {
            if (x.files.length == 0) {
                txt = "เลือกไฟล์";
            } else {
                txt = x.files[0].name;
            }
        }
        document.getElementById("ll").innerHTML = txt;
    }
</script>
@endsection