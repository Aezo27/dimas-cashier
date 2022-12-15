<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('supplier.suppliers', [
            "title" => "Suppliers",
            "suppliers" => Supplier::all()
        ]);
    }

    public function add()
    {
        return view('supplier.tambah-supplier', [
            "title" => "Suppliers"
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request -> validate([
            'nama' => 'required|min:3|max:255',
            'alamat' => 'required|min:4|max:255',
            'email' => 'required|email:dns|unique:customers',
            'telepon' => 'required|max:20'
        ]);

        Supplier::Create($validateData);

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/suppliers')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function show(Supplier $supplier)
    {
        return view('supplier.supplier', [
            "title" => "Suppliers",
            "supplier" => $supplier
        ]);
    }

    public function update(Request $request, Supplier $supplier)
    {
        $rules = ([
            'nama' => 'required|min:3|max:255',
            'alamat' => 'required|min:4|max:255',
            'telepon' => 'required|min:5|max:20'
        ]);

        if($request->email != $supplier->email)
        {
            $rules['email'] = 'required|unique:customers';
        }

        $validateData = $request->validate($rules);
        
        Supplier::where('id', $supplier->id)->update($validateData);

        return redirect('/suppliers')->with('success', 'Supplier berhasil diubah!');
    }

    public function delete($id)
    {
        // User::destroy($user->id);
        Supplier::where('id', $id)->delete();

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/suppliers')->with('success', 'Supplier berhasil dihapus!');
    }
}
