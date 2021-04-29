@extends('layout')

@section('title', 'เพิ่มแอดมิน')
@section('subtitle', 'เพิ่มแอดมิน')

@section('content')
@error('email')
<div class="alert alert-danger" role="alert">
    <strong>เกิดข้อผิดพลาด!</strong> อีเมลซ้ำ
</div>
@enderror
@error('pass')
<div class="alert alert-danger" role="alert">
    <strong>เกิดข้อผิดพลาด!</strong> รหัสผ่านไม่ตรงกัน
</div>
@enderror
<div class="card">
    <div class="card-header bg-info-50">
        <div class="card-title">กรอกข้อมูล</div>
    </div>
    <div class="card-body">
        <form action="/add-admin" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="name" require>
            </div>
            <div class="form-group">
                <label class="form-label">อีเมล</label>
                <input type="email" class="form-control" name="email" require>
            </div>
            <div class="form-group">
                <label class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="password1" require>
            </div>
            <div class="form-group">
                <label class="form-label">ยืนยันรหัสผ่าน</label>
                <input type="password" class="form-control" name="password2" require>
            </div>
            <button type="submit" class="btn btn-primary waves-effect waves-themed">เพิ่ม</button>
        </form>
    </div>
</div>
@endsection