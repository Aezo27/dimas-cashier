<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukKeluar;
use App\Models\Customer;
use App\Models\Item;

class ProdukKeluarController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produkkeluars = ProdukKeluar::all();
        $customers = Customer::all();
        $title = "Produk Keluar";
        $items = item::all();

        return view('produk_keluar.produk-keluar', compact("produkkeluars", "customers", "title", "items"));
    }

    public function add()
    {
        $customers = Customer::all();
        $title = "Produk Keluar";
        $items = item::all();
    

        return view('produk_keluar.tambah-produk-keluar', compact("customers", "title", "items"));
    }
    
    public function store(Request $request, Item $item)
    {
        $rules = ([
            'customer_id' => 'required',
            'produk_id' => 'required',
            'kuantitas' => 'required|max:255',
            'tanggal_keluar' => 'required'
        ]);

        

        $product = Item::findOrFail($request->produk_id);
        $product->kuantitas -= $request->kuantitas;
        $product->save();

        // Item::where($request->produk_id, $item->id)->update($tot);
        $validateData = $request->validate($rules);

        ProdukKeluar::Create($validateData);

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/produk-keluar')->with('success', 'Produk berhasil ditambahkan!');
    }
}
