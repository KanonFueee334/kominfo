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
}