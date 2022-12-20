@extends('layouts.main')

@section('container')
  <div class="pagetitle">
    <h1>Data Pengguna</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Data Barang</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <p></p>
            <a href="/tambah-barang"><button type="button" class="btn btn-primary">Tambah</button></a>
            <!-- Table with stripped rows -->
            <table class="table datatable">
              @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">No.</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jumlah</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Gambar</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                  <tr>
                    <th scope="row"></th>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['kuantitas'] }}</td>
                    <td>{{ $item['harga'] }}</td>
                    <td><img src="{{ asset('storage/gambar-produk') . '/' . $item->gambar }}" width="100"></td>
                    @foreach ($kategoris as $kate)
                      @if ($kate->id == $item['kategori_id'])
                        <td>
                          {{ $kate->nama }}
                        </td>
                      @endif
                    @endforeach
                    <td><a href="/items/{{ $item['slug'] }}"><button type="button" class="btn btn-success">Ubah</button></a>
                      <a href="/items/hapus/{{ $item['id'] }}"><button type="button" class="btn btn-danger"onClick="return confirm('Yakin dihapus?')">Hapus</button>
                    </td>
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
