@include('Template/Header')
@include('Template/Body')
<div class="page-wrapper">
  <div class="container-fluid">
      <div class="row page-titles">
          <div class="col-md-5 align-self-center">
              <h4 class="text-themecolor">Dompet Masuk - Buat Baru</h4>
          </div>
          <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                      <li class="breadcrumb-item active">Dompet Masuk - Buat Baru</li>
                  </ol>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                      <div class="table">
                          <form action="{{ url('/transaksis/store') }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                              <input type="hidden" value="WIN-{{$kode}}" required class="form-control" name="code">
                              <input type="hidden" required class="form-control" name="tanggal" value="{{date('Y-m-d')}}">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Kode : </label>
                                      <input type="text" disabled value="WIN-{{$kode}}" required class="form-control">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Tanggal : </label>
                                      <input type="text" disabled required class="form-control" value="{{date('Y-m-d')}}">
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label class="control-label">Kategori* : </label>
                                      <select name="kategori_id" class="form-control" id="">
                                        <option disabled>Choose Kategori</option>
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
                                        <option disabled>Choose Dompet</option>
                                        @foreach($data_dompet ?? '' ?? '' as $key => $row)
                                            <option value="{{$row->id}}">{{$row->nama}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Nilai : </label>
                                      <input type="number" id="number" min="0" placeholder="0"  required class="form-control" name="nilai">
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">Deskripsi : </label>
                                      <textarea name="deskripsi" class="form-control"></textarea>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="full-width text-center p-t-12" >
                                      <button onclick="window.history.back();" type="button" class="btn btn-info">Back</button>
                                      <button class="btn btn-success" type="submit">Simpan</button>
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
    var number = document.getElementById('number');

    // Listen for input event on numInput.
    number.onkeydown = function(e) {
        if(!((e.keyCode > 95 && e.keyCode < 106)
        || (e.keyCode > 47 && e.keyCode < 58) 
        || e.keyCode == 8)) {
            return false;
        }
    }
</script>
@include('Template/Footer')