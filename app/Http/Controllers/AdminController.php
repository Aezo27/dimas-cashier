<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\Lap_jual;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
  public function index()
  {
    $today = Lap_jual::whereDate('created_at', Carbon::today())->get();
    $todayGroup = Lap_jual::select('*')->whereDate('created_at', Carbon::today())
      ->addSelect([DB::raw("sum(kuantitas) as sumKuantitas"), DB::raw("sum(subtotal) as sumTotal")])
      ->groupBy('nama')->get();
    $month = Lap_jual::whereMonth('created_at', Carbon::now()->month)->get();
    $customer = customer::whereYear('created_at', Carbon::now()->year)->get();

    $statsToday = Lap_jual::query()
      ->select(['last_day' => Lap_jual::selectRaw('sum(kuantitas) as total')
        ->whereDate('created_at', Carbon::yesterday())])
      ->addSelect(['new_jual' => Lap_jual::selectRaw('sum(kuantitas) as total')
        ->whereDate('created_at', Carbon::today())])
      ->first();

    $totalToday = $statsToday->last_day != 0 ? (($statsToday->new_jual - $statsToday->last_day) / $statsToday->last_day) * 100 : 100;

    $statsMonth = Lap_jual::query()
      ->select(['last_30' => Lap_jual::selectRaw('sum(subtotal) as total')
        ->whereMonth('created_at', Carbon::now()->month - 1)])
      ->addSelect(['new_jual' => Lap_jual::selectRaw('sum(subtotal) as total')
        ->whereMonth('created_at', Carbon::now()->month)])
      ->first();

    $totalMonth = $statsMonth->last_30 != 0 ? (($statsMonth->new_jual - $statsMonth->last_30) / $statsMonth->last_30) * 100 : 100;

    $statsYear = Lap_jual::query()
      ->select(['last_year' => Lap_jual::selectRaw('count(*) as total')
        ->whereYear('created_at', Carbon::now()->year - 1)])
      ->addSelect(['new_jual' => Lap_jual::selectRaw('count(*) as total')
        ->whereYear('created_at', Carbon::now()->year)])
      ->first();

    $totalYear = $statsYear->last_30 != 0 ? (($statsYear->new_jual - $statsYear->last_year) / $statsYear->last_year) * 100 : 100;

    return view('home', [
      "title" => "Home",
      "today" => $today,
      "todayGroup" => $todayGroup,
      "totalToday" => $totalToday,
      "month" => $month,
      "totalMonth" => $totalMonth,
      "customer" => $customer,
      "totalYear" => $totalYear,
    ]);
  }
}
