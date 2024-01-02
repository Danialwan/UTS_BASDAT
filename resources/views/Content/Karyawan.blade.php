@extends('Layout.default')
@section('content')
<div class="pagetitle">
    <h1>Management Karyawan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Management Karyawan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
                      <!-- Floating Labels Form -->
                    <div class="card overflow-auto">
                        <h5 class="card-title">Edit Profile </h5>
                      <form method="POST" class="row g-3 my-3" action="{{ 'Karyawan/'.$data_akun->id }}">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="username" placeholder="username" name="username" value="{{ Auth::user()->username }}">
                            <label for="floatingName">Your Name</label>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-floating mb-3">
                            <select class="form-select" id="role" aria-label="role" name="role">
                              <option value="{{ Auth::user()->role }}" selected>{{ $data_akun->nama_role }}</option>
                              @foreach ( $roles as $role )
                              @if ( $role->nama_role  ==  $data_akun->nama_role )
                              @else
                                <option value="{{ $role->id }}"> {{ $role->nama_role }} </option>
                              @endif
                              @endforeach
                            </select>
                            <label for="role">State</label>
                          </div>
                        </div>
                        <div>
                            <a href="" class="btn btn-primary">Rubah Password</a>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                              </div>
                        </div>
                      </form><!-- End floating Labels Form -->
                </div>
            </div>
    <div class="row">
      <!-- Left side columns -->
        <div class="col-lg-8">
                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                              <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                  <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                  </li>

                                  <li><a class="dropdown-item" href="#">Today</a></li>
                                  <li><a class="dropdown-item" href="#">This Month</a></li>
                                  <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                              </div>

                              <div class="card-body">
                                <h5 class="card-title">Karyawan </h5>
                                <div class="d-flex justify-content-end" style="width: 100%">
                                    <a href="/Karyawan/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                                        Tambah Karyawan
                                    </a>
                                </div>
                                <table class="table table-borderless datatable">
                                  <thead>
                                    <tr>
                                      <th scope="col">id</th>
                                      <th scope="col">Nama</th>
                                      <th scope="col">jabatan</th>
                                      <th scope="col">tanggal masuk</th>
                                      <th scope="col">aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ( $data_users as $item )
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                @if ($item->id == 1)

                                                @else
                                                <form class="d-inline" action="{{ '/Karyawan/'.$item->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                @endif
                                                {{-- <a href="{{ '/Karyawan/'.$item->id.'/edit' }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                                <a href="/Karyawan/restore" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                                    Restore
                                </a>
                              </div>

                            </div>
                          </div><!-- End Recent Sales -->
                    </div>
                            <!-- Right side columns -->
        <div class="col-lg-4">

            <!-- Recent Activity -->
            <div class="card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Recent Activity</h5>

                <div class="activity">

                  <div class="activity-item d-flex">
                    <div class="activite-label">32 min</div>
                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                    <div class="activity-content">
                      Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">56 min</div>
                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                    <div class="activity-content">
                      Voluptatem blanditiis blanditiis eveniet
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">2 hrs</div>
                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                    <div class="activity-content">
                      Voluptates corrupti molestias voluptatem
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">1 day</div>
                    <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                    <div class="activity-content">
                      Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">2 days</div>
                    <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                    <div class="activity-content">
                      Est sit eum reiciendis exercitationem
                    </div>
                  </div><!-- End activity item-->

                  <div class="activity-item d-flex">
                    <div class="activite-label">4 weeks</div>
                    <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                    <div class="activity-content">
                      Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                    </div>
                  </div><!-- End activity item-->

                </div>

              </div>
            </div><!-- End Recent Activity -->

            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>

                      <li><a class="dropdown-item" href="#">Today</a></li>
                      <li><a class="dropdown-item" href="#">This Month</a></li>
                      <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <h5 class="card-title">Management Jabatan </h5>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">id</th>
                          <th scope="col">nama_satuan</th>
                          <th scope="col">aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ( $roles as $item )
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama_role}}</td>
                                <td>
                                    @if ($item->id == 1)

                                    @else
                                    <a href="{{ '/Role/'.$item->id.'/edit' }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form class="d-inline" action="{{ '/Role/'.$item->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    <div class="d-flex justify-content-between" style="width: 100%">
                        <a href="/Role/create" class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                            Tambah Role
                        </a>
                        <a href="/Role/restore" style="width: 100px; " class="btn btn-success plus-icon d-flex align-items-center justify-content-center">
                            Restore
                        </a>
                    </div>
                  </div>

                </div>
              </div><!-- End Recent Sales -->
    </div>
</section>

@endsection
