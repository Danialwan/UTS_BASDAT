@extends('Layout.default')

@section('content')
<div class="pagetitle">
    <h1>Management Barang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Barang</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
        <div class="col-lg-8">
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                              <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                  <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                  </li>

                                  <li><a class="dropdown-item" href="#">Today</a></li>
                                  <li><a class="dropdown-item" href="#">This Month</a></li>
                                  <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                              </div>

                              <div class="card-body">
                                <h5 class="card-title">Barang </h5>
                                <div class="d-flex justify-content-end" style="width: 100%">
                                    <a href="/Barang/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                                        Tambah Barang
                                    </a>
                                </div>
                                <table class="table table-borderless datatable">
                                  <thead>
                                    <tr>
                                      <th scope="col">id</th>
                                      <th scope="col">Nama</th>
                                      <th scope="col">jenis</th>
                                      <th scope="col">id satuan</th>
                                      <th scope="col">Harga</th>
                                      <th scope="col">Status</th>
                                      <th scope="col">aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ( $data_barang as $item )
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->jenis }}</td>
                                            <td>{{ $item->idsatuan }}</td>
                                            <td>{{ $item->harga }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ '/Barang/'.$item->id.'/edit' }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form class="d-inline" action="{{ '/Barang/'.$item->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                <a href="/Barang/restore" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                                    Restore
                                </a>
                              </div>

                            </div>
                          </div><!-- End Recent Sales -->
                    </div>
                    <div class="col-lg-4">
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                              <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                  <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                  </li>

                                  <li><a class="dropdown-item" href="#">Today</a></li>
                                  <li><a class="dropdown-item" href="#">This Month</a></li>
                                  <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                              </div>

                              <div class="card-body">
                                <h5 class="card-title">Satuan Barang</h5>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">id</th>
                                      <th scope="col">nama_satuan</th>
                                      <th scope="col">status</th>
                                      <th scope="col">aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ( $data_satuan as $item )
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->nama_satuan}}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a href="{{ '/Satuan/'.$item->id.'/edit' }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form class="d-inline" action="{{ '/Satuan/'.$item->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                <div class="d-flex justify-content-start" style="width: 100%">
                                    <a href="/Satuan/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                                        Tambah Satuan
                                    </a>
                                    <a href="/Satuan/restore" style="width: 100px" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                                        Restore
                                    </a>
                                </div>

                              </div>

                            </div>
                          </div><!-- End Recent Sales -->
        </div>
    </div>
</section>

@endsection
