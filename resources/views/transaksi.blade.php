@extends('layouts.main')

@section('container')
  <div class="pagetitle">
    <h1>Transaksi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Transaksi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->


  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <table>
                  <tr>
                    <td>
                      <h5 class="card-title">No. Invoice</h5>
                    </td>
                    <td>
                      <h5 class="card-title">:</h5>
                    </td>
                    <td id="no_invoice"></td>
                  </tr>
                  <tr>
                    <td>
                      <h5 class="card-title">Tanggal</h5>
                    </td>
                    <td>
                      <h5 class="card-title">:</h5>
                    </td>
                    <td id="tgl"></td>
                  </tr>
                  <tr>
                    <td>
                      <h5 class="card-title">Customer</h5>
                    </td>
                    <td>
                      <h5 class="card-title">:</h5>
                    </td>
                    <td>
                      <select class="form-select" id="customer_id" name="customer_id">
                        <option selected value="">Choose Customer</option>
                        @foreach ($customers as $cus)
                          <option value="{{ $cus->id }}">{{ $cus->nama }}</option>
                          -
                        @endforeach
                      </select>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="col align-self-center">
                <table class="ml-auto">
                  <tr>
                    <td>
                      <h5 class="card-title">Dibayarkan</h5>
                    </td>
                    <td>
                      <h5 class="card-title">:</h5>
                    </td>
                    <td>
                      <div class="input-group">
                        <label class="input-group-prepend" for="dibayar">
                          <span class="badge">Rp</span>
                        </label>
                        <input type="number" min="0" class="form-control" value="" name="dibayar" id="dibayar">
                      </div>
                    </td>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <h5 class="card-title">Kembalian</h5>
                    </td>
                    <td>
                      <h5 class="card-title">:</h5>
                    </td>
                    <td>
                      <div class="input-group">
                        <label class="input-group-prepend" for="kembalian">
                          <span class="badge">Rp</span>
                        </label>
                        <input type="text" class="form-control" value="" name="kembalian" id="kembalian" readonly>
                      </div>
                    </td>
                  </tr>
                  <tr class="total-wrapper">
                    <td>
                      <h1 class="mb-0">Total</h1>
                    </td>
                    <td>
                      <h1>:</h1>
                    </td>
                    <td>
                      <h1 class="mb-0 text-right" data-all="" id="total-all">Rp. 0</h1>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <form action="" method="post" id="add">
              @csrf
              <div class="input-group has-clearable">
                <button id="clear-search" type="button" class="close" aria-label="Close"><span aria-hidden="true"><i class="ri-close-line"></i></span></button>
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ri-search-2-line"></i></span>
                </div>
                <input type="hidden" id="id_barang" name="barang">
                <input id="barang-search" type="text" class="form-control" placeholder="Ketik barang yang akan diinput" required>
              </div><!-- /.input-group -->
            </form>
          </div>
          <div class="card-body">
            <div class="dynamic-content">

            </div>

          </div>
          <div class="card-footer">
            <div class="form-actions">
              <a class="btn btn-success" id="simpan" href="javascript:void(0)">Simpan</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection

@push('custom-js')
  <script>
    $(document).ready(function() {
      function getCokiee() {
        $.ajax({
          url: "{{ route('get_kasir') }}",
          dataType: 'json',
          success: function(response) {
            console.log(response);
            $('#no_invoice').html(response['id']);
            $('#tgl').html(response['tanggal']);
          }
        });
      }

      getCokiee();

      function table_reload() {
        $.ajax({
          url: '{{ route('get_kasir.datatable') }}',
          method: 'GET',
          success: function(data) {
            $('.dynamic-content').html(data);
            let total = 0;
            $('.total').each(function() {
              total += parseInt($(this).attr('data-total'));
            })
            $('#total-all').html('Rp. ' + (total).toLocaleString('id-ID'))
            $('#total-all').attr('data-all', total)
            $('#dibayar').val('');
            $('#kembalian').val('');
          }
        })
      }
      table_reload();

      $('.input-group .form-control').focus(function() {
        $(this).parent().addClass('focus');
      })

      $('.input-group').focusout(function() {
        $(this).removeClass('focus');
      })

      $('.input-group #barang-search').on('keyup', function() {
        if ($(this).val() != '') {
          $(this).parent().children('#clear-search').addClass('show');
        } else {
          $(this).parent().children('#clear-search').removeClass('show');
        }
      })

      $('.input-group #clear-search').on('click', function() {
        $(this).parent().children('input').val('');
        $(this).removeClass('show');
      })

      $("#barang-search").autocomplete({
        autoFocus: true,
        source: function(request, response) {
          // Fetch data
          $.ajax({
            url: '{{ route('kasir.get_barang') }}',
            dataType: 'json',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            delay: 800,
            data: {
              search: request.term
            },
            success: function(data) {
              response(data);
            }
          });
        },
        select: function(event, ui) {
          $('#id_barang').val(ui.item.id);
          setTimeout(function() {
            if (ui.item.stok < 1) {
              Toast.fire({
                icon: 'error',
                title: 'Stok Kosong!!'
              });
            } else {
              $('#add').submit();
            }
            $('#clear-search').trigger('click');
            $('#barang-search').autocomplete('close');
          }, 200);
          return false;
        }
      });

      $('#add').on('submit', function(e) {
        e.preventDefault();
        $values = $(this).serialize();
        $.ajax({
          url: "{{ route('get_kasir') }}/" + $('#id_barang').val(),
          type: "post",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: $values,
          success: function(response) {
            console.log(response);
            setTimeout(function() {
              $('#id_barang').val('');
            }, 300);
            getCokiee();
            table_reload();
          }
        });
      })

      $(document).on('click', '#delete-kasir', function(e) {
        e.preventDefault();
        $.ajax({
          url: "delete-kasir/" + $(this).attr('data-id'),
          type: "get",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            console.log(response);
            getCokiee();
            table_reload();
          }
        });
      })

      $(document).on('change', '#dibayar', function() {
        let total = parseInt($('#total-all').attr('data-all'));
        if ($(this).val() >= total) {
          let kembalian = $(this).val() - total;
          $('#kembalian').val(kembalian);
        }
      });

      $(document).on('change', '.jml', function() {
        let total_harga = 0,
          jml = parseInt($(this).val()),
          total = jml * parseInt($(this).parent().prev().attr('data-harga')),
          id = $(this).attr('data-id');

        $('#dibayar').val('');
        $('#kembalian').val('');
        if (jml > $(this).next().val()) {
          Toast.fire({
            icon: 'error',
            title: 'Stok Terbatas!!'
          });
          $(this).val($(this).next().val());
          jml = parseInt($(this).next().val());
          total = jml * parseInt($(this).parent().prev().attr('data-harga'));
          // return false;
        }
        $(this).parent().next().html(total);
        $(this).parent().next().attr('data-total', total);
        $('.total').each(function() {
          total_harga += parseInt($(this).attr('data-total'));
        })
        $('#total-all').html('Rp ' + (total_harga).toLocaleString('id-ID'))
        $('#total-all').attr('data-all', total_harga)

        // update
        $.ajax({
          url: "update-kasir/" + id,
          delay: 500,
          type: "post",
          data: {
            'jumlah': jml
          },
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            table_reload();
            getCokiee();
          }
        });
      });

      $('#simpan').on('click', function(e) {
        e.preventDefault();
        if ($('#customer_id').val() == '') {
            Toast.fire({
                icon: 'error',
                title: 'Harap pilih customer terlebih dahulu!!'
            });
        } else {
            window.open('{{route("download_pdf")}}', '_blank');
            setTimeout(() => {
                $.ajax({
                  url: "{{route('simpan_kasir')}}",
                  type: "post",
                  data: {
                    'total': $('#total-all').attr('data-all'),
                    'customer_id': $('#customer_id').val(),
                  },
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response) {
                    location.reload();
                  }
                });
            }, 1000);
        }
      });

    });
  </script>
@endpush
w
