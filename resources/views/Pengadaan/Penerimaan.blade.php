@extends('Layout.default')

@section('content')
<div class="pagetitle">
    <h1>Halaman Penerimaan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/vendor">Magement Pengadaan</a></li>
            <li class="breadcrumb-item active">Penerimaan</li>
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
                <form class="row g-3" method="POST" action="{{ '/Penerimaan/'.$vendor->id.'/'.$pengadaan->id }}" >
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
                  <h5 class="card-title">Detail Penerimaan </h5>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">Nama barang</th>
                      <th scope="col">Harga satuan</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">subtotal</th>
                      <th scope="col">Penerimaan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $detail_pengadaan as $item )
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->harga_satuan }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->subtotal }}</td>
                            {{-- <td>{{ $item->status }}</td> --}}
                            <td>
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="jumlah" placeholder="jumlah" name="penerimaan[]" value="0" min="0" max="{{ $item->jumlah }}">
                                        <label for="floatingName">Jumlah Barang</label>
                                      </div>
                                {{-- <a href="{{ '/Pengadaan/create/'.$item->id }}" class="btn btn-success btn-sm">Pesan</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="d-flex justify-content-end" style="width: 100%">
                    <button type="submit" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                    Kirim Data Penerimaan
                    </button>
            </div>
            </form>
              </div>
            </div>
          </div><!-- End Recent Sales -->
    </section>

@endsection
