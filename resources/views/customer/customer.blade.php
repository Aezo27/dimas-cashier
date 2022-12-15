@extends('layouts.main')

@section('container')
<div class="pagetitle">
  <h1>Ubah Customer</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Customer</li>
      <li class="breadcrumb-item active">Ubah Customer</li>
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
          <form class="row g-3" action="/customers/{{ $customer['id'] }}" method="POST">
          @csrf
          <input type="hidden" name="id" value="{{ $customer['id'] }}">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Customer"  value="{{ $customer['nama'] }}">
                <label for="nama">Nama</label>
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Alamat Customer"  value="{{ $customer['alamat'] }}">
                <label for="alamat">Alamat</label>
                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email Customer"  value="{{ $customer['email'] }}">
                <label for="email">Email</label>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="telepon" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Your Email" value="{{ $customer['telepon'] }}">
                <label for="telepon">Telepon</label>
                @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
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