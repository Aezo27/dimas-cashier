<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {

        return view('user.penggunas', [
            "title" => "Data Pengguna",
            "users" => User::all()
        ]);
    }

    public function show(User $user)
    {
        

        return view('user.pengguna', [
            "title" => "Data Pengguna",
            "user" => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = ([
            'level' => 'max:20'
        ]);
        $validateData = $request->validate($rules);
        
        User::where('id', $user->id)->update($validateData);

        return redirect('/penggunas')->with('success', 'Role user berhasil diubah!');
    }

    public function delete($id)
    {
        // User::destroy($user->id);
        User::where('id', $id)->delete();
        return redirect('/penggunas')->with('success', 'User berhasil dihapus!');
    }
       
}
