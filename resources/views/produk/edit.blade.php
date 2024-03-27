<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Produk</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <h4 class="navbar-brand brand-logo" href="index.html">Inventory Stock</h4>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-sort-variant"></span>
                    </button>
                </div>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-title">Stock Card</span>
                        </a>
                    </li>

                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('produk.index') }}">
                            <i class="mdi mdi-border-color menu-icon"></i>
                            <span class="menu-title">Produk</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pembelian.create') }}">
                            <i class="mdi mdi-cart menu-icon"></i>
                            <span class="menu-title">Pembelian</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('penjualan.create') }}">
                            <i class="mdi mdi-shopping menu-icon"></i>
                            <span class="menu-title">Penjualan</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <h4 class="card-title">Update Produk</h4>
                            <form action="{{ route('produk.update', $produk->id) }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="mb-2">
                                    <label for="kode" class="col-form-label">Kode:</label>
                                    <input type="text" class="form-control" id="kode" name="kode" value="{{ $produk->kode }}" required>
                                </div>
                                <div class="mb-2">
                                    <label for="nama" class="col-form-label">Nama:</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $produk->nama }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga_jual" class="col-form-label">Harga Jual:</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ $produk->harga_jual }}" required>
                                </div>
                            
                                <button type="submit" class="btn btn-primary mb-2">Update</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
                {{-- <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Data Produk</p>
                                    <div class="table-responsive">
                                        <table id="recent-purchases-listing" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Kode Produk</th>
                                                    <th scope="col">Nama Produk</th>
                                                    <th scope="col">Harga Jual</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produk as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->kode }}</td>
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ $item->harga_jual }}</td>
                                                        <td>
                                                            <form action="{{ route('produk.edit', $item->id) }}" method="GET" class="d-inline">
                                                                @csrf
                                                                
                                                                <button class="btn btn-sm btn-warning" type="submit"
                                                                    name="submit"><span
                                                                        class="mdi mdi-pencil"></span> Edit
                                                                </button>
                                                            </form>
                                                            <form
                                                                onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')"
                                                                action="{{ route('produk.destroy', $item->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-sm btn-danger" type="submit"
                                                                    name="submit"><span
                                                                        class="mdi mdi-trash-can"></span> Hapus
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- content-wrapper ends -->

                <!-- partial:partials/_footer.html -->
                <footer class="footer bg-white">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <!-- End custom js for this page-->

    <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
</body>

</html>
