<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Laporan;
use App\Models\Customer;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class PenjualanController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Penjualan $penjualan, Request $request, Laporan $laporan)
  {
    $this->set_kasir(null);
    $penjualans = Penjualan::all();
    $customers = Customer::all();
    $title = "Transaksi";
    $items = item::all();

    return view('transaksi', compact("penjualans", "customers", "title", "items"));
  }

  public function set_kasir($id_barang)
  {
    $lifetime = time() + 60 * 60 * 24 * 365; // one year
    $id = hexdec(uniqid());
    $tanggal = Carbon::now();

    if (Cookie::get('transaksi') == null) {
      $data = [
        'id' => $id,
        'tanggal' => $tanggal->isoFormat('D MMMM Y'),
        'barang' => []
      ];
      $array_json = json_encode($data);
      Cookie::queue('transaksi', $array_json, $lifetime);
      return 'Data telah ditambahkan';
    } else {
      if ($id_barang != null) {
        $data = json_decode(Cookie::get('transaksi'), true);
        $barang =  item::where('id', $id_barang)->first();

        $data['barang'][$id_barang] = [
          "id" => $barang->id,
          "nama" => $barang->nama,
          "jumlah" => 1,
          "harga" => $barang->harga,
          "stok" => $barang->kuantitas,
          "total" => $barang->harga * 1
        ];
        $array_json = json_encode($data);
        Cookie::queue('transaksi', $array_json, $lifetime);
        return [
          'status'     => 'Data telah ditambahkan',
        ];
      }
      return 'Data telah ditambahkan';
    }
  }

  public function update_kasir(Request $request, $id_barang)
  {
    $lifetime = time() + 60 * 60 * 24 * 365; // one year
    $data = json_decode(Cookie::get('transaksi'), true);
    $barang =  item::where('id', $id_barang)->first();

    $data['barang'][$id_barang] = [
      "id" => $barang->id,
      "nama" => $barang->nama,
      "jumlah" => $request->jumlah,
      "harga" => $barang->harga,
      "stok" => $barang->kuantitas,
      "total" => $barang->harga * 1
    ];
    $array_json = json_encode($data);
    Cookie::queue('transaksi', $array_json, $lifetime);
    return [
      'status'     => 'Data telah ditambahkan',
    ];
  }

  public function delete_kasir($id_barang)
  {
    $lifetime = time() + 60 * 60 * 24 * 365; // one year
    $data = json_decode(Cookie::get('transaksi'), true);

    if ($data['barang'][$id_barang] != null) {
      unset($data['barang'][$id_barang]);
    }

    $array_json = json_encode($data);
    Cookie::queue('transaksi', $array_json, $lifetime);
    return [
      'status'     => 'Data telah Dihapus',
    ];
  }

  public function get_kasir_datatable()
  {
    $kasirs = json_decode($this->get_kasir(), true);
    $datas = $kasirs['barang'] != null ? $kasirs['barang'] : null;
    return view('kasir_datatable', compact('datas'));
  }

  public function get_kasir()
  {
    if (Cookie::get('transaksi') == null) {
      $this->set_kasir(null);
    } else {
      return Cookie::get('transaksi');
    }
  }

  public function store(Request $request, Item $item)
  {
    $rules = ([
      'no_invoice' => 'required',
      'produk_id' => 'required',
      'kuantitas' => 'required|max:255',
      'harga' => 'required',
      'subtotal' => 'max:20'
    ]);

    // $request->subtotal = $request->harga * $request->kuantitas;

    // dd($request->subtotal);



    $product = Item::findOrFail($request->produk_id);
    $product->kuantitas -= $request->kuantitas;
    $product->save();

    $validateData = $request->validate($rules);


    $validateData['subtotal'] = $validateData['harga'] * $validateData['kuantitas'];
    // dd($validateData);

    Penjualan::Create($validateData);

    // $request->session()->flash('success', 'Registrasi Berhasil! Silahkan Login!');

    return redirect('/transaksi')->with('success', 'Produk berhasil ditambahkan!');
  }

  public function get_barang(Request $request)
  {
    $records = item::where('nama', 'like', '%' . $request->search . '%')
      ->get();
    $data_arr = array();
    foreach ($records as $record) {
      $id = $record->id;
      $nama_barang = $record->nama;
      $harga = $record->harga;
      $stok = $record->kuantitas;

      $data_arr[] = array(
        "id" => $id,
        "text" => $nama_barang,
        "label" => $nama_barang,
        "harga_jual" => $harga,
        "stok" => $stok
      );
    }
    return json_encode($data_arr);
  }
}