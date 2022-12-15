{{-- @extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Data Pengguna</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Data Pengguna</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <p></p>
                <a href="tambah-user.php"><button type="button" class="btn btn-primary">Tambah</button></a>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">IDDDDD</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Gambar</th>
                      <th scope="col">Kategori</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row"></th>
                      <td>{{ $item['id'] }}</td>
                      <td>{{ $item['nama'] }}</td>
                      <td>{{ $item['kuantitas'] }}</td>
                      <td>{{ $item['harga'] }}</td>
                      <td><img src="img/{{ $item['gambar'] }}.jpg" width="100"></td>
                      <td>{{ $item['kategori'] }}</td>
                    </tr>
                  </tbody>
                </table>
                <!-- End Table with stripped rows -->
  
              </div>
            </div>
  
          </div>
        </div>
      </section>
@endsection --}}

@extends('layouts.main')

@section('container')
<div class="pagetitle">
  <h1>Ubah Pengguna</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Data Barang</li>
      <li class="breadcrumb-item active">Ubah Data Barang</li>
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
          <form class="row g-3" action="/penggunas/{{ $user['id'] }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $user['id'] }}">
              <div class="col-md-12">
                <div class="form-floating">
                  <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user['email'] }}" required>
                  <label for="nama">Email</label>
                  @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating">
                  <input type="text"  name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $user['name'] }}" required>
                  <label for="email">Nama</label>
                  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating mb-3">
                  <select class="form-select"id="level" name="level" aria-label="level"  value="{{ $user['level'] }}">
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