@extends('Layout.default')

@section('content')
<div class="pagetitle">
    <h1>Tambah Satuan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/Barang">Barang</a></li>
            <li class="breadcrumb-item active">Tambah Satuan</li>
          </ol>
    </nav>
  </div><!-- End Page Title -->

    <!-- Floating Labels Form -->
    <section class="section">
    <form class="row g-3" method="POST" action="/Satuan" >
        @csrf
        <div class="col-md-12">
          <div class="form-floating">
            <input type="text" class="form-control" id="nama_satuan" placeholder="Nama Satuan" name="nama_satuan" value="{{ Session::get('nama_satuan') }}">
            <label for="floatingName">Nama Satuan</label>
          </div>
          <br>
          <p>Status Satuan Akan otomatis menjadi 1, lakukan edit setelah menambah satuan jika ingin merubah status</p>
        </div>
        <div class="text-start">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- End floating Labels Form -->
    </section>

@endsection
