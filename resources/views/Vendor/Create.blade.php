@extends('Layout.default')

@section('content')
<div class="pagetitle">
    <h1>Tambah Vendor</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/vendor">Magement Pengadaan</a></li>
            <li class="breadcrumb-item active">Tambah Vendor</li>
          </ol>
    </nav>
  </div><!-- End Page Title -->

    <!-- Floating Labels Form -->
    <section class="section">
    <form class="row g-3" method="POST" action="/vendor" >
        @csrf
        <div class="col-md-12">
          <div class="form-floating">
            <input type="text" class="form-control" id="nama_vendor" placeholder="Nama Vendor" name="nama_vendor" value="{{ Session::get('nama_vendor') }}">
            <label for="floatingName">Vendor Name</label>
          </div>
          <br>
          <p>Status Vendor Akan otomatis menjadi 1, lakukan edit setelah menambah vendor jika ingin merubah status</p>
        </div>
        <div class="text-start">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- End floating Labels Form -->
    </section>

@endsection
