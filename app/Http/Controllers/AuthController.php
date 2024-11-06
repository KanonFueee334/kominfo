<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function auth(Request $request){
        
        $username = $request->input('nama_pengguna');
        $password = $request->input('kata_sandi');

        $user = User::select('id','name','password')
            ->where('status',1)
            ->where('username',$username)
            ->first();

        if($user){

            if($password == $user['password']){
                $sesData = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'logged_in' => true
                ];

                session($sesData);

                return redirect()->route('be.home');
            }else{
                session()->flash('error', 'Password salah');
                return redirect()->back();
            }

        } else {
            session()->flash('error', 'Username tidak ditemukan');
            return redirect()->back();
        }
    }
}
