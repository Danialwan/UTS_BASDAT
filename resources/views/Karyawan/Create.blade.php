@extends('Layout.default')

@section('content')
<div class="pagetitle">
    <h1>Tambah Karyawan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/Karyawan">Management Karyawan</a></li>
            <li class="breadcrumb-item active">Management Karyawan</li>
          </ol>
    </nav>
  </div><!-- End Page Title -->

    <!-- Floating Labels Form -->
    <section class="section">
    <!-- Floating Labels Form -->
    <form class="row g-3" method="POST" action="/Karyawan">
        @csrf
        <div class="col-md-12">
          <div class="form-floating">
            <input type="text" class="form-control" id="username" placeholder="username" name="username" value="{{ Session::get('username') }}">
            <label for="username">Nama Karyawan</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="col-md-12">
            <div class="form-floating">
              <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" placeholder="password" name="password" required autocomplete="current-password" value="{{ Session::get('password') }}">
              <label for="password">Password</label>
            </div>
            <span class="invalid-feedback" role="alert">
                <strong>Password yang anda masukan tidak sesuai</strong>
            </span>
          </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
              <input input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password">
              <label for=" password_confirmation">konfirmasi Password</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
              <select class="form-select" id="role" aria-label="role" name="role">
                  <option selected>-</option>
                   @foreach ( $data as $item )
                  <option value="{{ $item->id }}"> {{ $item->nama_role }} </option>
                  @endforeach
              </select>
              <label for="role">Jabatan</label>
            </div>
          </div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form><!-- End floating Labels Form -->

    </section>

@endsection
