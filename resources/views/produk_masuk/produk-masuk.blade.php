@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Produk Masuk</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Produk Masuk</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <p></p>
                <a href="/tambah-produk-masuk"><button type="button" class="btn btn-primary">Tambah</button></a>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                  @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">ID</th>
                      <th scope="col">Supplier</th>
                      <th scope="col">Produk</th>
                      <th scope="col">Kuantitas</th>
                      <th scope="col">Tanggal Masuk</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($produkmasuks as $pm) 
                    <tr>
                      <th scope="row"></th>
                      <td>{{ $pm->id }}</td>

                      @foreach ($suppliers as $supp)
                      @if ($supp->id==$pm['supplier_id'])
                      
                      <td>
                          {{ $supp->nama }}
                      </td>
                          
                      @endif
                      @endforeach


                      @foreach ($items as $item)
                      @if ($item->id==$pm['produk_id'])
                      
                      <td>
                          {{ $item->nama }}
                      </td>
                          
                      @endif
                      @endforeach
                      
                      <td>{{ $pm['kuantitas'] }}</td>
                      <td>{{ $pm['tanggal_masuk'] }}</td>
                      <td><a href="/produk-masuk/{{ $pm['id'] }}"><button type="button" class="btn btn-success">Ubah</button></a>
                          <a href="/produk-masuk/hapus/{{ $pm['id'] }}"><button type="button" class="btn btn-danger" onClick="return confirm('Yakin dihapus?')">Hapus</button></td>
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