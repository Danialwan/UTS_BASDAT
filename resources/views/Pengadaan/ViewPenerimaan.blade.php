@extends('Layout.default')

@section('content')
<div class="pagetitle">
    <h1>Detail Penerimaan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/vendor">Magement Pengadaan</a></li>
            <li class="breadcrumb-item active">Detail Penerimaan</li>
          </ol>
    </nav>
  </div><!-- End Page Title -->

    <!-- Floating Labels Form -->
    <section class="section">

          <div class="col-12">
            <div class="card recent-sales overflow-auto">
              <div class="card-body">
                <h5 class="card-title">Detail Pengadaan </h5>
                {{-- <div class="d-flex justify-content-end" style="width: 100%">
                    <a href="/Barang/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                        Tambah Barang
                    </a>
                </div> --}}
                    @csrf
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">id_karyawan</th>
                        <th scope="col">tanggal_pemesanan</th>
                        <th scope="col">id_vendor</th>
                        <th scope="col">subtotal</th>
                        <th scope="col">ppn</th>
                        <th scope="col">total_nilai</th>
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
                          </tr>
                      @endforeach
                  </tbody>
                  </table>
                  <br>
                <div class="d-flex justify-content-end" style="width: 100%">
            </div>
              </div>
            </div>
          </div><!-- End Recent Sales -->
<div class="row g-2">
          <div class="col-6">
            <div class="card recent-sales overflow-auto">
              <div class="card-body">
                <h5 class="card-title">Detail Penerimaan </h5>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">Nama barang</th>
                      <th scope="col">Harga satuan</th>
                      <th scope="col">Jumlah</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $detail_penerimaan as $item )
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card recent-sales overflow-auto">
          <div class="card-body">
            <h5 class="card-title">Data Retur</h5>
            <table class="table table-borderless datatable">
                <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">Create at</th>
                      <th scope="col">Karyawan</th>
                      <th scope="col">Details</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $data_retur as $item )
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->username }}</td>
                            <td><a href="{{ '/Penerimaan/'.$item->id }}" class="btn btn-success btn-sm">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-end" style="width: 100%">
        <a href="/vendor" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
        Kembali
        </a>
</div>
</div>
</div>
    </section>

@endsection
