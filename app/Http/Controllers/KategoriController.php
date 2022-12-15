<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('kategori.kategoris', [
            "title" => "Kategori",
            "kategoris" => Kategori::all()
            
        ]);
    }

    public function show($id)
    {
        $title = "Kategori";
        $kategoris = Kategori::where('id', $id)->first();

        return view('kategori.kategori', compact('title', 'kategoris'));
    }

    public function add()
    {
        return view('kategori.tambah-kategori', [
            "title" => "Kategori",
            
        ]);
    }

    
    public function store(Request $request)
    {

        $validateData = $request -> validate([
            'nama' => 'required|min:3|max:255|unique:kategoris'
        ]);
        
        // $validateData['slug'] = urlencode($validateData['nama']);

        Kategori::Create($validateData);

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/kategoris')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function delete($id)
    {
        // User::destroy($user->id);
        Kategori::where('id', $id)->delete();

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/kategoris')->with('success', 'Kategori berhasil dihapus!');
    }

    public function update(Request $request, Kategori $kategori)
    {

        $rules = ([
            'nama' => 'required|min:3|max:255',
            'id' => 'max:5'
        ]);

        $validateData = $request->validate($rules);

        // if($request->nama != $kategori->nama)
        // {
        //     $rules['nama'] = 'required|unique:kategoris';
        // }

        // Kategori::where('id', $kategori->id)->update($validateData);

        Kategori::where('id', $kategori->id)->update($validateData);
        // dd($validateData);

        return redirect('/kategoris')->with('success', 'Kategori berhasil diubah!');
    }
}
