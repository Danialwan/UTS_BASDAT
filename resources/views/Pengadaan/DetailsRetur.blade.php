@extends('Layout.default')

@section('content')
<div class="pagetitle">
    <h1>Detail Retur</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/vendor">Magement Pengadaan</a></li>
            <li class="breadcrumb-item active">Detail Penerimaan</li>
            <li class="breadcrumb-item active">Detail Retur</li>
          </ol>
    </nav>
  </div><!-- End Page Title -->

    <!-- Floating Labels Form -->
    <section class="section">

          <div class="col-12">
            <div class="card recent-sales overflow-auto">
              <div class="card-body">
                <h5 class="card-title">Detail Pengadaan</h5>
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
                          <th scope="col">tanggal retur</th>
                          <th scope="col">barang</th>
                          <th scope="col">jumlah</th>
                          <th scope="col">alasan</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $detail_retur as $item )
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->alasan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                  <br>
                <div class="d-flex justify-content-end" style="width: 100%">
                    <a href="/vendor" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                    Kembali
                    </a>
            </div>
              </div>
            </div>
          </div><!-- End Recent Sales -->
    </section>

@endsection
