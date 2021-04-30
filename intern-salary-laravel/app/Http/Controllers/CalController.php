<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalController extends Controller
{
    public function adminlist(Request $request)
    {
        $ym = DB::select("
        select distinct(DATE_FORMAT(date,'%Y-%m')) as ym, year(date) as year, month(date) as month
        from work_record
        ");
        // return $ym;

        return view('callist', ['yms' => $ym]);
    }

    public function userlist(Request $request)
    {
        $ym = DB::select("
        select distinct(DATE_FORMAT(date,'%Y-%m')) as ym, year(date) as year, month(date) as month
        from work_record
        ");
        // return $ym;

        return view('salarylist', ['yms' => $ym]);
    }

    public function export($year, $month, $p, Request $request) {
        if ($p == 1) {
            $data = DB::select("
            SELECT y.id, y.name, TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(x.checkout, x.checkin)))), \"%H:%i\") AS time, ( SUM(TIME_TO_SEC(TIMEDIFF(x.checkout, x.checkin))) / 60 / 60) * (y.earning / 8) AS salary
            FROM work_record AS x, interner AS y
            WHERE YEAR(x.date) = $year AND MONTH(x.date) = $month AND DAY(x.date) < 16 AND x.interner = y.id AND isLeave = false
            GROUP BY x.interner
            ");
            return view('salary',['title' => "ค่าเบี้ยเลี้ยงนักศึกษาฝึกงาน ต้นเดือน $month-$year", 'data' => $data]);
        } elseif ($p == 2) {
            $data = DB::select("
            SELECT y.id, y.name, TIME_FORMAT(SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(x.checkout, x.checkin)))), \"%H:%i\") AS time, ( SUM(TIME_TO_SEC(TIMEDIFF(x.checkout, x.checkin))) / 60 / 60) * (y.earning / 8) AS salary
            FROM work_record AS x, interner AS y
            WHERE YEAR(x.date) = $year AND MONTH(x.date) = $month AND DAY(x.date) > 15 AND x.interner = y.id AND isLeave = false
            GROUP BY x.interner
            ");
            return view('salary',['title' => "ค่าเบี้ยเลี้ยงนักศึกษาฝึกงาน สิ้นเดือน $month-$year", 'data' => $data]);
        }else {
            return back();
        }
        
    }
}
