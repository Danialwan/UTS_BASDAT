@extends('Layout.default')
@section('content')

    <div class="pagetitle">
      <h1>Log Barang</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Log Tables</h5>
              <p>Menunjukan detail transaksi barang, mulai dari barang keluar, barang masuk, barang baru, dan barang di hapus.</p>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    {{-- <th scope="col">#</th> --}}
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Stok</th>
                    {{-- <th scope="col">Start Date</th> --}}
                  </tr>
                </thead>
                <tbody>
                    @foreach ( $data as $item )
                        <tr>
                            {{-- <th scope="row">1</th> --}}
                            <td>{{ $item->created_at }}</td>
                            @if ( $item->jenis_transaksi == 1)
                            {{-- Create new barang --}}
                            <td> <b style="color: red">Menambahkan</b> barang baru <b style="color: blue">( {{ $item->nama }} )</b> dengan harga {{ $item->harga }}</td>
                            @elseif ($item->jenis_transaksi == 2)
                            {{-- stock masuk --}}
                            <td><b style="color: red">Barang masuk</b> Stock bertambah sebanyak <b style="color: blue">( {{ $item->masuk }} )</b> pada barang {{ $item->nama }}</td>
                            @elseif ($item->jenis_transaksi == 3)
                            {{-- stock keluar --}}
                            <td><b style="color: red">Barang keluar</b> Stock berkurang sebanyak <b style="color: blue">( {{ $item->keluar }} )</b> pada barang {{ $item->nama }}</td>
                            @elseif ($item->jenis_transaksi == 4)
                            {{-- delete barang --}}
                            <td><b style="color: red">Barang dihapus</b> {{ $item->nama }} </td>
                            @endif
                            <td>{{ $item->stock }}</td>

                            {{-- <td>28</td>
                            <td>2016-05-25</td> --}}
                        </tr>
                    @endforeach
                  {{-- <tr>
                    <th scope="row">2</th>
                    <td>Bridie Kessler</td>
                    <td>Developer</td>
                    <td>35</td>
                    <td>2014-12-05</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Ashleigh Langosh</td>
                    <td>Finance</td>
                    <td>45</td>
                    <td>2011-08-12</td>
                  </tr>
                  <tr>
                    <th scope="row">4</th>
                    <td>Angus Grady</td>
                    <td>HR</td>
                    <td>34</td>
                    <td>2012-06-11</td>
                  </tr>
                  <tr>
                    <th scope="row">5</th>
                    <td>Raheem Lehner</td>
                    <td>Dynamic Division Officer</td>
                    <td>47</td>
                    <td>2011-04-19</td>
                  </tr> --}}
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
  @endsection
