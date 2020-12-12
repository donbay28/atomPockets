
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center"  href="{{url('/')}}">
        <div class="sidebar-brand-text mx-3">Atom</div>
      </a>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link"  href="{{url('/')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
     

      <!-- Heading -->
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-list"></i>
          <span>Master</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Master Components:</h6>
            <a class="collapse-item" href="{{url('/dompets')}}">Master Dompet</a>
            <a class="collapse-item" href="{{url('/kategoris')}}">Master Kategori</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/transaksis')}}" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-file"></i>
          <span>Dompet Masuk</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/transaksis/DompetKeluar')}}" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-file"></i>
          <span>Dompet Keluar</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('/transaksis/indexLaporan')}}" aria-expanded="true" aria-controls="collapseThree">
          <i class="fas fa-fw fa-file"></i>
          <span>Laporan</span>
        </a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <p>Dompet Donny</p>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <!-- <div class="sidebar-brand-text mx-6">Buana Karya</div><div class="sidebar-brand-text mx-3">Canopi <sup>BSD</sup></div> -->
              <div class="input-group-append">
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-lg-block"></div>
            <!-- Nav Item - User Information -->

          </ul>

        </nav>

      </div>