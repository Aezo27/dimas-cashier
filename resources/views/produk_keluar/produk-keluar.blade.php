@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Produk Keluar</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Produk Keluar</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <p></p>
                <a href="/tambah-produk-keluar"><button type="button" class="btn btn-primary">Tambah</button></a>
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
                      <th scope="col">Tanggal keluar</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($produkkeluars as $pk) 
                    <tr>
                      <th scope="row"></th>
                      <td>{{ $pk->id }}</td>

                      @foreach ($customers as $cus)
                      @if ($cus->id==$pk['customer_id'])
                      
                      <td>
                          {{ $cus->nama }}
                      </td>
                          
                      @endif
                      @endforeach


                      @foreach ($items as $item)
                      @if ($item->id==$pk['produk_id'])
                      
                      <td>
                          {{ $item->nama }}
                      </td>
                          
                      @endif
                      @endforeach
                      
                      <td>{{ $pk['kuantitas'] }}</td>
                      <td>{{ $pk['tanggal_keluar'] }}</td>
                      <td><a href="/produk-keluar/{{ $pk['id'] }}"><button type="button" class="btn btn-success">Ubah</button></a>
                          <a href="/produk-keluar/hapus/{{ $pk['id'] }}"><button type="button" class="btn btn-danger" onClick="return confirm('Yakin dihapus?')">Hapus</button></td>
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