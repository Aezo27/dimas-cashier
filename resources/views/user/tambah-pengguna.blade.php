@extends('layouts.main')

@section('container')
<div class="pagetitle">
  <h1>Tambah Pengguna</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Data Pengguna</li>
      <li class="breadcrumb-item active">Tambah Data Pengguna</li>
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
          <form class="row g-3" action="/register" method="POST">
            @csrf
          <input type="hidden" name="id">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"  placeholder="Email Anda">
                <label for="nama">Email</label>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" requir placeholder="Email Anda"ed>
                <label for="email">Nama</label>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required placeholder="Email Anda">
                <label for="username">Password Baru</label>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-floating mb-3">
                <select class="form-select" id="level" name="level" aria-label="level">
                  <option value="admin">Admin</option>
                  <option value="staff">Staff</option>
                </select>
                <label for="level">Kategori</label>
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