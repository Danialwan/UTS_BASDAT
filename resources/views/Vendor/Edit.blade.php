@extends('Layout.default')

@section('content')
<div class="pagetitle">
    <h1>Edit Vendor</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/vendor">Magement Pengadaan</a></li>
            <li class="breadcrumb-item active">Edit Vendor</li>
          </ol>
    </nav>
  </div><!-- End Page Title -->

    <!-- Floating Labels Form -->
    <section class="section">
    <form class="row g-3" method="POST" action="{{ '/vendor/'.$data->id }}" >
        @csrf
        @method('PUT')
        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" class="form-control" id="nama_vendor" placeholder="Nama Vendor" name="nama_vendor" value="{{ $data->nama_vendor }}">
            <label for="floatingName">Vendor Name</label>
          </div>
          <br>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input type="number" class="form-control" id="status" placeholder="status" name="status" value="{{ $data->status }}">
            <label for="floatingName">Status</label>
          </div>
          <br>
        </div>
        <div class="text-start">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- End floating Labels Form -->
    </section>

@endsection
