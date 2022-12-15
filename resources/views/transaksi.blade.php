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
            <div class="card-body">
              
              <div class="col-md-4">
                <table>
                  <tr>
                    <td><h5 class="card-title">No. Invoice</h5></td>
                    <td><h5 class="card-title">:</h5></td>
                    <td id="no_invoice"></td>
                  </tr>
                  <tr>
                    <td><h5 class="card-title">Tanggal</h5></td>
                    <td><h5 class="card-title">:</h5></td>
                    <td id="tgl"></td>
                  </tr>
                  <tr>
                    <td><h5 class="card-title">Customer</h5></td>
                    <td><h5 class="card-title">:</h5></td>
                    <td>
                      <select id="inputState" class="form-select" id="customer_id" name="customer_id" >
                        <option selected>Choose Customer</option>
                        @foreach ($customers as $cus)
                        <option value="{{ $cus->id }}">{{ $cus->nama }}</option>
                      -
                        @endforeach
                      </select></td>
                  </tr>
                </table>
              </div>
              <form class="row g-3" action="/transaksi" method="POST">
                @csrf
                <input type="hidden" name="id">
                {{-- <input type="hidden" name="no_invoice" value="001"> --}}
              {{-- <div class="col-md-6">
                <div class="form-floating">
                  <input type="text" class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas" name="kuantitas" value="{{ old('kuantitas') }}"  placeholder="Total Jumlah Barang">
                  <label for="kuantitas">No. Invoice</label>
                  @error('kuantitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div> --}}
              <div class="col-md-10">
                <div class="form-floating mb-3">
                  <select class="form-select"id="produk_id" name="produk_id" aria-label="level">
                    @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                  -
                    @endforeach
                  </select>
                  <label for="produk_id">Produk</label>
                </div>
              </div>
              {{-- <div class="col-md-2">
                <div class="form-floating">
                  <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value=""  placeholder="Total Jumlah Barang">
                  <label for="harga">Harga</label>
                  @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-floating">
                  <input type="text" class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas" name="kuantitas" value="{{ old('kuantitas') }}"  placeholder="Total Jumlah Barang">
                  <label for="kuantitas">Kuantitas</label>
                  @error('kuantitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div> --}}
              {{-- <div class="col-md-3">
                <div class="form-floating">
                  <input type="text" class="form-control @error('subtotal') is-invalid @enderror" id="subtotal" name="subtotal" value="{{ old('subtotal') }}"  placeholder="Total Jumlah Barang">
                  <label for="subtotal">Subtotal</label>
                  @error('subtotal') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div> --}}
              <div class="col-md-2">
                <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
              </div>
              </form><!-- End floating Labels Form -->

              <!-- Table with stripped rows -->
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Subtotal</th>
                  </tr>
                </thead>
                <tbody>@foreach ($penjualans as $pjl) 
                  <tr>
                    <th scope="row"></th>

                    @foreach ($items as $item)
                    @if ($item->id==$pjl['produk_id'])
                    
                    <td>
                        {{ $item->nama }}
                    </td>
                        
                    @endif
                    @endforeach
                    <td>{{ $pjl['harga'] }}</td>
                    <td>{{ $pjl['kuantitas'] }}</td>
                    <td>{{ $pjl['subtotal'] }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection
