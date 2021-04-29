@extends('layout')

@section('title', 'ตั้งค่าบัญชีผู้ใช้')
@section('subtitle', 'ตั้งค่าบัญชีผู้ใช้')

@section('content')
@error('password')
<div class="alert alert-danger" role="alert">
    <strong>เกิดข้อผิดพลาด!</strong> โปรดลองอีกครั้ง
</div>
@enderror
@error('success')
<div class="alert alert-success" role="alert">
    <strong>เปลี่ยนรหัสผ่านเสร็จสิ้น!</strong>
</div>
@enderror
<div class="card">
    <div class="card-header bg-danger-50">
        <div class="card-title">เปลี่ยนรหัสผ่าน</div>
    </div>
    <div class="card-body">
        <form action="/user" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">รหัสผ่านปัจจุบัน</label>
                <input type="password" class="form-control" name="password" require>
            </div>
            <div class="form-group">
                <label class="form-label">รหัสผ่านใหม่</label>
                <input type="password" class="form-control" name="newpassword1" require>
            </div>
            <div class="form-group">
                <label class="form-label">ยืนยันอีกครั้ง</label>
                <input type="password" class="form-control" name="newpassword2" require>
            </div>
            <button type="submit" class="btn btn-primary waves-effect waves-themed">เปลี่ยนรหัสผ่าน</button>
        </form>
    </div>
</div>
@endsection