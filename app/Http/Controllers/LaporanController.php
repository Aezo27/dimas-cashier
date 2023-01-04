<?php

namespace App\Http\Controllers;

use App\Exports\KeluarExport;
use App\Exports\MasukExport;
use App\Models\Lap_jual;
use App\Models\Lap_masuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function lap_keluar(Request $request)
  {
    $title = "Laporan Barang Keluar";
    return view('lap_keluar', compact("title"));
  }

  public function cetak_keluar(Request $request)
  {
    DB::enableQueryLog();
    if (request()->ajax()) {
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length"); // Rows display per page

      $columnIndex_arr = $request->get('order');
      $columnName_arr = $request->get('columns');
      $order_arr = $request->get('order');
      $search_arr = $request->get('search');

      $columnIndex = $columnIndex_arr[0]['column']; // Column index
      $columnName = $columnName_arr[$columnIndex]['data']; // Column name
      $columnSortOrder = $order_arr[0]['dir']; // asc or desc
      $searchValue = $search_arr['value']; // Search value
      $start_date = $request->get('from_date');
      $end_date = $request->get('to_date') . ' 23:59:59';

      // Total records
      $totalRecords = Lap_jual::select('count(*) as allcount')->count();

      // Fetch records
      if (!empty($start_date)) {
        $records = Lap_jual::orderBy($columnName, $columnSortOrder)
          ->where(function ($query) use ($searchValue) {
            $query->where('nama', 'like', '%' . $searchValue . '%')
              ->orWhere('nama_pembeli', 'like', '%' . $searchValue . '%')
              ->orWhere('no_invoice', 'like', '%' . $searchValue . '%');
          })
          ->whereBetween('created_at', array($start_date, $end_date))
          ->skip($start)
          ->take($rowperpage)
          ->get();
      } else {
        $records = Lap_jual::orderBy($columnName, $columnSortOrder)
          ->where(function ($query) use ($searchValue) {
            $query->where('nama', 'like', '%' . $searchValue . '%')
              ->orWhere('nama_pembeli', 'like', '%' . $searchValue . '%')
              ->orWhere('no_invoice', 'like', '%' . $searchValue . '%');
          })
          ->skip($start)
          ->take($rowperpage)
          ->get();
      }

      $totalRecordswithFilter = $records->count();

      $data_arr = array();

      foreach ($records as $record) {
        $id = $record->id;
        $no_invoice = $record->no_invoice;
        $pembeli = $record->nama_pembeli;
        $barang = $record->nama;
        $jumlah = $record->kuantitas;
        $harga = 'Rp. ' . number_format(($record->harga), 0, ',', '.');;
        $subtotal = 'Rp. ' . number_format(($record->subtotal), 0, ',', '.');
        $date = $record->created_at;

        $data_arr[] = array(
          "id" => $id,
          "no_invoice" => $no_invoice,
          "nama_pembeli" => $pembeli,
          "nama" => $barang,
          "kuantitas" => $jumlah,
          "harga" => $harga,
          "subtotal" => $subtotal,
          "created_at" => $date->format('d-m-Y')
        );
      }

      $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "query" => DB::getQueryLog(),
        "aaData" => $data_arr
      );
      echo json_encode($response);
      exit;
    }
  }

  public function export_keluar(Request $req)
  {
    $startDate = $req->from_date;
    $endDate = $req->to_date;
    if ($startDate != null) {
      return Excel::download((new KeluarExport)->startDate($startDate)->endDate($endDate), 'data_jual_' . $startDate . '_' . $endDate . '.xlsx');
    } else {
      return Excel::download((new KeluarExport), 'data_jual.xlsx');
    }
  }

  public function lap_masuk(Request $request)
  {
    $title = "Laporan Barang Masuk";
    return view('lap_masuk', compact("title"));
  }


  public function cetak_masuk(Request $request)
  {
    DB::enableQueryLog();
    if (request()->ajax()) {
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length"); // Rows display per page

      $columnIndex_arr = $request->get('order');
      $columnName_arr = $request->get('columns');
      $order_arr = $request->get('order');
      $search_arr = $request->get('search');

      $columnIndex = $columnIndex_arr[0]['column']; // Column index
      $columnName = $columnName_arr[$columnIndex]['data']; // Column name
      $columnSortOrder = $order_arr[0]['dir']; // asc or desc
      $searchValue = $search_arr['value']; // Search value
      $start_date = $request->get('from_date');
      $end_date = $request->get('to_date') . ' 23:59:59';

      // Total records
      $totalRecords = Lap_masuk::select('count(*) as allcount')->count();

      // Fetch records
      if (!empty($start_date)) {
        $records = Lap_masuk::orderBy($columnName, $columnSortOrder)
          ->where(function ($query) use ($searchValue) {
            $query->where('nama', 'like', '%' . $searchValue . '%')
              ->orWhere('nama_suplier', 'like', '%' . $searchValue . '%');
          })
          ->whereBetween('tanggal_masuk', array($start_date, $end_date))
          ->skip($start)
          ->take($rowperpage)
          ->get();
      } else {
        $records = Lap_jual::orderBy($columnName, $columnSortOrder)
          ->where(function ($query) use ($searchValue) {
            $query->where('nama', 'like', '%' . $searchValue . '%')
              ->orWhere('nama_suplier', 'like', '%' . $searchValue . '%');
          })
          ->skip($start)
          ->take($rowperpage)
          ->get();
      }

      $totalRecordswithFilter = $records->count();

      $data_arr = array();

      foreach ($records as $record) {
        $id = $record->id;
        $suplier = $record->nama_suplier;
        $barang = $record->nama;
        $jumlah = $record->kuantitas;
        $harga = 'Rp. ' . number_format(($record->harga), 0, ',', '.');;
        $subtotal = 'Rp. ' . number_format(($record->total), 0, ',', '.');
        $date = $record->tanggal_masuk;

        $data_arr[] = array(
          "id" => $id,
          "nama_suplier" => $suplier,
          "nama" => $barang,
          "jumlah" => $jumlah,
          "harga" => $harga,
          "total" => $subtotal,
          "tanggal_masuk" => Carbon::parse($date)->format('d-m-Y')
        );
      }

      $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "query" => DB::getQueryLog(),
        "aaData" => $data_arr
      );
      echo json_encode($response);
      exit;
    }
  }

  public function export_masuk(Request $req)
  {
    $startDate = $req->from_date;
    $endDate = $req->to_date;
    if ($startDate != null) {
      return Excel::download((new MasukExport)->startDate($startDate)->endDate($endDate), 'data_masuk_' . $startDate . '_' . $endDate . '.xlsx');
    } else {
      return Excel::download((new MasukExport), 'data_jual.xlsx');
    }
  }
}