@extends('layouts.main')

@section('container')
<div class="pagetitle">
  <h1>Ubah Customer</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Customer</li>
      <li class="breadcrumb-item active">Tambah Customer</li>
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
          <form class="row g-3" action="/tambah-customer" method="POST">
            @csrf
          <input type="hidden" name="id">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Customer">
                <label for="nama">Nama</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Customer">
                <label for="alamat">Alamat</label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="email" name="email" placeholder="Email Customer">
                <label for="email">Email</label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-floating">
                <input type="telepon" class="form-control" id="telepon" name="telepon" placeholder="Your Email">
                <label for="telepon">Telepon</label>
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