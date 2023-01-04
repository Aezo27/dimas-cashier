<h1>DATA BARANG MASUK XXX {{ isset($startDate) ? $startDate . ' - ' . $endDate : '' }}</h1>
<br>
<br>
<table>
  <thead>
    <tr>
      <th><b>No</b></th>
      <th><b>Tanggal</b></th>
      <th><b>Suplier</b></th>
      <th><b>Barang</b></th>
      <th><b>Jumlah</b></th>
      <th><b>Harga</b></th>
      <th><b>Total</b></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($datajuals as $datajual)
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ \Carbon\Carbon::parse($datajual->tanggal_masuk)->format('d-m-Y') }}</td>
        <td>{{ $datajual->nama_suplier }}</td>
        <td>{{ $datajual->nama }}</td>
        <td>{{ $datajual->kuantitas }}</td>
        <td>{{ $datajual->harga }}</td>
        <td>{{ $datajual->total }}</td>
      </tr>
    @endforeach
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><b>{{ $datajuals->sum('total') }}</b></td>
    </tr>
  </tbody>
</table>
