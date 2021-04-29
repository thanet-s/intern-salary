<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function departmentList(Request $request)
    {
        $departments = DB::select('select id, name from department');
        return view('department', ['departments' => $departments]);
    }

    public function addDepartment(Request $request)
    {
        $name = $request->input('name');
        $names = DB::select("select name from department");
        foreach ($names as $n) {
            if ($n->name == $name) {
                return back()->withErrors(['name' => "name exists"]);
            }
        }
        DB::insert("insert into department (name) values (\"$name\")");
        return back()->withErrors(['addsuccess' => "Ok"]);
    }

    public function removeDepartment(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');
        $deleted = DB::delete("delete from department where id = $id");

        return back()->withErrors(['remove' => "ลบ $name แล้ว"]);
    }

    public function editDepartment(Request $request)
    {
        $name = $request->input('name');
        $names = DB::select("select name from department");
        $id = $request->input('id');
        foreach ($names as $n) {
            if ($n->name == $name) {
                return back()->withErrors(['name' => "name exists"]);
            }
        }
        DB::update("update department set name = \"$name\" where id = $id");
        return back()->withErrors(['edit' => "แก้ไขเรียบร้อย"]);
    }
}
