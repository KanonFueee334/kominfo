<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::select('id','name','status')
            ->orderBy('status','desc')
            ->orderBy('name','asc')
            ->get();
        return view('user-management',['users'=>$users]);
    }

    public function addUserSave(Request $request){
        // Validate the incoming request data
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
        ]);

         $username = $request->input('username');
         $password = $request->input('password');
         $name = $request->input('name');
         $dob = $request->input('date-birth');
         $address = $request->input('address');
         $phone = $request->input('phone');
         $institution = $request->input('institution');

         $user = new User();
         $user->username = $validatedData['username'];
         $user->password = $password;
         $user->name = $name;
         $user->birth_date = $dob;
         $user->address = $address;
         $user->phone = $phone;
         $user->institution = $institution;
         $user->status = 1;
         $user->save();
         
         // Flash a success message to the session
        session()->flash('success', 'Berhasil menambahkan pengguna baru.');

        // Redirect back to the previous page or to a specific route
        return redirect()->back();
    }
}
