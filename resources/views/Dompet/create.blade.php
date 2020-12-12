@include('Template/Header')
@include('Template/Body')
<div class="page-wrapper">
  <div class="container-fluid">
      <div class="row page-titles">
          <div class="col-md-5 align-self-center">
              <h4 class="text-themecolor">Master Dompet</h4>
          </div>
          <div class="col-md-7 align-self-center text-right">
              <div class="d-flex justify-content-end align-items-center">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                      <li class="breadcrumb-item active">Dompet Buat Baru</li>
                  </ol>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                      <div class="table">
                          <form action="{{ url('/dompets/store') }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Nama* : </label>
                                      <input type="text" placeholder="Nama" minlength="5" required class="form-control" name="nama">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Referensi : </label>
                                      <input type="text" placeholder="Referensi" class="form-control" name="referensi">
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">Deskripsi : </label>
                                      <textarea name="deskripsi" class="form-control"></textarea>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Status : </label>
                                      <select name="status_id" class="form-control">
                                        <option value="1">Aktif</option>
                                        <option value="2">Tidak Aktif</option>
                                      </select>
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
@include('Template/Footer')