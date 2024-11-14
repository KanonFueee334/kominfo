<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{

    public function index()
    {
        $userId = session('user_id');

        $absensiToday = DB::table(DB::raw("(SELECT time FROM `absensi` WHERE user_id = $userId AND DATE(time) = CURDATE()) as satu"))
                    ->select(DB::raw("DATE_FORMAT(MIN(satu.time),'%H:%i:%s') as masuk, DATE_FORMAT(MAX(satu.time),'%H:%i:%s') as pulang"))
                    ->get();

        $absenList = Absensi::select(DB::raw("DATE_FORMAT(time, '%d-%m-%Y') as tgl, DATE_FORMAT(time, '%H:%i:%s') as waktu"))
                    ->where('user_id',$userId)
                    ->orderBy('time','desc')
                    ->limit(5)
                    ->get();

        return view('home-magang',['absensiToday'=>$absensiToday, 'absenList'=>$absenList]);
    }

    public function saveAbsensi()
    {
        $userId = session('user_id');

        $absensi = new Absensi();
        $absensi->user_id = $userId;
        $absensi->time = date('Y-m-d H:i:s');
        $absensi->save();

        // Flash a success message to the session
        session()->flash('success', 'Berhasil menyimpan absensi.');

        // Redirect back to the previous page or to a specific route
        return redirect()->back();
    }

    public function history()
    {
        $userId = session('user_id');

        $absenList = Absensi::select(DB::raw("DATE_FORMAT(time, '%d-%m-%Y') as tgl, DATE_FORMAT(time, '%H:%i:%s') as waktu"))
                    ->where('user_id',$userId)
                    ->orderBy('time','desc')
                    ->get();

        return view('absensi-history',['absenList'=>$absenList]);
    }

    public function recap($dateStart, $dateEnd)
    {
        $userId = session('user_id');
        $data = [];

        if(!empty($dateStart) && !empty($dateEnd)){
            $query = "SELECT cal.*, absen.* 
            FROM
            (WITH RECURSIVE DateRange AS (
            SELECT '".$dateStart."' AS date
            UNION ALL
            SELECT date + INTERVAL 1 DAY
            FROM DateRange
            WHERE date < '".$dateEnd."'
            )
            SELECT date AS tgl
            FROM DateRange) cal
            LEFT JOIN
            (SELECT IF(a.user_id IS NULL, b.user_id, a.user_id) AS user_id, IF(a.tgl IS NULL, b.leave_date, a.tgl) AS tgl_absen, a.masuk, a.pulang, a.terlambat, a.cepat_pulang, b.user_id AS usr_id, b.leave_date AS tgl_izin, b.type, b.note, b.letter
            FROM absensi_recap_view a
            LEFT JOIN izin b ON a.user_id = b.user_id AND STR_TO_DATE(a.tgl, '%d-%m-%Y') = b.leave_date
            WHERE a.user_id = ".$userId."
            UNION
            SELECT IF(a.user_id IS NULL, b.user_id, a.user_id) AS user_id, IF(a.tgl IS NULL, b.leave_date, a.tgl) AS tgl_absen, a.masuk, a.pulang, a.terlambat, a.cepat_pulang, b.user_id AS usr_id, b.leave_date AS tgl_izin, b.type, b.note, b.letter
            FROM absensi_recap_view a
            RIGHT JOIN izin b ON a.user_id = b.user_id AND STR_TO_DATE(a.tgl, '%d-%m-%Y') = b.leave_date
            WHERE b.user_id = ".$userId."
            ORDER BY tgl_absen ASC) absen
            ON cal.tgl = absen.tgl_absen;";

            $data = DB::select($query);
        }
        
        return view('absensi-recap', ['data'=>$data]);
    }

    public function recapMonthly(Request $request)
    {
        $year = $request->input('input-year');
        $month = $request->input('input-month');

        $dateStart = $this->createDateFormat($year,$month,'01');
        $dateEnd = $this->createDateFormat('0000','00','00');

        switch ($month) {
            case '1':
            case '3':
            case '5':
            case '7':
            case '8':
            case '10':
            case '12':
                $dateEnd = $this->createDateFormat($year,$month,'31');
                break;
            case '4':
            case '6':
            case '9':
            case '11':
                $dateEnd = $this->createDateFormat($year,$month,'30');
                break;
            default:
                if($this->isLeapYear($year)){
                    $dateEnd = $this->createDateFormat($year,$month,'29');
                }else{
                    $dateEnd = $this->createDateFormat($year,$month,'28');
                }
                break;
        }

        return redirect()->route('mg.recap',['start'=>$dateStart, 'end'=>$dateEnd])->withInput($request->all());
    }

    private function createDateFormat($year, $month, $date){
        return $year.'-'.str_pad($month,2,"0",STR_PAD_LEFT).'-'.$date;
    }

    private function isLeapYear($year) {
    if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
        return true;
    } else {
        return false;
    }
}
}