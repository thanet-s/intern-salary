<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use \PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class InternController extends Controller
{
    public function form(Request $request)
    {
        $departments = DB::select("select * from department");
        return view('addStudent', ['departments' => $departments]);
    }

    public function userdashboard(Request $request)
    {
        $interners = DB::select("
        SELECT x.id, x.name, y.name AS department, x.under, x.institution, x.field, x.degree, x.start, x.end, x.earning, x.tel, x.pass
        FROM interner AS x
        INNER JOIN department AS y
        ON x.departmentId = y.id
        ");
        // $dumy = [];
        // for ($i=0;$i<500;$i++){
        //     foreach ($interners as $j){
        //         array_push($ff, $j);
        //     }
        // }
        // return view('dashboard', ['interners' => $dumy]);
        return view('home', ['interners' => $interners]);
    }

    public function admindashboard(Request $request)
    {
        $interners = DB::select("
        SELECT x.id, x.name, y.name AS department, x.under, x.institution, x.field, x.degree, x.start, x.end, x.earning, x.tel, x.pass
        FROM interner AS x
        INNER JOIN department AS y
        ON x.departmentId = y.id
        ");
        // $dumy = [];
        // for ($i=0;$i<500;$i++){
        //     foreach ($interners as $j){
        //         array_push($ff, $j);
        //     }
        // }
        // return view('dashboard', ['interners' => $dumy]);

        $departments = DB::select("select * from department");
        return view('dashboard', ['interners' => $interners, 'departments' => $departments]);
    }

    public function add(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $department = $request->input('department');
        $under = $request->input('under');
        $institution = $request->input('institution');
        $field = $request->input('field');
        $degree = $request->input('degree');
        $start = $request->input('start');
        $end = $request->input('end');
        $earning = $request->input('earning');
        $tel = $request->input('tel');
        $ids = DB::select('select id from interner');

        foreach ($ids as $i) {
            if ($i->id == $id) {
                return back()->withErrors(['id' => 'id does exists']);
            }
        }

        DB::insert("insert into interner values (\"$id\", \"$name\", $department, \"$under\", \"$institution\", \"$field\", \"$degree\", \"$start\", \"$end\", $earning, \"$tel\", false)");

        return redirect()->route('dashboard')->withErrors(['addsuccess' => 'ok',]);
    }

    public function remove(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');

        $deleted = DB::delete("delete from interner where id = \"$id\"");

        return back()->withErrors(['remove' => "ลบ $name แล้ว"]);
    }

    public function edit(Request $request)
    {
        $oid = $request->input('oid');
        $id = $request->input('id');
        $name = $request->input('name');
        $department = $request->input('department');
        $under = $request->input('under');
        $institution = $request->input('institution');
        $field = $request->input('field');
        $degree = $request->input('degree');
        $start = $request->input('start');
        $end = $request->input('end');
        $earning = $request->input('earning');
        $tel = $request->input('tel');
        $pass = $request->input('pass');

        DB::update("
        update interner
        set id = \"$id\", name = \"$name\", departmentId = $department, under = \"$under\", institution = \"$institution\", field = \"$field\", degree = \"$degree\", start = \"$start\", end = \"$end\", earning = $earning, tel = \"$tel\", pass = $pass
        where id = \"$oid\"
        ");

        return redirect()->route('dashboard')->withErrors(['edit' => "แก้ไข $name แล้ว",]);
    }

    public function leave(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $date = $request->input('date');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');

        DB::insert("insert into work_record (interner, isLeave, date, checkin, checkout) values (\"$id\", true, \"$date\", \"$checkin:00\", \"$checkout:00\")");

        return redirect()->route('dashboard')->withErrors(['leave' => "เพิ่มการลาให้ $name แล้ว"]);
    }

    public function userdetail($id, Request $request)
    {
        $interners = DB::select("
        SELECT x.id, x.name, y.name AS department, x.under, x.institution, x.field, x.degree, x.start, x.end, x.earning, x.tel, x.pass
        FROM interner AS x
        INNER JOIN department AS y
        ON x.departmentId = y.id
        WHERE x.id = \"$id\"
        ");
        $working = DB::select("
        SELECT id, date, checkin, checkout, TIMEDIFF(checkout, checkin) AS time
        FROM work_record
        WHERE interner = \"$id\" AND isLeave = false
        ");
        $leave = DB::select("
        SELECT id, date, checkin, checkout, TIMEDIFF(checkout, checkin) AS time
        FROM work_record
        WHERE interner = \"$id\" AND isLeave = true
        ");
        $user = $interners[0];
        return view('userinternerdetail', ['user' => $user, 'working' => $working, 'leave' => $leave]);
    }

    public function admindetail($id, Request $request)
    {
        $interners = DB::select("
        SELECT x.id, x.name, y.name AS department, x.under, x.institution, x.field, x.degree, x.start, x.end, x.earning, x.tel, x.pass
        FROM interner AS x
        INNER JOIN department AS y
        ON x.departmentId = y.id
        WHERE x.id = \"$id\"
        ");
        $working = DB::select("
        SELECT id, date, checkin, checkout, TIMEDIFF(checkout, checkin) AS time
        FROM work_record
        WHERE interner = \"$id\" AND isLeave = false
        ");
        $leave = DB::select("
        SELECT id, date, checkin, checkout, TIMEDIFF(checkout, checkin) AS time
        FROM work_record
        WHERE interner = \"$id\" AND isLeave = true
        ");
        $user = $interners[0];
        return view('internerDetail', ['user' => $user, 'working' => $working, 'leave' => $leave]);
    }

    public function removeWork(Request $request)
    {
        $id = $request->input('id');

        $deleted = DB::delete("delete from work_record where id = $id");

        return back()->withErrors(['remove' => "ลบบันทึกแล้ว"]);
    }

    public function importform(Request $request)
    {
        return view('import');
    }

    public function upload(Request $request)
    {
        if ($request->file != null) {
            $path = Storage::putFile('xlsx', $request->file('file'));
            $reader = new Xlsx();
            $spreadsheet = $reader->load(Storage::path($path));
            Storage::delete($path);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, false);
            foreach ($sheetData as $r) {
                if ($r[0] == null) {
                    break;
                }
                DB::insert("INSERT INTO `work_record` (`interner`, `isLeave`, `date`, `checkin`, `checkout`) VALUES (\"$r[0]\", false, \"$r[1]\", \"$r[2]\", \"$r[3]\")");
            }
            return redirect()->route('import')->withErrors(['success' => "OK"]);
        } else {
            return redirect()->route('import')->withErrors(['error' => "กรุณาเลือกไฟล์ก่อนอัพโหลด"]);
        }
    }
}
