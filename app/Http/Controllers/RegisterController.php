<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }

    public function index()
    {
        return view('register.index', [
            'title' => 'Data Pengguna',
            'active' => 'register'
        ]);
    }

    public function tambah()
    {
        return view('user.tambah-pengguna', [
            'title' => 'Data Pengguna',
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request -> validate([
            'email' => 'required|unique:users',
            'name' => 'required|min:3|max:255',
            'password' => 'min:5|max:255|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:5|max:255',
            'level' => 'max:255'
        ]);

        

        if($request->password === $request->confirm_password)
        {
            $validateData['password'] = Hash::make($validateData['password']);
        }
        


        User::Create($validateData);

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/login')->with('success', 'Berhasil Registrasi, silahkan tunggu konfirmasi dari Admin!');
    }

    public function store2(Request $request)
    {
        $validateData = $request -> validate([
            'email' => 'required|unique:users',
            'name' => 'required|min:3|max:255',
            'password' => 'required|min:5|max:255',
            'level' => 'required|min:5|max:255'
        ]);
        
        $validateData['password'] = Hash::make($validateData['password']);

        User::Create($validateData);

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/penggunas')->with('success', 'User berhasil ditambahkan!');
    }
}
