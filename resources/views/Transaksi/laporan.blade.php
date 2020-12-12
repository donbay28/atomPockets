<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Atom Pockets</title>
  <script src="{{url('templates/assets/jquery/jquery.min.js')}}"></script>
  <script src="{{url('templates/assets/plugins/datetimepicker-master/jquery.datetimepicker.js')}}"></script>
  
  <link href="{{url('templates/assets/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{url('templates/assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
  <link href="{{url('templates/assets/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="{{url('templates/assets/select2/css/select2.min.css')}}" rel="stylesheet">
  <link href="{{url('templates/assets/selectize/css/selectize.css')}}" rel="stylesheet">
  <link href="{{url('templates/assets/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet">
  <link href="{{url('templates/assets/plugins/datetimepicker-master/jquery.datetimepicker.css')}}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

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
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                    <div class="form-group">
                        <button id="cetak" type="button" class="btn btn-info"><i class="fa fa-plus-print"></i> Cetak</button>
                        <button id="close" onclick="window.history.back();" type="button" class="btn btn-danger">Close</button>
                    </div>
                    </div>
                </div>
                <br>
                <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Nilai</th>
                        <th>Dompet</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data_transaksi ?? '' != null)
                            @foreach($data_transaksi ?? '' ?? '' as $key => $row)
                                <tr>
                                    <td>{{ ++$key}}</td>
                                    <td>{{$row->tanggal}}</td>
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->deskripsi}}</td>
                                    <td>{{$row->kategori->nama}}</td>
                                    <td>{{$row->nilai}}</td>
                                    <td>{{$row->dompet->nama}}</td>
                                </tr>
                            @endforeach
                        @else
                        <tr><td>Data Not Found</td></tr>
                        @endif
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
    </div>
<!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Maju Bersama Atomic Indonesia</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
    <script>
        $("#cetak").on('click',function() { 
            $("#close").attr("hidden", true);
            $("#cetak").attr("hidden", true);
            window.print();
            $("#close").attr("hidden", false);
            $("#cetak").attr("hidden", false);
        });
   </script>
  
  <script src="{{url('templates/assets/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{url('templates/assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('templates/assets/js/sb-admin-2.min.js')}}"></script>
  <script src="{{url('templates/assets/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('templates/assets/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <script src="{{url('templates/assets/js/demo/datatables-demo.js')}}"></script>
  <script src="{{url('templates/assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{url('templates/assets/selectize/js/selectize.min.js')}}"></script>
  <script src="{{url('templates/assets/selectize/js/selectize.js')}}"></script>
  <script src="{{url('templates/assets/select2/js/select2.min.js')}}"></script>
  <script src="{{url('templates/assets/js/form-input.js')}}"></script>
</body>

</html>
