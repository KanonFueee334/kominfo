<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::select('id','name','status','role')
            ->orderBy('status','desc')
            ->orderBy('name','asc')
            ->get();
        return view('user-management',['users'=>$users]);
    }

    public function addUserSave(Request $request){
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        // Validate the incoming request data
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'name' => 'required|string',
            'role' => 'required|in:admin,magang'
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'role.required' => 'Role harus dipilih',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $name = $request->input('name');
        $dob = $request->input('date-birth');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $institution = $request->input('institution');
        $role = $request->input('role', 'magang');

        $user = new User();
        $user->username = $validatedData['username'];
        $user->password = bcrypt($password);
        $user->name = $name;
        $user->birth_date = $dob;
        $user->address = $address;
        $user->phone = $phone;
        $user->institution = $institution;
        $user->role = $role;
        $user->status = 1;
        $user->save();
        
        // Flash a success message to the session
        session()->flash('success', 'Berhasil menambahkan pengguna baru.');
        return redirect()->route('be.um');
    }

    public function editUserForm($id) {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function editUserSave(Request $request, $id) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $validatedData = $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'role' => 'required|in:admin,magang',
        ], [
            'username.required' => 'Username tidak boleh kosong',
            'name.required' => 'Nama tidak boleh kosong',
            'role.required' => 'Role harus dipilih',
        ]);

        $user = User::findOrFail($id);
        $user->username = $validatedData['username'];
        $user->name = $validatedData['name'];
        $user->birth_date = $request->input('date-birth');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->institution = $request->input('institution');
        $user->role = $request->input('role', 'magang');
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }
        $user->status = $request->input('status', $user->status);
        $user->save();

        session()->flash('success', 'Berhasil mengubah data pengguna.');
        return redirect()->route('be.um');
    }

    public function editUserPage($id) {
        $user = User::findOrFail($id);
        return view('edit-user', ['user' => $user]);
    }

    public function deleteUser($id) {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $user = User::findOrFail($id);
        if ($user->status == 0) {
            $user->delete();
            session()->flash('success', 'Pengguna berhasil dihapus.');
        } else {
            session()->flash('error', 'Pengguna hanya dapat dihapus jika sudah inaktif.');
        }
        return redirect()->back();
    }
}
