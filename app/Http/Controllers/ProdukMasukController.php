<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukMasuk;
use App\Models\Supplier;
use App\Models\Item;

class ProdukMasukController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produkmasuks = ProdukMasuk::all();
        $suppliers = Supplier::all();
        $title = "Produk Masuk";
        $items = item::all();
    

        return view('produk_masuk.produk-masuk', compact("produkmasuks", "suppliers", "title", "items"));
    }

    public function add()
    {
        $suppliers = Supplier::all();
        $title = "Produk Masuk";
        $items = item::all();
    

        return view('produk_masuk.tambah-produk-masuk', compact("suppliers", "title", "items"));
    }
    
    public function store(Request $request, Item $item)
    {
        $rules = ([
            'supplier_id' => 'required',
            'produk_id' => 'required',
            'kuantitas' => 'required|min:3|max:255',
            'tanggal_masuk' => 'required'
        ]);

        

        $product = Item::findOrFail($request->produk_id);
        $product->kuantitas += $request->kuantitas;
        $product->save();

        // Item::where($request->produk_id, $item->id)->update($tot);
        $validateData = $request->validate($rules);

        ProdukMasuk::Create($validateData);

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/produk-masuk')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $title = "Produk Masuk";
        $produkmasuks = ProdukMasuk::where('id', $id)->first();
        $suppliers = Supplier::all();
        $items = item::all();

        return view('kategori', compact('title', 'produkmasuks', 'suppliers', 'items'));
    }

    public function delete($id)
    {
        // User::destroy($user->id);
        ProdukMasuk::where('id', $id)->delete();

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/produk-masuk')->with('success', 'Produk masuk berhasil dihapus!');
    }
}
