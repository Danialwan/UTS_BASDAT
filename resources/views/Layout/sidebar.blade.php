  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ (request()->is('/')) ? ' ':'collapsed' }}" href="/">
              <i class="bi bi-grid"></i>
              <span>Dashboard</span>
            </a>
          </li><!-- End Dashboard Nav -->

      {{-- <li class="nav-heading">Pages</li> --}}

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('Barang')) ? ' ':'collapsed' }}" href="/Barang">
            <i class="bi bi-box-seam"></i></i>
          <span>Barang</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('vendor')) ? ' ':'collapsed' }}" href="/vendor">
          <i class="bi bi-truck"></i>
          <span>Vendor</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('Karyawan')) ? ' ':'collapsed' }}" href="/Karyawan">
          <i class="bi bi-person"></i>
          <span>Karyawan</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link {{ (request()->is('Karyawan')) ? ' ':'collapsed' }}" href="/Log">
          <i class="bi bi-collection"></i>
          <span>Log Barang</span>
        </a>
      </li><!-- End Profile Page Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="/Logout">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Sign Out</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside>
  <!-- End Sidebar-->
