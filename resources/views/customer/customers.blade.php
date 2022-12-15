@extends('layouts.main')

@section('container')
    <div class="pagetitle">
        <h1>Data Pengguna</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Data Customer</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <p></p>
                <a href="/tambah-customer"><button type="button" class="btn btn-primary">Tambah</button></a>
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
                      <th scope="col">Nama</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Email</th>
                      <th scope="col">Telepon</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($customers as $customer) 
                    <tr>
                      <th scope="row"></th>
                      <td>{{ $customer['id'] }}</td>
                      <td>{{ $customer['nama'] }}</td>
                      <td>{{ $customer['alamat'] }}</td>
                      <td>{{ $customer['email'] }}</td>
                      <td>{{ $customer['telepon'] }}</td>
                      <td><a href="/customers/{{ $customer['id'] }}"><button type="button" class="btn btn-success">Ubah</button></a>
                          <a href="/customers/hapus/{{ $customer['id'] }}"><button type="button" class="btn btn-danger" onClick="return confirm('Yakin dihapus?')">Hapus</button></td>
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