<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class itemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kategoris = Kategori::all();
        $title = "Data Barang";
        $items = item::all();
    

        return view('item.items', compact("kategoris", "title", "items"));
    }

    public function show(Item $item)
    {
     
        $kategoris = Kategori::all();
        return view('item.item', [
            "title" => "Data Barang",
            "item" => $item,
            "kategoris" => $kategoris
        ]);
    }

    public function add()
    {
        $kategoris = Kategori::all();
        return view('item.tambah-barang', [
            "title" => "Data Barang",
            "kategoris" => $kategoris
        ]);
    }

    public function store(Request $request)
    {
        // return $request->file('gambar')->store('gambar-produk');
        $validateData = $request -> validate([
            'nama' => 'required|min:3|max:255|unique:items',
            'harga' => 'required|min:3|max:255',
            'kuantitas' => 'required|min:3|max:255',
            'gambar' => 'image|file|max:5120',
            'kategori_id' => 'required|max:20'
        ]);

        DB::beginTransaction();
        try {
            $validateData['slug'] = urlencode($validateData['nama']);
            if ($request->file('gambar') != null) {
                $name = str_replace(
                    ' ',
                    '_',
                    $request->nama
                );
                $img = $name . '.' . $request->file('gambar')->extension();
                $request->file('gambar')->storeAs('public/gambar_produk', $img);
            } else {
                $img = null;
            }
            $validateData['gambar'] = $img;

            Item::Create($validateData);
            
            DB::commit();
            return redirect('/items')->with('success', 'barang berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            File::delete(storage_path('app/public') . '/' . $img);
            return redirect('/items')->with('error', 'barang gagal ditambahkan!');
        }
    }

    public function delete($id)
    {
        // User::destroy($user->id);
        $item = Item::findOrFail($id);
        File::delete(storage_path('app/public') . '/' . $item->gambar);
        $item->delete();

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/items')->with('success', 'Produk berhasil dihapus!');
    }

    // public function item()
    // {
    //     $kategoris = Kategori::all();
    //     return view('item', compact('kategoris'));
    // }

    public function update(Request $request, Item $item)
    {
        $rules = ([
            'nama' => 'required|min:3|max:255',
            'harga' => 'required|min:3|max:255',
            'kuantitas' => 'required|max:255',
            'gambar' => 'image|file|max:5120',
            'kategori_id' => 'required|max:20'
        ]);

        if($request->nama != $item->nama)
        {
            $validateData['nama'] = 'required|min:3|max:255|unique:items';
            $validateData['slug'] = urlencode($validateData['nama']);
        }

        $validateData = $request -> validate($rules);

        if($request->file('gambar')){
            $validateData['gambar'] = $request->file('gambar')->store('gambar-produk');
        }
        
        Item::where('slug', $item->slug)->update($validateData);

        return redirect('/customers')->with('success', 'Customer berhasil diubah!');
    }

}