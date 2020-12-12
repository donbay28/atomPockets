@include('Template/Header')
@include('Template/Body')
    <div class="page-wrapper">
      <div class="container-fluid">
          <div class="row page-titles">
              <div class="col-md-5 align-self-center">
                  <h4 class="text-themecolor">Dompet Masuk</h4>
              </div>
              <div class="col-md-7 align-self-center text-right">
                  <div class="d-flex justify-content-end align-items-center">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item">Home</li>
                          <li class="breadcrumb-item active">Dompet Masuk</li>
                      </ol>
                  </div>
              </div>
          </div>
          <div class="row">
        
              <div class="col-12">
                  <div class="card">
                      <div class="card-body">
                      <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <a class="btn btn-info" href="{{url('/transaksis/create')}}" role="button"><i class="fa fa-plus-circle"></i>Buat Baru</a>
                              <select class="btn btn-md btn-info" id="filter-status">
                                <option value="0">Semua</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                              </select>  
                            </div>
                          </div>
                      </div>
                      <br>
                      <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
        
      </div>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
    </div>
    <script>
        $(document).on("change", "#filter-status", function(e) {
            status_id = $('#filter-status').val();
            $.ajax({
                type: 'POST',
                url: '/dompets/filterStatus/'+status_id,
                data: {
                    "status_id": status_id,
                    '_token': '{{ csrf_token() }}',
                }
            })
            .done(function(response){
                console.log(response)
                $('#dataTable').DataTable().ajax.reload();
            })
            .fail(function(){
                console.log('Something Went Wrong .... Please contact administrator');
            })
        });
    </script>
@include('Template/Footer')
