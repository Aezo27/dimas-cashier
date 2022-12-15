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
  <h1>Ubah Barang</h1>
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
          <form class="row g-3" action="/items/{{ $item->slug }}" method="POST" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="slug" value="{{ $item->slug }}">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $item['nama'] }}" placeholder="Nama Barang">
                <label for="nama">Nama Barang</label>
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control @error('id') is-invalid @enderror" id="harga" name="harga" value="{{ $item['harga'] }}" placeholder="Harga Satuan">
                <label for="harga">Harga</label>
                @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control @error('kuantitas') is-invalid @enderror" id="kuantitas" name="kuantitas" value="{{ $item['kuantitas'] }}" placeholder="Total Jumlah Barang">
                <label for="kuantitas">Kuantitas</label>
                @error('kuantitas') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>
            <div class="col-md-6">
              <label for="gambar">Gambar Barang</label>
              <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" placeholder="Gambar">
              @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-2">
              <img src="storage/{{ $item->gambar }}">
            </div>
            <div class="col-md-4">
              <div class="form-floating mb-3">
                <select class="form-select" id="kategori_id" name="kategori_id" aria-label="level">
                  @foreach ($kategoris as $kategori)
                  <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                -
                  @endforeach
                </select>
                <label for="kategori">Kategori</label>
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