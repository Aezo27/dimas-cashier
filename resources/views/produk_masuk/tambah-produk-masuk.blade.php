@extends('layouts.main')

@section('container')
<div class="pagetitle">
  <h1>Produk Masuk</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item">Produk Masuk</li>
      <li class="breadcrumb-item active">Produk Masuk</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <p></p><br>
          <!-- Floating Labels Form -->
          <form class="row g-3" action="/tambah-produk-masuk" method="POST">
            @csrf
          <input type="hidden" name="id">
          <div class="col-md-6">
            <div class="form-floating mb-3">
              <select class="form-select"id="supplier_id" name="supplier_id" aria-label="level">
                @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
              -
                @endforeach
              </select>
              <label for="supplier_id">Supplier</label>
            </div>
          </div>
          <div class="col-md-6">
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
          <div class="col-md-12">
            <div class="form-floating">
              <input type="text" class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas" name="kuantitas" value="{{ old('kuantitas') }}"  placeholder="Total Jumlah Barang">
              <label for="kuantitas">Kuantitas</label>
              @error('kuantitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-floating">
              <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}"  placeholder="Total Jumlah Barang">
              <label for="tanggal_masuk">Tanggal Masuk</label>
              @error('tanggal_masuk') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
          </form><!-- End floating Labels Form -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection