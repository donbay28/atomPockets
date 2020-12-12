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
                          <div class="row">
                              <input type="hidden" name="id" value="{{$data_dompet['id']}}">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Nama* : </label>
                                      <input disabled type="text" placeholder="Nama" value="{{$data_dompet['nama']}}" class="form-control" name="nama">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Referensi : </label>
                                      <input disabled type="text" placeholder="Referensi" value="{{$data_dompet['referensi']}}" class="form-control" name="referensi">
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">Deskripsi : </label>
                                      <textarea disabled name="deskripsi" class="form-control">{{$data_dompet['deskripsi']}}</textarea>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label">Status : </label>
                                      <select disabled name="status_id" class="form-control">
                                        <option value="1" {{$data_dompet['status_id'] == 1 ? 'selected' : ''}}>Aktif</option>
                                        <option value="2" {{$data_dompet['status_id'] == 2 ? 'selected' : ''}}>Tidak Aktif</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-12">
                                  <div class="full-width text-center p-t-12" >
                                      <button onclick="window.history.back();" type="button" class="btn btn-info">Back</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@include('Template/Footer')