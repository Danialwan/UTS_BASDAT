@extends('Layout.default')

@section('content')
    <div class="pagetitle">
      <h1>Management Pengadaan</h1>
      <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Magement Pengadaan</li>
          </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Vendor</h5>
                <p>Halaman Vendor dikhususkan untuk pengadaan barang, <b>Berhati dalam memasukan data!</b></p>
                    <div class="d-flex justify-content-end" style="width: 100%">
                        <a href="/vendor/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                        Tambah Vendor
                        </a>
                        <a href="/vendor/restore" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                        Restore
                        </a>
                </div>
                <!-- Table with stripped rows -->
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data_vendor as $item )
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama_vendor }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                        <a href="{{ '/vendor/'.$item->id.'/edit' }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form class="d-inline" action="{{ '/vendor/'.$item->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        <a href="{{ '/Pengadaan/create/'.$item->id }}" class="btn btn-success btn-sm">Pesan</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->

                    </div>
                </div>
            </div>

              <div class="col-12">
                <div class="card recent-sales overflow-auto">

                  <div class="card-body">
                    <h5 class="card-title">History Pengadaan</h5>
                    <div class="d-flex justify-content-end" style="width: 100%">
                        {{-- <a href="/Pengadaan/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                            Pesan Barang
                        </a> --}}
                    </div>
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">id</th>
                          <th scope="col">id_karyawan</th>
                          <th scope="col">tanggal_pemesanan</th>
                          <th scope="col">id_vendor</th>
                          <th scope="col">subtotal</th>
                          <th scope="col">ppn</th>
                          <th scope="col">total_nilai</th>
                          <th scope="col">aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $data_pengadaan as $item )
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->iduser }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->idvendor }}</td>
                                <td>{{ $item->subtotal_nilai }}</td>
                                <td>{{ $item->ppn }}</td>
                                <td>{{ $item->total_nilai }}</td>
                                <td>
                                    <a href="{{ '/Pengadaan/'.$item->id.'/'.$item->idvendor }}" class="btn btn-success btn-sm">View</a>
                                    <a href="{{ '/Penerimaan/'.$item->idvendor.'/'.$item->id}}" class="btn btn-warning btn-sm">Terima</a>
                                    <form class="d-inline" action="{{ '/Pengadaan/'.$item->id }}" method="POST">
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

              <div class="col-12">
                <div class="card recent-sales overflow-auto">

                  <div class="card-body">
                    <h5 class="card-title">History Penerimaan </h5>
                    <div class="d-flex justify-content-end" style="width: 100%">
                        {{-- <a href="/Pengadaan/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                            Pesan Barang
                        </a> --}}
                    </div>
                    <table class="table table-borderless datatable">
                      <thead>
                        <tr>
                          <th scope="col">id</th>
                          <th scope="col">tanggal penerimaan</th>
                          <th scope="col">idpengadaan</th>
                          <th scope="col">Karyawan</th>
                          <th scope="col">status</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $data_penerimaan as $item )
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->idpengadaan }}</td>
                                <td>{{ $item->iduser }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ '/Penerimaan/'.$item->id.'/edit' }}" class="btn btn-success btn-sm">View</a>
                                    <a href="{{ '/Retur/'.$item->idpengadaan.'/'.$item->id}}" class="btn btn-warning btn-sm">Retur</a>
                                    <form class="d-inline" action="{{ '/Penerimaan/'.$item->id }}" method="POST">
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
