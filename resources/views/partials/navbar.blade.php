<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link {{ $title != "Home" ? "collapsed" : "" }}" href="/home">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    @can('admin')
    <li class="nav-item">
      <a href="/penggunas" class="nav-link {{ $title != "Data Pengguna" ? "collapsed" : "" }}">
      <i class="bi bi-person"></i><span>Data Pengguna</span>
      </a>
    </li><!-- End Components Nav -->
    @endcan

    <li class="nav-item">
      <a href="/kategoris" class="nav-link {{ $title != "Kategori" ? "collapsed" : "" }}">
      <i class="ri-archive-line"></i><span>Kategori</span>
      </a>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a href="/items" class="nav-link {{ $title != "Data Barang" ? "collapsed" : "" }}">
      <i class="ri-archive-line"></i><span>Data Barang</span>
      </a>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a href="/suppliers" class="nav-link {{ $title != "Suppliers" ? "collapsed" : "" }}">
      <i class="ri-folder-received-line"></i><span>Suppliers</span>
      </a>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a href="/customers" class="nav-link {{ $title != "Customers" ? "collapsed" : "" }}">
      <i class="ri-folder-received-line"></i><span>Customers</span>
      </a>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a href="/produk-masuk" class="nav-link {{ $title != "Produk Masuk" ? "collapsed" : "" }}">
      <i class="ri-folder-received-line"></i><span>Barang Masuk</span>
      </a>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a href="/produk-keluar" class="nav-link {{ $title != "Produk Keluar" ? "collapsed" : "" }}">
      <i class="ri-folder-received-line"></i><span>Barang Keluar</span>
      </a>
    </li><!-- End Components Nav -->

    @can('staff')
    <li class="nav-item">
      <a class="nav-link {{ $title != "Transaksi" ? "collapsed" : "" }}" href="/transaksi">
      <i class="ri-funds-box-line"></i><span>Transaksi</span>
      </a>
    </li><!-- End Components Nav -->
    @endcan

    {{-- @can('staff')
    <li class="nav-item">
      <a class="nav-link {{ $title != "laporan" ? "collapsed" : "" }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="/laporan">
      <i class="ri-funds-box-line"></i><span>Kalkuator Bahan</span>
      </a>
    </li><!-- End Components Nav -->
    @endcan --}}

    {{-- @can('staff')
    <li class="nav-item">
      <a class="nav-link {{ $title != "laporan" ? "collapsed" : "" }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="/laporan">
      <i class="ri-funds-box-line"></i><span>Kasir</span>
      </a>
    </li><!-- End Components Nav -->
    @endcan --}}

    <li class="nav-item">
      <a class="nav-link {{ $title != "laporan" ? "collapsed" : "" }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="/laporan">
      <i class="ri-funds-box-line"></i><span>Laporan</span>
      </a>
    </li><!-- End Components Nav -->

  </ul>

</aside><!-- End Sidebar-->