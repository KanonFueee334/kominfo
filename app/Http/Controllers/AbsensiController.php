<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{

    public function index()
    {
        $userId = 3;

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
        $userId = 3;

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
        $userId = 3;

        $absenList = Absensi::select(DB::raw("DATE_FORMAT(time, '%d-%m-%Y') as tgl, DATE_FORMAT(time, '%H:%i:%s') as waktu"))
                    ->where('user_id',$userId)
                    ->orderBy('time','desc')
                    ->get();

        return view('absensi-history',['absenList'=>$absenList]);
    }

    public function recap()
    {
        $userId = 3;

        $query = "SELECT cal.*, absen.*
FROM
(WITH RECURSIVE DateRange AS (
SELECT '2024-09-01' AS date
UNION ALL
SELECT date + INTERVAL 1 DAY
FROM DateRange
WHERE date < '2024-09-30'
)
SELECT date AS tgl
FROM DateRange) cal
LEFT JOIN
(SELECT IF(a.user_id IS NULL, b.user_id, a.user_id) AS user_id, IF(a.tgl IS NULL, b.leave_date, STR_TO_DATE(a.tgl, '%d-%m-%Y')) AS tgl_absen, a.masuk, a.pulang, a.terlambat, a.cepat_pulang, b.user_id AS usr_id, b.leave_date AS tgl_izin, b.type, b.note, b.letter
FROM absensi_recap_view a
LEFT JOIN izin b ON a.user_id = b.user_id AND STR_TO_DATE(a.tgl, '%d-%m-%Y') = b.leave_date
WHERE a.user_id = 3
UNION
SELECT IF(a.user_id IS NULL, b.user_id, a.user_id) AS user_id, IF(a.tgl IS NULL, b.leave_date, STR_TO_DATE(a.tgl, '%d-%m-%Y')) AS tgl_absen, a.masuk, a.pulang, a.terlambat, a.cepat_pulang, b.user_id AS usr_id, b.leave_date AS tgl_izin, b.type, b.note, b.letter
FROM absensi_recap_view a
RIGHT JOIN izin b ON a.user_id = b.user_id AND STR_TO_DATE(a.tgl, '%d-%m-%Y') = b.leave_date
WHERE b.user_id = 3
ORDER BY tgl_absen ASC) absen
ON cal.tgl = absen.tgl_absen;";

        $data = DB::select($query);

        return view('absensi-recap', ['data'=>$data]);
    }
}