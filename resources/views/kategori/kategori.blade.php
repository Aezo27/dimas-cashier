@extends('layouts.main')

@section('container')
<div class="pagetitle">
  <h1>Ubah Kategori</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Kategori</li>
      <li class="breadcrumb-item active">Ubah Kategori</li>
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
          <form class="row g-3" action="/kategoris/{{ $kategoris['id'] }}" method="POST">
            @csrf
          <input type="hidden" name="id" value="{{ $kategoris['id'] }}">
            <div class="col-md-12">
              <div class="form-floating">
                <input type="text" class="form-control" id="nama" name="nama"  value="{{ $kategoris['nama'] }}">
                <label for="nama">Kategori</label>
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