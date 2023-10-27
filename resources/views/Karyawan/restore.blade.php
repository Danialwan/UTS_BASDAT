@extends('Layout.default')
@section('content')
<div class="pagetitle">
    <h1>Restore Karyawan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/Karyawan">Management Karyawan</a></li>
            <li class="breadcrumb-item active">Restore Karyawan</li>
          </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
        <div class="col-lg-12">
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
                                <h5 class="card-title">User <span>| Today</span></h5>
                                <table class="table table-borderless datatable">
                                  <thead>
                                    <tr>
                                      <th scope="col">id</th>
                                      <th scope="col">Nama</th>
                                      <th scope="col">jabatan</th>
                                      <th scope="col">tanggal masuk</th>
                                      <th scope="col">aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ( $data_users as $item )
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <form class="d-inline" action="{{ '/Karyawan/restore/'.$item->id }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-warning btn-sm">Restore</button>
                                                </form>
                                                <form class="d-inline" action="{{ '/Karyawan/destroy/'.$item->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>

                              </div>

                            </div>
                          </div><!-- End Recent Sales -->
                    </div>
</section>

@endsection
