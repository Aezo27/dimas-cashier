<!-- Table with stripped rows -->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Harga</th>
      <th scope="col">QTY</th>
      <th scope="col">Subtotal</th>
      <th style="width:10%"></th>
    </tr>
  </thead>
  <tbody>
    @if ($datas != null)
      @foreach ($datas as $data)
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td>{{ $data['nama'] }}</td>
          <td class="harga" data-harga="{{ $data['harga'] }}">{{ $data['harga'] }}</td>
          <td class="jumlah">
            <input type="number" class="form-control jml" id="tf2" min="0" max="30" step="1" data-id="{{ $data['id'] }}" name="jml" value="{{ $data['jumlah'] }}" placeholder="">
            <input type="hidden" value="{{ $data['stok'] }}">
          </td>
          <td style="font-weight: bold" data-total="{{ $data['total'] }}" class="total">{{ $data['total'] }}</td>
          <td><a href="javascript:void(0)" id="delete-kasir" data-id="{{ $data['id'] }}" class="btn btn-sm btn-icon btn-secondary"><i class="ri-close-line"></i></a></td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
<!-- End Table with stripped rows -->
