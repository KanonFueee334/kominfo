<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request){

        // Validate the incoming request data
        $validatedData = $request->validate([
            'nama_pengguna' => 'required|string',
            'kata_sandi' => 'required|string',
        ], [
            'nama_pengguna.required' => 'Username tidak boleh kosong',
            'kata_sandi.required' => 'Password tidak boleh kosong'
        ]);
        
        $username = $request->input('nama_pengguna');
        $password = $request->input('kata_sandi');

        $user = User::select('id','name','password')
            ->where('status',1)
            ->where('username',$username)
            ->first();

        if($user){

            $md5_pass = md5($password);
            if($md5_pass == $user['password']){
                $sesData = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'logged_in' => true
                ];

                session($sesData);

                return redirect()->route('be.home');
                //protected $redirectTo = 'be.home';
            }else{
                session()->flash('error', 'Password salah');
                return redirect()->back();
            }

        } else {
            session()->flash('error', 'Username tidak ditemukan');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush(); // Menghapus semua data di session
        return redirect('login');
    }
}
