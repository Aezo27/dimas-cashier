<h1>DATA PENJUALAN XXX {{ isset($startDate) ? $startDate . ' - ' . $endDate : '' }}</h1>
<br>
<br>
<table>
  <thead>
    <tr>
      <th><b>No</b></th>
      <th><b>Tanggal</b></th>
      <th><b>No Invoice</b></th>
      <th><b>Pembeli</b></th>
      <th><b>Barang</b></th>
      <th><b>Jumlah</b></th>
      <th><b>Harga</b></th>
      <th><b>Total</b></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datajuals as $datajual)
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $datajual->created_at->format('d-m-Y') }}</td>
        <td>{{ $datajual->no_invoice }}</td>
        <td>{{ $datajual->nama_pembeli }}</td>
        <td>{{ $datajual->nama }}</td>
        <td>{{ $datajual->kuantitas }}</td>
        <td>{{ $datajual->harga }}</td>
        <td>{{ $datajual->subtotal }}</td>
        <td></td>
      </tr>
    @endforeach
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><b>{{ $datajuals->sum('subtotal') }}</b></td>
      @inject('Terbilang', 'App\Http\Controllers\TerbilangController')
      <td>{{ ucwords($Terbilang->pembilang($datajuals->sum('subtotal')) . ' rupiah') }}</td>
    </tr>
  </tbody>
</table>
