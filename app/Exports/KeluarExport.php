<?php

namespace App\Exports;

use App\Datajual;
use App\Models\Lap_jual;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class KeluarExport implements FromView, WithColumnFormatting, WithColumnWidths
{
  protected $startDate;
  protected $endDate;
  public function startDate(string $startDate)
  {
    $this->startDate = $startDate;

    return $this;
  }
  public function endDate(string $endDate)
  {
    $this->endDate = $endDate;

    return $this;
  }
  public function view(): View
  {
    if ($this->startDate != null) {
      return view('export_keluar', [
        'datajuals' => Lap_jual::whereBetween('created_at', array($this->startDate, $this->endDate . ' 23:59:59'))->get(),
        'startDate' => $this->startDate,
        'endDate' => $this->endDate
      ]);
    } else {
      return view('export_keluar', [
        'datajuals' => Lap_jual::all()
      ]);
    }
  }
  public function columnFormats(): array
  {
    return [
      'C' => NumberFormat::FORMAT_NUMBER,
      'G' => '"Rp. "#,##0',
      'H' => '"Rp. "#,##0',
    ];
  }
  public function columnWidths(): array
  {
    return [
      'B' => 15,
      'C' => 25,
      'D' => 60,
      'F' => 20,
      'G' => 20,
      'H' => 20,
    ];
  }
}