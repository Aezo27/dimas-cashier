<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('customer.customers', [
            "title" => "Customers",
            "customers" => Customer::all()
        ]);
    }

    public function show(Customer $customer)
    {
        return view('customer.customer', [
            "title" => "Customers",
            "customer" => $customer
        ]);
    }

    public function add()
    {
        return view('customer.tambah-customer', [
            "title" => "Customers"
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

        Customer::Create($validateData);

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/customers')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function delete($id)
    {
        // User::destroy($user->id);
        Customer::where('id', $id)->delete();

        // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

        return redirect('/customers')->with('success', 'Customer berhasil dihapus!');
    }

    public function update(Request $request, Customer $customer)
    {
        $rules = ([
            'nama' => 'required|min:3|max:255',
            'alamat' => 'required|min:4|max:255',
            'telepon' => 'required|min:5|max:20'
        ]);

        if($request->email != $customer->email)
        {
            $rules['email'] = 'required|unique:customers';
        }

        $validateData = $request->validate($rules);

        
        Customer::where('id', $customer->id)->update($validateData);

        return redirect('/customers')->with('success', 'Customer berhasil diubah!');
    }
}
