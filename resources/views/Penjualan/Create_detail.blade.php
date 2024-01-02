@extends('Layout.default')

@section('content')
<div class="pagetitle">
    <h1>Tambah Pemesanan</h1>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Pemesanan</li>
        </ol>
      </nav>
  </div><!-- End Page Title -->

    <!-- Floating Labels Form -->
    <section class="section">
        <div class="col-12">
            <div class="card recent-sales overflow-auto">

              <div class="card-body">
                <h5 class="card-title">Barang </h5>
                {{-- <div class="d-flex justify-content-end" style="width: 100%">
                    <a href="/Barang/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                        Tambah Barang
                    </a>
                </div> --}}
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
                                <form class="row d-flex align-items-center" style="width:200px"  action="{{ '/beli/'.$item->id.'/'.$penjualan->id }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="col-7 p-0">
                                        <input id="jumlah" placeholder="jumlah" name="jumlah" type="number" class="form-control" required>
                                    </div>
                                    <div class="col ms-1 p-0">
                                        <button type="submit" class="d-inline btn btn-success btn-sm">Pesan</button>
                                    </div>
                                </form>
                                {{-- <a href="{{ '/Pengadaan/create/'.$item->id }}" class="btn btn-success btn-sm">Pesan</a> --}}
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
                {{-- <div class="d-flex justify-content-end" style="width: 100%">
                    <a href="/Barang/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                        Tambah Barang
                    </a>
                </div> --}}
                  <h5 class="card-title">Keranjang Belanja</h5>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">id</th>
                      <th scope="col">Nama barang</th>
                      <th scope="col">Harga satuan</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">subtotal</th>
                      <th scope="col">aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $detail_penjualan as $item )
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->harga_satuan }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->subtotal }}</td>
                            {{-- <td>{{ $item->status }}</td> --}}
                            <td>
                                <form class="d-inline" action="{{ '/beli/'.$item->id.'/'.$penjualan->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                {{-- <a href="{{ '/Pengadaan/create/'.$item->id }}" class="btn btn-success btn-sm">Pesan</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                <div class="d-flex justify-content-end" style="width: 100%">
                    <a href="/" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                      Done
                      </a>
                  </div>
              </div>
            </div>
          </div><!-- End Recent Sales -->
    </section>

@endsection
