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
            'g-recaptcha-response' => 'required'
        ], [
            'nama_pengguna.required' => 'Username tidak boleh kosong',
            'kata_sandi.required' => 'Password tidak boleh kosong',
            'g-recaptcha-response.required' => 'reCAPTCHA belum tercentang'
        ]);

        // reCAPTCHA checking
        $input_captcha = $request->input('g-recaptcha-response');
        $secretKey = "6LfRv3cqAAAAAJaE10wEZJ0U6FfQeYc84eObS-EL";
        $ip = $_SERVER['REMOTE_ADDR'];

        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($input_captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);

        // should return JSON with success as true
        if($responseKeys["success"]) {
            $username = $request->input('nama_pengguna');
            $password = $request->input('kata_sandi');

            $user = User::select('id','name','password','role')
                ->where('status',1)
                ->where('username',$username)
                ->first();

            if($user){

                $md5_pass = md5($password);
                if($md5_pass == $user['password']){
                    Auth::login($user);

                    return redirect()->intended('/be-home');
                }else{
                    session()->flash('error', 'Password salah');
                    return redirect()->back();
                }

            } else {
                session()->flash('error', 'Username tidak ditemukan');
                return redirect()->back();
            }
        } else {
            // spam
            $session->setFlashdata('error', 'Anda terdeteksi SPAM');
            return redirect()->back();
        }
        
        // 6LfRv3cqAAAAAJaE10wEZJ0U6FfQeYc84eObS-EL

    }

    public function logout()
    {
        Auth::logout();
        session()->flush(); // Menghapus semua data di session
        return redirect('login');
    }
}
