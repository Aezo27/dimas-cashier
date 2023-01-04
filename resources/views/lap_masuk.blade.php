@extends('layouts.main')

@section('container')
  <div class="pagetitle">
    <h1>Transaksi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href=".">Home</a></li>
        <li class="breadcrumb-item active">Transaksi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->


  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header"></div>
          <div class="card-body">
            <form action="{{ route('export_masuk') }}" method="post">
              @csrf
              <div class="row justify-content-center mb-3 date-wrapper">
                <div class="col-md-4">
                  <input type="text" name="from_date" id="from_date" class="form-control datetimepicker" placeholder="From Date" readonly />
                </div>
                <div class="col-md-4">
                  <input type="text" name="to_date" id="to_date" class="form-control datetimepicker" placeholder="To Date" readonly />
                </div>
                <div class="col-md-4">
                  <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                  <button type="button" name="refresh" id="refresh" class="btn btn-outline-secondary">Refresh</button>
                  <button type="submit" name="download" id="download" class="btn btn-success">Download</button>
                </div>
              </div>
            </form>
            <table id="order_table" class="table table-striped table-bordered table-hover projects">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Pembeli</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th style="width: 80px;">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="text-align:center"></td>
                  <td style="text-align:center"></td>
                  <td>
                    {{-- @foreach ($orde->products as $products)
                    <span> {{ $products->nama_barang }} x {{ $products->pivot->jumlah }}@if (!$loop->last), @endif </span>
                    @endforeach --}}
                  </td>
                  {{-- <td>@currency($orde->total)</td> --}}
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@push('custom-js')
  <script>
    $(document).ready(function() {
      $('.datetimepicker').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd',
        autoclose: true
      });

      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      var start_day = new Date(today - 7 * 24 * 60 * 60 * 1000)
      var dd2 = String(start_day.getDate()).padStart(2, '0');
      var mm2 = String(start_day.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy2 = start_day.getFullYear();

      today = yyyy + '-' + mm + '-' + dd;
      start_day = yyyy2 + '-' + mm2 + '-' + dd2;
      let from_date = $('#from_date').val(start_day);
      let to_date = $('#to_date').val(today);

      load_data(start_day, today);

      function load_data(from_date = '', to_date = '') {
        console.log('datatable rendered');
        let table = $('#order_table').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: '{{ route('cetak_masuk') }}',
            data: {
              from_date: from_date,
              to_date: to_date
            }
          },
          columns: [{
              data: 'id',
              render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
              }
            },
            {
              data: 'tanggal_masuk',
              name: 'tanggal_masuk'
            },
            {
              data: 'nama_suplier',
              name: 'nama_suplier'
            },
            {
              data: 'nama',
              name: 'nama'
            },
            {
              data: 'jumlah',
              name: 'jumlah'
            },
            {
              data: 'harga',
              name: 'harga'
            },
            {
              data: 'total',
              name: 'total'
            }
          ]
        });
      }

      $('#filter').click(function() {
        let from_date = $('#from_date').val();
        let to_date = $('#to_date').val();
        let check = new Date(from_date) > new Date(to_date);
        if (check) {
          alert('Invalid date range');
          let from_date = $('#from_date').val(start_day);
          let to_date = $('#to_date').val(today);
          return false;
        }
        if (from_date != '' && to_date != '') {
          $('#order_table').DataTable().destroy();
          load_data(from_date, to_date);
        } else {
          alert('Both Date is required');
        }
      });

      $('#refresh').on('click', function() {
        let from_date = $('#from_date').val(start_day);
        let to_date = $('#to_date').val(today);
        $('#order_table').DataTable().destroy();
        load_data(start_day, today);
      });

    });
  </script>
@endpush
