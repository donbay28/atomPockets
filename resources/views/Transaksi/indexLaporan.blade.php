@include('Template/Header')
@include('Template/Body')
<div class="page-wrapper">
  <div class="container-fluid">
      <div class="row page-titles">
          <div class="col-md-5 align-self-center">
              <h4 class="text-themecolor">Dompet Keluar - Buat Baru</h4>
          </div>
          <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                      <li class="breadcrumb-item active">Dompet Keluar - Buat Baru</li>
                  </ol>
              </div>
          </div>
      </div>
      
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                      <div class="table">
                          <form action="{{ url('/transaksis/filterLaporan') }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Tanggal Awal: </label>
                                      <input type="text" class="date form-control" value="{{date('Y-m-d')}}" name="tanggal_awal">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Tanggal Akhir: </label>
                                      <input type="text" class="date form-control" value="{{date('Y-m-d')}}" name="tanggal_akhir">
                                  </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label class="control-label">Status : </label>
                                      <ul>
                                        <li class="fa fa-check"> Tampilan Uang Masuk</li>
                                        <br>
                                        <li class="fa fa-check"> Tampilan Uang Keluar</li>
                                      </ul>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Kategori* : </label>
                                      <select name="kategori_id" class="form-control" id="">
                                        <option value="all">Semua</option>
                                        @foreach($data_kategori ?? '' ?? '' as $key => $row)
                                            <option value="{{$row->id}}">{{$row->nama}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Dompet* : </label>
                                      <select name="dompet_id" class="form-control" id="">
                                      <option value="all">Semua</option>
                                        @foreach($data_dompet ?? '' ?? '' as $key => $row)
                                            <option value="{{$row->id}}">{{$row->nama}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="full-width text-center p-t-6" >
                                      <button class="btn btn-success">Buat Excel</button>
                                      <button class="btn btn-info" type="submit">Buat Laporan</button>
                                  </div>
                              </div>
                          </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<script>
     $('.date').datetimepicker({
        format:'Y-m-d',
        mask:false,
        timepicker:false,
        minDate: '-2015/01/01'
    });
</script>
@include('Template/Footer')